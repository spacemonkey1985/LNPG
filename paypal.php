<?php
// Database variables
include('connect/db_connection.php');
include('includes/common.php');
include('includes/config.inc.php');
include('includes/Logging.class.php');

$log = new Logging();
$log->lfile('./admin/data/ipn.log');
$log->lwrite("POST: ".print_r($_POST, true));	

// PayPal settings
$return_url = $GLOBALS["return_url"] .'?'; // We'll append encoded membership number, email and promocode to the url
$cancel_url = $GLOBALS["cancel_url"];
$notify_url = $GLOBALS["notify_url"];

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"]) && 
	isset($_POST['member']) && !empty($_POST['member']) && 
	isset($_POST['email']) && !empty($_POST['email']))
{
	// Ready for success
	$return_url .= "member=".$_POST['member']."&email=".$_POST['email']."&promocode=".$_POST['promocode'];
	// Decoded values
	$memdecode = urldecode($_POST['member']);
	$member_no = base64_decode(urldecode($_POST['member']));
	$member_email = base64_decode(urldecode($_POST['email']));
	$promocode = $_POST['promocode'];
	$log->lwrite("Member:".$member_no." Email:".$member_email." PromoCode:".$promocode);
	
	// Firstly Append paypal account to querystring
	$querystring  = "?business=".urlencode($GLOBALS["PAYPAL_BUSINESS"]);	
	$querystring .= "&currency_code=GBP"; // Currency Code
	$querystring .= "&cmd=_xclick-subscriptions";
	$querystring .= "&no_note=1";
	$querystring .= "&lc=UK";
	
	$fullprice="249.00";

	// Check for promo code and discount
	$validpromo=false;
	$promodesc = "";

	if (!empty($promocode))
	{
		$promosql = "SELECT * FROM promoCodes WHERE promoCode = '$promocode';";
	
		if(($result = mysql_query($promosql)) && mysql_num_rows($result) == 1)
		{
			// Promo code exists
			$validpromo = true;
			
			// Get the details
			$row=mysql_fetch_array($result);
			$description = $row['description']; 
			$discountValue = $row['discountValue']; 
			$discountPercent = $row['discountPercent'];
			// Are we applying a discount value or percentage. If ther's a discount value, use it.
			if ($discountValue == 0 && $discountPercent != 0)
			{
				$discountValue = $fullprice - $fullprice*$discountPercent/100;
			}
		}
	}

	$querystring .= "&a3=$fullprice";		// Regular subscription price
	$querystring .= "&p3=1";				// Regular subscription period
	$querystring .= "&t3=Y";				// Regular subscription price

	// Apply promo price
	if  ($validpromo)
	{
		$promoprice = $fullprice - $discountValue;
		$querystring .= "&a1=$promoprice"; 	// Trial period price
		$querystring .= "&p1=1"; 			// Trial period duration
		$querystring .= "&t1=Y"; 			// Trial period in years
		$promodesc = "Promotion code: $promocode";
	}

	$querystring .= "&item_name=".urlencode("LNPG subscription. Membership number: $member_no $promodesc");

	$querystring .= "&src=1";				// Recurring payment with no limit
	$querystring .= "&sra=1";				// Attempt recurring payment before sunscription is cancelled.
	$querystring .= "&invoice=INV".$member_no;	// Invoice number
	
	// Undocumented for subscriptions for 
	$querystring .= "&rm=2";				// 2 – the payer's browser is redirected to the return URL by the POST method, and all transaction variables are also posted

	// Append paypal return addresses
	$querystring .= "&return=".urlencode(stripslashes($return_url));
	$querystring .= "&cancel_return=".urlencode(stripslashes($cancel_url));
	$querystring .= "&notify_url=".urlencode($notify_url);
	
	$log->lwrite("QUERY: ".$querystring);	
	
	// Redirect to paypal IPN
	header('location:'.$GLOBALS["PAYPAL_URL"].$querystring);
	exit();

}else{
	
	// Response from Paypal

	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
		$req .= "&$key=$value";
	}
	
	// We can receive a number of IPN messages. Subscriptions have been requested above. Web accpt are the PayPal button for our monthly meetings.
	// Subscriptions all have invoice => INVxxxx where xxxx in the member number. Instant payments may or may not be from a member.
	// txn_type => subscr_payment	First payment of subscription
	// txn_type => subscr_signup	Suscripyion sign up
	// txn_type => subscr_cancel	Subscription cancelled

	// txn_type => web_accept 		Meeting payment

	extract($_POST);
	if ($txn_type == 'subscr_payment' || $txn_type == 'subscr_signup' || $txn_type == 'subscr_cancel')
	{
		$txn_type == 'subscr_payment' ? $date=strftime("%Y-%m-%d %H:%M:%S",strtotime($payment_date)) : $date=strftime("%Y-%m-%d %H:%M:%S",strtotime($subscr_date));
		$memberNo = substr($invoice, 3);
	}
	else if ($txn_type == 'web_accept')
	{
		// This may or not be from a member. See if we have a previous payment from this payer_email. If so, use the latest membership number
		// INDEX on payer-email
		$selectsql = "SELECT memberNo from paypalPayments where payer_email = '$payer_email' order by payment_date desc limit 1";
		$result = mysql_query($selectsql) or die("mySql error".mysql_error());
		if(mysql_num_rows($result) == 1)
		{
			$row=mysql_fetch_array($result); 
			$memberNo = $row['memberNo'];
		}
		else
		{	// Not found in payment table, try the member table
			$selectsql = "SELECT MemberNo from empg_member where Email = '$payer_email'";
			$result = mysql_query($selectsql) or die("mySql error".mysql_error());
			if(mysql_num_rows($result) == 1)
			{
				$row=mysql_fetch_array($result); 
				$memberNo = $row['MemberNo'];
			}
		}
		$date=strftime("%Y-%m-%d %H:%M:%S",strtotime($payment_date));
	}
	else
	{
		$log->lwrite("Unexpected txn_type".$txn_type);	
	}
	
	$paypalsql = "INSERT INTO paypalPayments(`id`,
		`memberNo`,
		`payer_email`,
		`payer_id`,
		`payer_status`,
		`first_name`,
		`last_name`,
		`address_name`,
		`address_street`,
		`address_city`,
		`address_state`,
		`address_country`,
		`address_zip`,
		`address_status`,
		`payment_date`,
		`payment_status`,
		`payment_type`,
		`subscr_id`,
		`transaction_subject`,
		`txn_type`,
		`ipn_track_id`,
		`invoice`,
		`item_name`,
		`item_number`,
		`quantity`,
		`mc_gross`,
		`btn_id`,
		`memo`) VALUES (null, '$memberNo', '$payer_email', '$payer_id', '$payer_status', '$first_name', '$last_name', '$address_name', '$address_street', '$address_city', '$address_state', '$address_country', '$address_zip', '$address_status', '$date', '$payment_status', '$payment_type', '$subscr_id', '$transaction_subject', '$txn_type', '$ipn_track_id', '$invoice', '$item_name', '$item_number', '$quantity', '$mc_gross', '$btn_id', '$memo');";
	$log->lwrite("SQL:".$paypalsql);

	$result = mysql_query($paypalsql) or die("mySql error".mysql_error());

	$log->lwrite("Paypal Postback:".$req);
	
	// post back to PayPal system to validate
	$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
	$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
	
	$fp = fsockopen ('ssl://'.$GLOBALS["PAYPAL_POSTBACK"], 443, $errno, $errstr, 30);	
	
	if (!$fp) {
		// HTTP ERROR
		$log->lwrite("Error connecting to PayPal: errno=".$errno." errstr=".$errstr);
	} else {	

		fputs ($fp, $header . $req);
		while (!feof($fp)) {
			$res = fgets ($fp, 1024);

			if (strcmp($res, "VERIFIED") == 0) {
				$log->lwrite("PayPal response: VERIFIED");
				
				$paypalsql = "UPDATE empg_member SET PaymentDate = $date";
				$result = mysql_query($paypalsql) or die("mySql error".mysql_error());
				$log->lwrite("SQL:".$paypalsql);

			
				// Used for debugging
				//@mail("you@youremail.com", "PAYPAL DEBUGGING", "Verified Response<br />data = <pre>".print_r($post, true)."</pre>");
						
				// Validate payment (Check unique txnid & correct price)
//				$valid_txnid = check_txnid($data['txn_id']);
//				$valid_price = check_price($data['payment_amount'], $data['item_number']);
//				// PAYMENT VALIDATED & VERIFIED!
//				if($valid_txnid && $valid_price){				
//					$orderid = updatePayments($data);		
//					if($orderid){					
//						// Payment has been made & successfully inserted into the Database								
//					}else{								
//						// Error inserting into DB
//						// E-mail admin or alert user
//					}
//				}else{					
//					// Payment made but data has been changed
//					// E-mail admin or alert user
//				}						
			
			}else if (strcmp ($res, "INVALID") == 0) {
				$log->lwrite("PayPal response: INVALID");
			
				// PAYMENT INVALID & INVESTIGATE MANUALY! 
				// E-mail admin or alert user
				
				// Used for debugging
				//@mail("you@youremail.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
			}
		}		
	fclose ($fp);
	}	
}
?>