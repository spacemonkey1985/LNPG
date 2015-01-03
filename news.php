<?php
	
	session_start();
	
	include('includes/simple_html_dom.php');
	include('includes/bank_rates.php');
	include('includes/house_price_index.php');
	
	$avg_house_price = $house;
	
	/*for($i=0; $i < count($bank_rates); $i++) {
   		if(trim($bank_rates[$i][1]) == "Current Bank Rate"){
			$current_bank_rate = $bank_rates[$i + 1][1];
		}
		if(trim($bank_rates[$i][1]) == "Current Inflation"){
			$current_bank_inflation = $bank_rates[$i + 1][1];
		}
	}*/	
	
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

			<img src="images/news-title.png" alt="News" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
            
            <div class="left-column-alt" style="font-size: 12px;">
            
            	<?php include('includes/news_headlines.php'); ?>
            	
            </div>
            
            <div class="right-column-alt">
            	
                <div style="background-image: url(images/financial-facts-bg.png); height: 430px; width: 200px; font-size: 12px;">
                
                	<div style="positon: relative; float: left; margin-left: 20px; margin-top: 115px; color: #ffffff;">Current Bank of England<br />base rate</div>
                    <div style="clear: left; positon: relative; float: right; margin-right: 20px; margin-top: -10px; color: #e87f1c; font-size: 16px;"><?php echo $rate; ?></div>
                    <div style="positon: relative; float: left; margin-left: 20px; margin-top: 15px; color: #ffffff;">Current inflation</div>
                    <div style="clear: left; positon: relative; float: right; margin-right: 20px; margin-top: -10px; color: #e87f1c; font-size: 16px;"><?php echo $inflation; ?></div>
                    
                    <div style="positon: relative; float: left; margin-left: 20px; margin-top: 145px; color: #ffffff;">Average price</div>
                    <div style="clear: left; positon: relative; float: right; margin-right: 20px; margin-top: -10px; color: #e87f1c; font-size: 16px;"><?php echo $avg_house_price; ?></div>
                	
                    <div style="positon: relative; float: left; margin-left: 20px; margin-top: 15px; color: #ffffff;">Change monthly</div>
                    <div style="clear: left; positon: relative; float: right; margin-right: 20px; margin-top: -10px; color: #e87f1c; font-size: 16px;"><?php echo $monthly; ?></div>
                    
                    <div style="positon: relative; float: left; margin-left: 20px; margin-top: 15px; color: #ffffff;">Change annual</div>
                    <div style="clear: left; positon: relative; float: right; margin-right: 20px; margin-top: -10px; color: #e87f1c; font-size: 16px;"><?php echo $annual; ?></div>
                    
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