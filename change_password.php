<?php
	
	session_start();
	
	session_start();
	include('connect/db_connection.php');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title>Landlords National Property Group</title>
<link type="text/css" href="stylesheets/common.css" rel="stylesheet" />
<script type="text/javascript">
	function submitForm(){
		var form = document.getElementById('change_password');
		
		var new_password = document.getElementById('new_password');
		var new_password2 = document.getElementById('new_password2');
		
		var new_password_rv = document.getElementById('new_password_rv');
		
		if(new_password.value == new_password2.value){
			new_password_rv.style.display = "none";
			form.submit();
		}
		else{
			new_password_rv.style.display = "inline";
		}
	}
</script>
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

			<img src="images/change-password-title.png" alt="Change Password" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
            
            <div style="margin-left: 70px; margin-top: 50px;">
                <form name="login-form" id="login-form" method="post" action="update_password.php">
                    
                        <div class="fieldblock">
                            <label>New password:</label>
                            <div class="input hover"><input type="password" id="new_password" name="new_password" tabindex="1" /><span>Required</span></div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>Confirm new password:</label>
                            <div class="input hover"><input type="password" id="new_password2" name="new_password" tabindex="2"  /><span>Required</span></div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <input type="image" name="submit" id="submit" src="images/change-btn.png" tabindex="3" value="Submit" style="margin-left: 180px; "/>
                    
                    </form>
                </div>
            
        </div>
    </div>
    
    <!-- End Content -->

	<div class="login-special">
    	<div class="login-special-content">
            
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