<?php

	session_start();
	
	include('connect/db_connection.php');		
	
	$level = 1;
	
	if(isset($_GET['level'])){
		$level = $_GET['level'];
	}
	
	switch($level){
		case "1":
			$receipt = 'images/comparisons/magnet_comparison_receipt_l1.png';
			$btn1 = 'images/comparisons/magnet_level1_selected.png';
			$btn2 = 'images/comparisons/magnet_level2.png';
			$btn3 = 'images/comparisons/magnet_level3.png';
			break;
		case "2":
			$receipt = 'images/comparisons/magnet_comparison_receipt_l2.png';
			$btn1 = 'images/comparisons/magnet_level1.png';
			$btn2 = 'images/comparisons/magnet_level2_selected.png';
			$btn3 = 'images/comparisons/magnet_level3.png';
			break;
		case "3":
			$receipt = 'images/comparisons/magnet_comparison_receipt_l3.png';
			$btn1 = 'images/comparisons/magnet_level1.png';
			$btn2 = 'images/comparisons/magnet_level2.png';
			$btn3 = 'images/comparisons/magnet_level3_selected.png';
			break;
		default:
			break;
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
        	
            <!-- <img src="images/comparisons/magnet_comparison_2.png" alt="Compare Our Prices - Kitchens from Magnet Trade Contracts" style="margin-top: 20px; margin-bottom: 20px;" /> -->
            <div style="width: 945px; margin-top: 20px;">
            	<div style="width: 460px; height: 110px; background-color: #1b75bc; color: #ffffff; font-size: 16px; float: left;">
                	<div style="padding: 15px; float: left; width: 230px;">
                    	<b>Compare Our Prices</b><br />
                    	Kitchens from Magnet Trade Contracts
                    </div>
                    <div style="padding: 15px; float: right;">
                    	<img src="images/comparisons/magnet_logo.png" alt="Magnet Kitchens Logo" />
                    </div>
                </div>
            
            	<a href="magnet_comparisons.php?level=1"><img src="<?php echo $btn1; ?>" alt="Show Level 1 Prices" style="float: left; margin-left: 10px; margin-right: 10px; margin-bottom: 20px;" /></a>
                <a href="magnet_comparisons.php?level=2"><img src="<?php echo $btn2; ?>" alt="Show Level 2 Prices" style="float: left; margin-right: 10px; margin-bottom: 20px;" /></a>
                <a href="magnet_comparisons.php?level=3"><img src="<?php echo $btn3; ?>" alt="Show Level 3 Prices" style="float: left; margin-right: 10px; margin-bottom: 20px;" /></a>
            	<img src="<?php echo $receipt; ?>" alt="Magnet Kitchen Prices" style="float: right; margin-right: 60px; margin-top: 0px; margin-bottom: 20px;" />
                
                <div style="margin-top: -5px; margin-bottom: 20px; background-image: url('images/comparisons/magnet_kitchen_small.png'); width: 460px; height: 453px; background-repeat: no-repeat;">
                	
                    <img src="images/comparisons/magnet_sticker.png" alt="8 Units, 2 Worktops, Sink and Taps" style="float: right; margin: 15px; margin-top: -20px;" />
                    
                    <img src="images/comparisons/magnet_save.png" alt="You save £1700" style="position: relative; float: left; margin-left: 324px; margin-top: 23px" />
                    
                </div>
                
                <div style="font-size: 18px; color: #1b2e3d; text-align: left; margin-right: 20px;">
	                Magnet kitchens are available in 8 price bands. We've priced up bands 1, 2 & 3 which are the typical quality needed for rental properties. There are 8 kitchens available in each of these bands giving 24 kitchens in total!<br /><br />
                    Want to be able to take advantage of these prices?<br /><br />
    			</div>
                             
                <div style="font-size: 18px; color: #1b2e3d; text-align: right; margin-right: 20px;">
                    <a href="join.php"><img src="images/join-now-btn.png" alt="Join Now" style="float: right; margin-left: 15px; margin-bottom: 20px" /></a>
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