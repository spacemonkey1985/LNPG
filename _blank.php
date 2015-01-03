<?php

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
                
                <span style="font-size: 42px; color: #1b75bc;">Title...</span><br /><br />
                
            	<p style="font-size: 12px; margin-bottom: 20px;">
                	Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce orci arcu, fringilla suscipit dictum eu, viverra vel ligula. Cras vel ante neque. Phasellus feugiat pellentesque ante, quis lacinia erat volutpat et. Sed laoreet rhoncus ultricies. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean facilisis ante quis velit adipiscing tempor. Integer dictum gravida elit. Aliquam erat volutpat. Sed consectetur, urna non consectetur interdum, lectus mauris porttitor dui, id rutrum tellus mauris sit amet turpis. Maecenas sapien tellus, interdum euismod hendrerit quis, semper at nisl. Vivamus blandit felis sit amet est posuere semper. Aenean fermentum interdum lectus, sit amet lacinia nisi dictum quis. Vivamus cursus odio sed diam accumsan dignissim. Quisque venenatis accumsan hendrerit. Suspendisse ante lacus, molestie id blandit at, volutpat at nisl. Nunc vel purus mi. 
                </p>       

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