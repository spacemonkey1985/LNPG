<?php
	
	session_start();
	
	if(isset($_SESSION['loggedIn'])){
		if($_SESSION['loggedIn'] != 1){
			header('location: login.php');
		}
	}
	else{
		header('location: login.php');
	}
	
	include('connect/db_connection.php');	
	include('includes/common.php');
	include('includes/config.inc.php');
	
	$key='r8181055';
	$member = $_SESSION['name'];
	$membermail = $_SESSION['email'];
	$refcode = urlencode(base64_encode($_SESSION['member_no']));
	$error = "";
		
$message = <<<EOT


$member has joined our organisation and thought you might also be interested in making massive savings on your purchases for the properties you own.

Our company is called the Landlords National Property Group (LNPG) and it's open to all Landlords.

The levels of discount available as a member are of the kind only large housing associations and councils usually get. However, LNPG have negotiated these large discounts for our member landlords nationally. Thousands can be saved on refurbishments, repairs and maintenance costs.

Once you become a member you can open accounts with companies like PTS, Magnet Kitchens, Dulux and Designer Contracts. Take a look at our website, it's very easy to join.
Once your accounts are set up, you can buy what you like, when you like, directly with the partners.

Click below to join and start saving now:
http://www.LNPG.co.uk/index.php?refer=$refcode

Best Wishes,
$member

This message was composed and sent on behalf of Landlords National Property Group member $member ($membermail) through the LNPG affiliate programme.

We take your privacy seriously. Read our privacy policy.
Ref: Affiliate
EOT;

	for ($i=1; $i<=5; $i++)
	{
		$namevar = "name$i";
		$emailvar= "email$i";
		$memberno = $_SESSION['member_no'];
		
		if(isset($_POST[$namevar]) && $_POST[$namevar] != '')
		{
			$name = $_POST[$namevar];
			$email = $_POST[$emailvar];
			
			$check = "SELECT * FROM empg_member_affiliate WHERE ReferedEmail = '" . $email . "';";
			
			if(!$result = mysql_query($check)){
				echo mysql_error();
			}
			else{
				if(mysql_num_rows($result) != 0){
					$error = $error . "<a href='" . $email . "'>". $email . "</a><br />";
				}
				else{
					$insert_affiliate = "INSERT INTO empg_member_affiliate(MemberNo, ReferedName, ReferedEmail) VALUES('" . $memberno . "', '" . $name . "', '" . $email . "');";
					
					mysql_query($insert_affiliate);
					
					$to = $email;
		
					$subject ="Hi $name come and join me at LNPG";
					$body = "Hi $name" . $message;
		
					$headers = 'From: '. MAILADDR_MEMBERSHIP . "\n" .
								'Reply-To: '. MAILADDR_MEMBERSHIP . "\n" .
								'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $body, $headers);
		
					// Notify ourselves
					$to = MAILADDR_MEMBERSHIP;
					$subject ="Member $member has referred $name ($email)";
					$body = "Member $member has referred $name ($email)";
		
					$headers = 'From: '. MAILADDR_MEMBERSHIP . "\n" .
								'Reply-To: '. MAILADDR_MEMBERSHIP . "\n" .
								'X-Mailer: PHP/' . phpversion();
					mail($to, $subject, $body, $headers);
				}
			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title>Landlords National Property Group</title>
<link type="text/css" href="stylesheets/common.css" rel="stylesheet" />
</head>

<body>
    
	<!-- Logo and Login -->
    
    <div class="header">
    	<div class="header-content">
        
        	<a href="join.php"><img src="images/logo.png" alt="LNPG Logo" class="logo" /></a>
            
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

			<img src="images/members-title.png" alt="Members area" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
            
            <div class="members-menu">
            	<ul>
                	<li><a href="members.php">Members Home</a></li>
                	<li><a href="members-partners.php">Partners</a></li>
                	<li><a href="members-edit.php">My details</a></li>
                    <li class="selected"><a href="affiliate.php">Refer a Landlord</a></li>
                </ul>
            </div>
            
			<img src="images/members-content-top-bg.png" alt="Top border" style="float: right; margin-top: 20px; margin-right: 42px" />
            
            <div class="members-content">
            	<div style="position: relative; float: left; font-size: 12px; width: 665px; margin-left: 20px;">
                	<h1>Refer a Landlord</h1>
                    <p>
                    	<b>Congratulations!</b> you have sucessfully referred your landlords to join LNPG!
                        <?php 
						
							if($error != ""){
								echo "<br /><br /><b>However</b> the following email addresses have already been referred so were not added:<br /><br />";
								echo $error;
							}
						
						?>
                        <br /><br />Click <a href="affiliate.php">here</a> to view the progress of your referred subscriptions
                    </p>   
                </div>
            </div>
            
            <img src="images/members-content-bottom-bg.png" alt="Bottom border" style="float: right; margin-bottom: 20px; margin-right: 42px" />
            
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