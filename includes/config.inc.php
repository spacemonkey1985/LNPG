<?php
if($_SERVER['HTTP_HOST']=='test.lnpg.co.uk')
{
	define("MAILADDR_MEMBERSHIP", "tony@parkinch.co.uk");

	// PayPal settings
	$GLOBALS["return_url"] = 'http://test.lnpg.co.uk/sucess.php';
	$GLOBALS["cancel_url"] = 'http://test.lnpg.co.uk/sucess.php';
	$GLOBALS["notify_url"] = 'http://test.lnpg.co.uk/paypal.php';

	$GLOBALS["PAYPAL_POSTBACK"]="www.sandbox.paypal.com";
	$GLOBALS["PAYPAL_URL"] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	$GLOBALS["PAYPAL_BUSINESS"] = 'seller_1328285403_biz@parkinch.co.uk';
}
else
{
	define("MAILADDR_MEMBERSHIP", "membership@lnpg.co.uk");

	// PayPal settings
	$GLOBALS["return_url"] = 'https://www.lnpg.co.uk/sucess.php';
	$GLOBALS["cancel_url"] = 'https://www.lnpg.co.uk/sucess.php';
	$GLOBALS["notify_url"] = 'https://www.lnpg.co.uk/paypal.php';

	$GLOBALS["PAYPAL_POSTBACK"]="www.paypal.com";
	$GLOBALS["PAYPAL_URL"] = 'https://www.paypal.com/cgi-bin/webscr';
	$GLOBALS["PAYPAL_BUSINESS"] = 'admin@lnpg.co.uk';
}
?>
