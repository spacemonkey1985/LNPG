<?php
	
	session_start();
	
	if(isset($_SESSION['loggedIn'])){
		if($_SESSION['loggedIn'] != 1){
			header('location: ../login.php');
		}
	}
	else{
		header('location: ../login.php');
	}
	
	include('../connect/db_connection.php');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title>Landlords National Property Group</title>
<script language="JavaScript" src="js/FusionCharts.js"></script>
<link type="text/css" href="../stylesheets/common.css" rel="stylesheet" />
</head>

<body>
    
	<!-- Logo and Login -->
    
    <div class="header">
    	<div class="header-content">
        
        	<a href="../join.php"><img src="../images/logo.png" alt="LNPG Logo" class="logo" /></a>
            
            <?php include('../includes/admin-login-form.php'); ?>
            
            <p class="logo-tag-line">The UK's largest discount club for landlords</p>
                
        </div>
    </div>
    
    <!-- End Logo and Login -->
    
    <!-- Menu -->
    
    <div class="menu-bar">
    	<div class="menu-bar-bg"></div>
    	<div class="menu-bar-content">
        
        	<div class="menu">
            	<?php include('../includes/admin-menu.php'); ?>
            </div>
                
        </div>
    </div>
    
    <!-- End Menu -->
    
    <!-- Title banner -->
    
    <div class="title-banner">
    	<div class="title-banner-content">

			<img src="../images/admin-title.png" alt="Admin area" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
            
            <div class="members-menu">
            	<ul>
                	<li><a href="reports.php">Registration Reports</a></li>
                	<li class="selected"><a href="google-reports.php">Google Analytics</a></li>
                </ul>
            </div>
            
			<img src="../images/members-content-top-bg.png" alt="Top border" style="float: right; margin-top: 20px; margin-right: 42px" />
            
            <div class="members-content">
            	<div style="position: relative; float: left; font-size: 12px; width: 665px; margin-left: 20px;">
                    
                	<h1>Google Analytics</h1>
                    
       				<p>
                            
                        <h2>Page Views</h2>
                        <iframe src="http://www.seethestats.com/stats/4622/Pageviews_88f30fdd0_ifr.html" style="width:540px;height:270px;border:none;" scrolling="no" frameborder="0"></iframe>
                        <h2>Visits by City</h2>
                        <iframe src="http://www.seethestats.com/stats/4622/VisitsByCity_c1e033e5e_ifr.html" style="width:540px;height:270px;border:none;" scrolling="no" frameborder="0"></iframe>
                        <h2>Visitors</h2>
                       	<iframe src="http://www.seethestats.com/stats/4622/Visitors_afa535da2_ifr.html" style="width:540px;height:270px;border:none;" scrolling="no" frameborder="0"></iframe>
                        <h2>Visits by Browser</h2>
                       	<iframe src="http://www.seethestats.com/stats/4622/VisitsByBrowser_31cfa8c50_ifr.html" style="width:540px;height:270px;border:none;" scrolling="no" frameborder="0"></iframe>
                        <h2>Unique Visits</h2>
                       	<iframe src="http://www.seethestats.com/stats/4622/Visits_132619447_ifr.html" style="width:540px;height:270px;border:none;" scrolling="no" frameborder="0"></iframe>
                        <h2>Unique Page Views</h2>
                       	<iframe src="http://www.seethestats.com/stats/4622/UniquePageviews_534c4cc71_ifr.html" style="width:540px;height:270px;border:none;" scrolling="no" frameborder="0"></iframe>
                    </p>             
                </div>
            </div>
            
            <img src="../images/members-content-bottom-bg.png" alt="Bottom border" style="float: right; margin-bottom: 20px; margin-right: 42px" />
            
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