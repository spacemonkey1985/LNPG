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

			<img src="images/comparisons-title.png" alt="Price Comparisons" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
        	
            <!-- <img src="images/comparisons/magnet_comparison_1.png" alt="Compare Our Prices - Kitchens from Magnet Trade Contracts" style="margin-top: 20px; margin-bottom: 20px;" />-->
            <div style="width: 945px; margin-top: 20px;">
            	<div style="height: 110px; background-color: #1b75bc; color: #ffffff; font-size: 24px;">
                	<div style="padding: 15px; float: left;">
                    	<b>Compare Our Prices</b><br />
                    	Heating Systems and bathrooms from PTS
                    </div>
                    <div style="padding: 15px; float: right;">
                    	<img src="images/comparisons/pts_logo.png" alt="PTS Logo" />
                    </div>
                </div>

				<div style="margin-top: -5px; margin-bottom: 20px; background-image: url('images/comparisons/pts_heating.png'); height: 326px; background-repeat: no-repeat;">
                	<img src="images/comparisons/pts_receipt_1.png" alt="Magnet Kitchen Prices" />
                    
                    <a href="join.php"><img src="images/comparisons/pts_save.png" alt="You save £1700" style="float: right; margin-top: 188px;" /></a>
                    
                </div>
                
            </div>
            
            <div style="width: 945px; margin-top: 20px;">
            	<div style="height: 110px; background-color: #1b75bc; color: #ffffff; font-size: 24px;">
                	<div style="padding: 15px; float: left;">
                    	<b>Compare Our Prices</b><br />
                    	Kitchens from Magnet Trade Contracts
                    </div>
                    <div style="padding: 15px; float: right;">
                    	<img src="images/comparisons/magnet_logo.png" alt="Magnet Kitchens Logo" />
                    </div>
                </div>

				<div style="margin-top: -5px; margin-bottom: 20px; background-image: url('images/comparisons/magnet_kitchen.png'); height: 326px; background-repeat: no-repeat; cursor: pointer;" onclick="javascript:window.location = 'magnet_comparisons.php';">
                	<img src="images/comparisons/magnet_receipt_1.png" alt="Magnet Kitchen Prices" />
                    
                    <img src="images/comparisons/magnet_sticker.png" alt="8 Units, 2 Worktops, Sink and Taps" style="float: right; margin: 15px;" />
                    <br />
                    <a href="join.php"><img src="images/comparisons/magnet_save.png" alt="You save £1700" style="float: right; margin-top: -135px;" /></a>
                    
                </div>
                
            </div>
            
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