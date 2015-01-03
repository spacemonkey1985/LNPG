<?php // validatePromoCode.php
ob_start();
require('../connect/db_connection.php');	
	
$xml = <<<XML
<promocoderesponse>
<status>ERROR</status>
<statustext></statustext>
</promocoderesponse>
XML;

	if (!isset($_GET['promoCode'])) exit;
	
	$xmlresponse = new SimpleXMLElement($xml);
	$promo = "SELECT * FROM promoCodes WHERE promoCode = '" . $_GET['promoCode'] . "';";

	if(!$result = mysql_query($promo))
	{
		echo mysql_error();
		exit;
	}

	if(mysql_num_rows($result) == 0)
	{
		$xmlresponse->statustext = "Invalid Code";
	}
	else
	{
		// Promo code exists
		$row=mysql_fetch_array($result); // Get the details
		$description = $row['description']; 
		$discountValue = $row['discountValue']; 
		$discountPercent = $row['discountPercent']; 
		$maxUsage = $row['maxUsage']; 
		$usageCount = $row['usageCount']; 
		$validFrom = $row['validFrom']; 
		$validTo = $row['validTo']; 
		$referrerLink = $row['referrerLink'];

		// Check validity
		$now = new DateTime();
		if (new DateTime($validFrom) > $now) $xmlresponse->statustext = "Code is not yet valid";
		else if (new DateTime($validTo)< $now) $xmlresponse->statustext = "Code has expired";
		else if ($referrerLink != '' && $referrerLink <> $_GET['referrerLink']) $xmlresponse->statustext = "Referrer not valid";
		else if ($maxUsage > 0 && $usageCount >= $maxUsage) $xmlresponse->statustext = "Code usage exceeds maximum";
		else
		{
			// Code is valid
			$xmlresponse->status = "SUCCESS";
			$xmlresponse->statustext = $description;
			// Return details
			$result = $xmlresponse->addChild("discountValue", $discountValue);
			$result = $xmlresponse->addChild("discountPercent", $discountPercent);
		}
	}
	// Some crap gets into the output bufer
	ob_end_clean();
	header('Content-Type: text/xml');
	echo $xmlresponse->asXML();

function SanitizeString($var)
{
	$var = strip_tags($var);
	$var = htmlentities($var);
	return stripslashes($var);	
}

?>