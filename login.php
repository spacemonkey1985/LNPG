<?php
	
	session_start();
	
	include('connect/db_connection.php');
	include('includes/common.php');
	
	$key='r8181055';
	
	if(isset($_GET['activate'])){
		
		$member_no = urldecode(base64_decode($_GET['activate']));
		
		$update_member = "UPDATE empg_member SET Active = 1 WHERE MemberNo = " . $member_no . ";";
		
		mysql_query($update_member);
		
		if(is_dir("images/members/" . $member_no)){
			copy("images/members/avatar.jpg", "images/members/" . $member_no . "/avatar.jpg");
		}
		else{
			if(mkdir("images/members/" . $member_no)){
				copy("images/members/avatar.jpg", "images/members/" . $member_no . "/avatar.jpg");
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

			<img src="images/login-title.png" alt="Sign In" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
            
            <div style="margin-left: 70px; margin-top: 50px;">
                <form name="login-form" id="login-form" method="post" action="includes/sign_in.php">
                    
                    	<?php
						
							if(isset($_GET['changed'])){
								if($_GET['changed'] == '1'){
									echo('<div class="fieldblock">');
									echo('<label>Password changed:</label>');
									echo('<div class="input hover" style="height: 30px;"><span>Your password has been changed. Please log in with your new password</span></div>');
									echo('</div>');
								}
								else{
									echo('<div class="fieldblock">');
									echo('<label>Sorry:</label>');
									echo('<div class="input hover" style="height: 30px;"><span>We were unable to change your password</span></div>');
									echo('</div>');
								}
							}
							
							if(isset($_GET['no_email'])){
								echo('<div class="fieldblock">');
                            	echo('<label>Sorry:</label>');
                            	echo('<div class="input hover" style="height: 30px;"><span>Please enter a username</span></div>');
                        		echo('</div>');
							}
							
							if(isset($_GET['activate'])){
								echo('<div class="fieldblock">');
                            	echo('<label>Activated:</label>');
                            	echo('<div class="input hover" style="height: 30px;"><span>Your account has been activated, please sign in</span></div>');
                        		echo('</div>');
							}
							
							if(isset($_GET['error'])){
								echo('<div class="fieldblock">');
                            	echo('<label>Sorry:</label>');
                            	echo('<div class="input hover" style="height: 30px;"><span>We could not find your username in our records. Are you sure you used the correct username?</span></div>');
                        		echo('</div>');
							}
							
							if(isset($_GET['sent'])){
								echo('<div class="fieldblock">');
                            	echo('<label>Thank you:</label>');
                            	echo('<div class="input hover" style="height: 30px;"><span>Your new password has been sent to your email address</span></div>');
                        		echo('</div>');
							}
						
						?>
                        
                        <div class="fieldblock">
                            <label>Username:</label>
                            <div class="input hover"><input type="text" id="un" name="un" tabindex="1" /><span>Required</span></div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>Password:</label>
                            <div class="input hover"><input type="password" id="pw" name="pw" tabindex="2"  /><span>Required</span></div>
                        </div>
                        
                        <?php
						
							if(isset($_GET['wrong'])){
								echo('<div class="fieldblock">');
                            	echo('<label>Sorry:</label>');
                            	echo('<div class="input hover" style="height: 30px;"><span>Wrong username or password</span></div>');
                        		echo('</div>');
							}
							
							if(isset($_GET['no_email'])){
								echo('<div class="fieldblock">');
                            	echo('<label>Sorry:</label>');
                            	echo('<div class="input hover" style="height: 30px;"><span>Please enter a username</span></div>');
                        		echo('</div>');
							}
							
							if(isset($_GET['error'])){
								echo('<div class="fieldblock">');
                            	echo('<label>Sorry:</label>');
                            	echo('<div class="input hover" style="height: 30px;"><span>We could not find your username in our records. Are you sure you used the correct username?</span></div>');
                        		echo('</div>');
							}
							
							if(isset($_GET['sent'])){
								echo('<div class="fieldblock">');
                            	echo('<label>Thank you:</label>');
                            	echo('<div class="input hover" style="height: 30px;"><span>Your new password has been sent to your email address</span></div>');
                        		echo('</div>');
							}
						
						?>
                        
                        <div class="clear"></div>
                        
                        <input type="image" name="submit" id="submit" src="images/log-in-btn.png" tabindex="3" value="Submit" style="margin-left: 180px; "/>
                    
                    </form>
                </div>
            
        </div>
    </div>
    
    <!-- End Content -->

	<div class="login-special">
    	<div class="login-special-content">
        
        	<div style="margin-left: 70px;">
            	<br /><br />
            	<span class="forgot-password"><a href="includes/forgot_password.php">I've forgotten my password</a></span>
            </div>
            
        </div>
	</div>
    
	<!-- Footer -->
    
    <div class="footer">
    	<div class="footer-content">
        
        </div>
    </div>
    
    <!-- End Footer -->
    
</body>
</html>