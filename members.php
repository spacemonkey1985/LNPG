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
                	<li class="selected"><a href="members.php">Members Home</a></li>
                	<li><a href="members-partners.php">Partners</a></li>
                	<li><a href="members-edit.php">My details</a></li>
                    <li><a href="affiliate.php">Refer a Landlord</a></li>
                </ul>
            </div>
            
			<img src="images/members-content-top-bg.png" alt="Top border" style="float: right; margin-top: 20px; margin-right: 42px" />
            
            <div class="members-content">
            	<div style="position: relative; float: left; font-size: 12px; width: 415px; margin-left: 20px;">
                	<h1>Home</h1>
                    
                    <?php
                    	echo('<img src="images/members/' . $_SESSION['member_no'] . '/avatar.jpg" class="avatar" alt="Avatar" />');
					?>
                    
                    <div class="member-detail-summary">
                    	<span style="font-size: 14px;">Welcome! <b><?php echo $_SESSION['name'] ?></b></span><br />
                        Membership No: 001<?php echo str_pad((int) $_SESSION['member_no'],3,"0",STR_PAD_LEFT); ?><br />
                        Email: <?php echo $_SESSION['email']; ?>
                        <br /><br />
                        <span style="display:inline-block; vertical-align:middle; line-height: 20px; margin-bottom: 5px;"><img src="images/arrow_down_right.png" alt="Arrow" style="margin-right: 10px; vertical-align: middle;" /><a href="change_password.php">Change password</a></span><br />
                       	<span style="display:inline-block; vertical-align:middle; line-height: 20px;"><img src="images/arrow_down_right.png" alt="Arrow" style="margin-right: 10px; vertical-align: middle;" /><a href="edit_avatar.php">Change avatar</a></span>
                    </div>
                    
                    <div style="clear: left; padding-top: 10px;">
                    	<h1>Getting started...</h1>
                    	<p>
                        	To start benefiting from our partners massive discounts simply click on the 'Partners' option in the left hand menu of the members area. From here follow the step-by-step instructions for each partner to start enjoying making huge savings.
                            <br /><br /> 
                        	If you have any problems with your membership or need advice on how to purchase please contact us on 01932 698146 quoting your name and membership number.
							<hr />
                        </p>
                        <p>
							In addition to the discounts you will enjoy, on the first Monday of every month we host a property meeting in the East Midlands where like-minded landlords gather to hear invited speakers delivering valuable information and we update everyone with news of new partners and the future for LNPG members. 
                            <br /><br />
                            The meeting is open to members and non-members alike and is a great opportunity to network with people like yourself who have an interest in property and their portfolios. For details please click <a href="venue.php">here</a>
                            <br /><br />
                            Enjoy your membership and very best wishes from LNPG.
                        </p>
                    </div>
                    
                </div>
            
            	<div style="position: relative; float: right; font-size: 12px; width: 240px; margin-right: 20px; margin-top: 20px;">
                	<img src="images/meeting-header.png" alt="Come to our next meeting" />
                
                    <img src="images/map.png" alt="Derbyshire Hotel" />
                    
                    <a href="venue.php"><img src="images/more-btn.png" alt="Find Out More" style="float: right; margin-top: 20px; margin-bottom: 20px;" /></a>
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