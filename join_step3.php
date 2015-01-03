<?php

	session_start();
	
	include('connect/db_connection.php');	
	include('includes/common.php');
	include('includes/config.inc.php');
	
	$key='r8181055';
	
	if(isset($_POST['name'])){
		$check = "SELECT * FROM empg_member WHERE Email = '" . $_POST['email'] . "';";
		
		if(!$result = mysql_query($check)){
			echo mysql_error();
			exit;
		}

		if(mysql_num_rows($result) == 0){
			$insert_member = "INSERT INTO empg_member(Fullname, BusinessName, Add1, City, County, PostCode, TelNo, FaxNo, MobNo, Email, Referee, utm_source, utm_medium, utm_campaign, SignUpDate) VALUES ('" . $_POST['name'] . "', '" . $_POST['bus_name'] . "', '" . $_POST['add1'] . "', '" . $_POST['city'] . "', '" . $_POST['county'] . "', '" . $_POST['post_code'] . "', '" . $_POST['tel'] . "', '" . $_POST['fax'] . "', '" . $_POST['mob'] . "', '" . $_POST['email'] . "', '" . $_POST['ref'] . "', '" . $_SESSION['utm_source'] . "', '" . $_SESSION['utm_medium'] . "', '" . $_SESSION['utm_campaign'] ."', NOW())";

			mysql_query($insert_member);
			$member_no = mysql_insert_id();
		}
		else{
			$row=mysql_fetch_array($result); // Get the exisitng (unsubscribed) member's number
			$member_no = $row['MemberNo']; 

			$update_member = "UPDATE empg_member SET Fullname = '" . $_POST['name'] . "', BusinessName = '" . $_POST['bus_name'] . "', Add1 = '" . $_POST['add1'] . "', City = '" . $_POST['city'] . "', County = '" . $_POST['county'] . "', PostCode = '" . $_POST['post_code'] . "', TelNo = '" . $_POST['tel'] . "', FaxNo = '" . $_POST['fax'] . "', MobNo = '" . $_POST['mob'] . "', Referee = '" . $_POST['ref'] . "' WHERE Email = '" . $_POST['email'] . "';";

			mysql_query($update_member);
		}
	}
	
	if(isset($_SESSION['referer_email'])){
		$update_affiliate = "UPDATE empg_member_affiliate SET DateRegistered = CURDATE() WHERE MemberNo = " . $_SESSION['referer_no'] . " AND ReferedEmail = '" . $_POST['email'] . "';";
		mysql_query($update_affiliate);
	}
	
	mysql_close($conn);
	
	$to = MAILADDR_MEMBERSHIP;
	$subject = 'New LNPG Member sign up: Step 2';
	$body = "Name: " . $_POST['name'] . "\n"  .
			"Email:" . $_POST['email']. "\n" .
			"Mobile:" . $_POST['mob']. "\n" .
			"Member no:" . $member_no ;
	$headers = 'From: webmaster@lnpg.co.uk' . "\n" .
				'Reply-To: ' . MAILADDR_MEMBERSHIP . "\n" .
				'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $body, $headers);
	
	// Promo codes
	$showPromo = false;
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title>Landlords National Property Group</title>
<link type="text/css" href="stylesheets/common.css" rel="stylesheet" />
<script type="text/javascript">
	function enablePaypal(){
		var checkbox = document.getElementById('agree');
		var paypal = document.getElementById('submit');
		
		if(checkbox.checked){
			paypal.disabled = false;
			paypal.classList.remove('grey-out');
		}
		else{
			paypal.disabled = true;
			paypal.classList.add('grey-out');
		}
	}
	function checkPromoCode(){
		var request = new ajaxRequest()
		var code = document.getElementById('promo').value
		var referrerLink = document.referrer

		if (code == "") 
		{
			document.getElementById('promo_desc').innerHTML = ""
			return
		}

		request.open("GET", "ajax/promocode.php?promoCode="+code+"&referrerLink="+referrerLink, true)

		request.onreadystatechange = function()
		{
			if (this.readyState == 4)
			{
				if (this.status == 200)
				{
					if (this.responseXML != null)
					{
						var msg = this.responseXML.getElementsByTagName('statustext')[0].childNodes[0].nodeValue
						if (this.responseXML.getElementsByTagName('status')[0].childNodes[0].nodeValue == 'ERROR')
						{
							document.getElementById('promo_desc').innerHTML = msg
							document.getElementById('promocode').value = ""
						}
						else
						{
							document.getElementById('promo_desc').innerHTML = msg
							document.getElementById('promocode').value = code
						}
					}
					else alert("Ajax error: No data received")
				}
				else alert("Ajax error: " + this.statusText)
			}
		}
		
		request.send(null)
	}
	function ajaxRequest()
	{
		try
		{
			request = new XMLHttpRequest()
		}
		catch (e)
		{
			try
			{
				request = new ActiveXObject("Msxml2.XMLHTTP")
			}
			catch (e2)
			{
				try
				{
					request = new ActiveXObject("Microsoft.XMLHTTP")
				}
				catch (e3)
				{
					request = false
				}
			}
		}
		return request
	}
</script>
</head>

<body onload="enablePaypal()">

	<!-- Logo and Login -->
    
    <div class="header">
    	<div class="header-content">
        
        	<a href="#"><img src="images/logo.png" alt="LNPG Logo" class="logo" /></a>
            
            <?php include('includes/login-form.php'); ?>
            
            <p class="logo-tag-line">The UK's largest discount club for landlords</p>
                
        </div>
    </div>
    
    <!-- End Logo and Login -->
    
    <!-- Menu -->
    
    <div class="menu-bar">
    	<div class="menu-bar-bg"></div>
    	<div class="menu-bar-content">
        
        	<div class="menu">
            	<?php include('includes/menu.php'); ?>
            </div>
                
        </div>
    </div>
    
    <!-- End Menu -->
    
    <!-- Title banner -->
    
    <div class="title-banner">
    	<div class="title-banner-content">

			<img src="images/join-title.png" alt="About us" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
        	
        	<div style="position: relative; float: left; width: 700px; margin-top: 20px;">
            
            	<div style="position: relative; float: left; font-size: 12px; width: 250px; height: 100px; margin-bottom: 20px;">
                              
                </div>
                
                <span style="font-size: 42px; color: #1b75bc;">Payment</span><br /><br />
                
            	<p style="font-size: 12px; margin-bottom: 20px;">Thank you for choosing the LNPG. Please fill out your details to benefit from LNPG membership.</p>
                
                <div style="margin-left: 70px">
                	<form>
                    	<div class="fieldblock">
                        	<label>Payment:</label>
                            <div class="input hover">
                            	<p>Please read the disclaimer and terms &amp; conditions below before subscribing to your LNPG Membership.</p>
                            </div>
						</div>
                        
                        <div class="fieldblock">
                        	<label>Disclaimer:</label>
                            <div class="input hover">
                            	<p>By registering for the Landlords National Property Group, you agree that we may send you, from time to time, special offers, marketing and other information by email.  You may opt out of receiving these at any time once you have registered by selecting 'My Details' within 'Members Area'.</p>
                            </div>
						</div>
                        
                        <div class="fieldblock">
                        	<label>Terms & Conditions:</label>
                            <div class="input hover">
                            	<p>
                                    <ol style="font-size: 12px; margin-left: -25px;">
                                        <li>You must be a landlord to join</li>
                                        <li>Your purchases must be for your own use in your own properties.</li>
                                        <li>You must not resell.</li>
                                    </ol>
                                </p>
		                        <p style="font-size: 12px; margin-left: -45px;"><input type="checkbox" name="agree" id="agree" onclick="enablePaypal();"  />I have read and agree with the Terms and Conditions</p>
                            </div>
						</div>
                        
                        <div class="fieldblock">
                        	<label>Promotion Codes:</label>
                            <div class="input hover">
                            	<p>Please enter any promotion code here</p>
                                <input type="text" name="promo" id="promo" maxlength="30" style="width: 200px;"/>
								<button type="button"  onclick="checkPromoCode();" style="float:left; height: 28px;">Apply Promo Code</button> 
                                <div id="promo_desc" style="color: red;font-size:14px; margin-top:60px; class="promo_desc">
                                
                                </div>
                            </div>
                            
						</div>
                        
                    </form>
                    
                    <br /><br />
    
                    <table cellspacing="5" style="width: 100%; text-align:center;">
                        <tr>
                            <td>
                                
                                <form action="paypal.php" method="post" onsubmit="this.submit();return false;">
                                    <input type="hidden" name="member" value="<?php echo urlencode(base64_encode($member_no)); ?>">
                                    <input type="hidden" name="email" value="<?php echo urlencode(base64_encode($_POST['email'])); ?>">
                                    <input type="hidden" name="promocode" id="promocode" value="">
                                    <input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" id="submit" alt="PayPal — The safer, easier way to pay online.">
                                </form>
                                
                            </td>
                        </tr>
                    </table>
                </div>
                    
            </div>
            
            <div style="position: relative; float: right; width: 240px; margin-top: 20px; margin-left: 20px;">
            	
                <img src="images/meeting-header.png" alt="Come to our next meeting" />
                
                <img src="images/map.png" alt="Derbyshire Hotel" />
                
                <a href="venue.php"><img src="images/more-btn.png" alt="Find Out More" style="float: right; margin-top: 20px; margin-bottom: 20px;" /></a>
                
            </div>
            
            <div style="clear: left; height: 20px;"></div>
            
        </div>
    </div>
    
    <!-- End Content -->

	<!-- Footer -->
    
    <div class="footer">
    	<div class="footer-content">
        
        </div>
    </div>
    
    <!-- End Footer -->
        
</body>
</html>