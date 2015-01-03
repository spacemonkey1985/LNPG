<?php

	session_start();
	
	include('connect/db_connection.php');
	include('includes/common.php');
	include('includes/config.inc.php');
	
	$key='r8181055';	
	
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

			<img src="images/meeting-title.png" alt="LNPG Meetings" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
        	
        	<div style="position: relative; float: left; width: 700px; margin-top: 20px;">
            
            	<div style="position: relative; float: left; font-size: 12px; width: 250px; margin-bottom: 20px; min-height: 300px; padding-right: 10px;">
                    
                    <a href="contact.php"><img src="images/contact-ad.png" alt="Contact us" style="margin-bottom: 20px;" /></a>
                               
                </div>
                
               	<?php
					if(isset($_GET['member'])){
						echo '<span style="font-size: 42px; color: #1b75bc;">Thank you...</span><br /><br />';
                		echo '<p style="font-size: 12px; margin-bottom: 20px;">Thank you for subscribing to LNPG. You will shortly receive a welcome email containing a members pack, password and link to activate your account. Please follow the link to unlock your account and start benefitting from your membership with LNPG.</p>';
						echo '<p style="font-size: 12px; margin-bottom: 20px;">Please add the following email addresses to your address book or whitelist. We use these email addresses to keep you informed about LNPG activities.</p>';
						echo '<p style="font-size: 12px; margin-bottom: 20px;"><a href="mailto:membership@lnpg.co.uk">membership@lnpg.co.uk</a> and <a href="mailto:newsletter@lnpg.co.uk">newsletter@lnpg.co.uk</a></p>';
						//$member_no = str_replace("MembershipNo", "", convert($_GET['member'], $key));
						$member_no = base64_decode($_GET['member']); // Already urldecoded. See: http://php.net/manual/en/function.urldecode.php
						$member_email = base64_decode($_GET['email']);
						$promocode = $_GET['promocode'];
						$password = createRandomPassword();
						
						$promosql = "SELECT * FROM promoCodes WHERE promoCode = '$promocode';";
	
						// Override marketing code from promo
						if(!empty($promocode) && ($result = mysql_query($promosql)) && mysql_num_rows($result) == 1)
						{
							// Get the details
							$row=mysql_fetch_array($result);
							$utm_source = $row['utm_source']; 
							$utm_medium = $row['utm_medium']; 
							$utm_campaign = $row['utm_campaign'];
							
							// Update promo code usage count
							$update_promo = "UPDATE promoCodes SET usageCount = usageCount+1 WHERE promoCode = '$promocode';";
							mysql_query($update_promo);
							
							$update_member = "UPDATE empg_member SET DateTimeStamp = CURDATE(), JoinDate = IFNULL(JoinDate, NOW()), PaymentDate = NOW(), Password = '$password', promocode='$promocode', utm_source='$utm_source', utm_medium='$utm_medium', utm_campaign='$utm_campaign' WHERE MemberNo = $member_no;";
						}
						else
						{
							$update_member = "UPDATE empg_member SET DateTimeStamp = CURDATE(), JoinDate = IFNULL(JoinDate, NOW()), PaymentDate = NOW(), Password = '$password' WHERE MemberNo = $member_no";
						}
	
						mysql_query($update_member);
						
						$update_affiliate = "UPDATE empg_member_affiliate SET DateSubscribed = CURDATE() WHERE ReferedEmail = '" . $member_email . "';";
						mysql_query($update_affiliate);
						
						$details = "SELECT * FROM empg_member WHERE MemberNo = " . $member_no . ";";
											
						if(!$result = mysql_query($details)){
							echo mysql_error();
						}
						else{
							while($row = mysql_fetch_array($result)){
								$email = $row['Email'];
								$name = $row['Fullname'];
							}
						}

						$to = $email;
						$subject = 'Welcome to the LNPG Discount Club - Please save these details';
						
						$body = 'Your unique LNPG membership No is:
01' . str_pad((int) $member_no,3,"0",STR_PAD_LEFT) . '


The first thing you need to do is activate your account. Please follow the link below:
http://www.LNPG.co.uk/login.php?activate=' . urlencode(base64_encode($member_no)) . '

Once your account is activated, click on the Member\'s area link on the LNPG home page and enter the following details.

Username:
' . $email . '

Password:
' . $password . '

We recommend you change your password immediately and keep a note of it somewhere safe.

Once in the member\'s area follow the instructions for how to, either buy immediately or, initiate accounts with our partners.

If you have any problems with your membership or need advice on how to purchase please contact us on 01932 698146 quoting your name and membership number. 

In addition to the discounts you will enjoy, on the first Monday of every month we host a property meeting in the East Midlands where like-minded landlords gather to hear invited speakers delivering valuable information and we update everyone with news of new partners and the future for LNPG members.

The meeting is open to members and non-members alike and is a great opportunity to network with people like yourself who have an interest in property and their portfolios. For details please visit www.LNPG.co.uk

Please keep this email in a safe place for future reference.

Enjoy your membership and very best wishes from LNPG.

Best Regards
Peter Francis';
					
						$headers = 'From: ' . MAILADDR_MEMBERSHIP . "\n" .
									'Reply-To: ' . MAILADDR_MEMBERSHIP . "\n" .
									'X-Mailer: PHP/' . phpversion();
						mail($to.',admin@lnpg.co.uk', $subject, $body, $headers);

						// Also send to Simon for his remuneration
						$to = MAILADDR_MEMBERSHIP . ', simon@simoncoulton.co.uk';
						$subject = 'New LNPG Member has paid! Welcome email sent.';
						$body = "Name: " . $name . "\r\n"  .
								"Username/Email:" . $email . "\r\n" .
								"Password:" . $password . "\r\n" .
								"Member no:" . $member_no ;
						$headers = 'From: webmaster@lnpg.co.uk' . "\n" .
									'Reply-To: ' . MAILADDR_MEMBERSHIP . "\n" .
									'X-Mailer: PHP/' . phpversion();
					
						mail($to, $subject, $body, $headers);

					}
					else{
						
						echo '<span style="font-size: 42px; color: #1b75bc;">We are sorry...</span><br /><br />';
                		echo '<p style="font-size: 12px; margin-bottom: 20px;">We are sorry to inform you that your registration was unsucessful. Please click <a href="join.php">here</a> to try again or <a href="contact.php">contact us</a> if you have further difficulties.</p>';
						$to = MAILADDR_MEMBERSHIP;
						$subject = 'New member\'s payment request has failed.';
						$body = "No member number returned from PayPal." ;
						$headers = 'From: webmaster@lnpg.co.uk' . "\n" .
									'Reply-To: ' . MAILADDR_MEMBERSHIP . "\n" .
									'X-Mailer: PHP/' . phpversion();
					
						mail($to, $subject, $body, $headers);
					}
					
					mysql_close($conn);
				
				?>

            </div>
            
            <div style="position: relative; float: right; width: 240px; margin-top: 20px; margin-left: 20px;">
            	
                <img src="images/meeting-header.png" alt="Come to our next meeting" />
                
                <img src="images/map.png" alt="Derbyshire Hotel" />
                
                <a href="venue.php"><img src="images/more-btn.png" alt="Find Out More" style="float: right; margin-top: 20px; margin-bottom: 20px;" /></a>
                
            </div>
            
            <div style="clear: right; height: 20px;"></div>
            
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