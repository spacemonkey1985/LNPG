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
	include('includes/config.inc.php');
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
            	<div style="position: relative; float: left; font-size: 12px; width: 415px; margin-left: 20px;">
                	<h1>Refer a Landlord</h1>
                    <p>
                    	Tell a fellow <b>Landlord</b> about us and collect <b>&pound;45</b> when they subscribe. You can tell as many people as you like and there is <b>no restriction</b> on the commission you can collect.
                        <br /><br />
						You can choose if the commission goes to yourself, the Landlord or Charity.
                        <br /><br />
						<a href="affiliate_step1.php"><img src="images/refer-btn.png" alt="Refer a landlord" /></a>
                        <br /><br />
                    </p>
                    <hr />
                    <h1>Status</h1>
                    	<p>
                            <b>Refered landlords that are yet to register</b><br />
                            <ol>
                                <?php
                                
                                $referred = "SELECT * FROM empg_member_affiliate WHERE MemberNo = " . $_SESSION['member_no'] .  " AND DateRegistered is null;";
                                                                    
                                if(!$result = mysql_query($referred)){
                                    echo mysql_error();
                                }
                                else{
									if(mysql_num_rows($result) == 0){
										echo "<p>No members yet...</p>";  
									}
									else{
										while($row = mysql_fetch_array($result)){
											echo "<li><p>" . $row['ReferedEmail'] . "</p></li>";
										}
									}
                                }
                                
                                ?>
                            </ol>
                         </p>
                        <br />
                        <p>
                        <b>Registered landlords</b><br />
                            <ol>
                                <?php
                                
                                $referred = "SELECT * FROM empg_member_affiliate WHERE MemberNo = " . $_SESSION['member_no'] .  " AND DateRegistered is not null AND DateSubscribed is null;";
                                                                    
                                if(!$result = mysql_query($referred)){
                                    echo mysql_error();
                                }
                                else{
                                    if(mysql_num_rows($result) == 0){
										echo "<p>No members yet...</p>"; 
									}
									else{
										while($row = mysql_fetch_array($result)){
											echo "<li><p>" . $row['ReferedEmail'] . "</p></li>";
										}
									}
                                }
                                
                                ?>
                            </ol>
                        </p>
                        <br />
                        <p>
                            <b>Subscribed Landlords – processing</b> <span style="font-size: 10px;">(allow 60 days)</span><br />
                            <ol>
                                <?php
                                
                                $referred = "SELECT * FROM empg_member_affiliate WHERE MemberNo = " . $_SESSION['member_no'] .  " AND DateSubscribed is not null;";
                                                                    
                                if(!$result = mysql_query($referred)){
                                    echo mysql_error();
                                }
                                else{
                                    if(mysql_num_rows($result) == 0){
										echo "<p>No members yet...</p>";  
									}
									else{
										while($row = mysql_fetch_array($result)){
											echo "<li><p>" . $row['ReferedEmail'] . "</p></li>";
										}
									}
                                }
                                
                                ?>
                            </ol>
                        </p>
                        <br />
                        <p>
                        <b>Subscribed Landlords</b><br />
                            <ol>
                                <?php
                                
                                $referred = "SELECT * FROM empg_member_affiliate WHERE MemberNo = " . $_SESSION['member_no'] .  " AND DateSubscribed is not null;";
                                                                    
                                if(!$result = mysql_query($referred)){
                                    echo mysql_error();
                                }
                                else{
                                    if(mysql_num_rows($result) == 0){
										echo "<p>No members yet...</p>";  
									}
									else{
										while($row = mysql_fetch_array($result)){
											echo "<li><p>" . $row['ReferedEmail'] . "</p></li>";
										}
									}
                                }
                                
                                ?>
                            </ol>
                        </p>
                        <br />
                        <br />
        
                        <div style="text-align: right; font-size: 18px; color: #fff;">
                            <?php
                            
                            $due = "SELECT COUNT(ID) * 45 FROM empg_member_affiliate WHERE MemberNo = " . $_SESSION['member_no'] .  " AND DateSubscribed is not null AND Paid is null;";
                                                                
                            if(!$result = mysql_query($due)){
                                echo mysql_error();
                            }
                            else{
                                while($row = mysql_fetch_array($result)){
                                    echo "Commission due &pound;" . number_format($row[0], 2, '.', '') . "<br />";
                                }
                            }
                            
                            $total = "SELECT COUNT(ID) * 45 FROM empg_member_affiliate WHERE MemberNo = " . $_SESSION['member_no'] .  " AND DateSubscribed is not null AND Paid = 1;";
                                                                
                            if(!$result = mysql_query($total)){
                                echo mysql_error();
                            }
                            else{
                                while($row = mysql_fetch_array($result)){
                                    echo "<b>Total earned from affiliate program &pound;" . number_format($row[0], 2, '.', '') . "</b>";
                                }
                            }
                            
                            ?>
                            
                        </div>       
                </div>
                
                <div style="position: relative; float: right; font-size: 12px; width: 240px; margin-right: 20px; margin-top: 20px;">
                	<img src="images/affiliate-promo.png" alt="Refer a landlord" />
                    
                    <a href="affiliate_step1.php"><img src="images/refer-btn.png" alt="Refer a landlord" style="float: right; margin-top: 20px; margin-bottom: 20px;" /></a>
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