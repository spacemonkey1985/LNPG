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
                	<li class="selected"><a href="faq.php">View</a></li>
                	<li><a href="faq-edit.php">New / Edit</a></li>
                </ul>
            </div>
            
			<img src="../images/members-content-top-bg.png" alt="Top border" style="float: right; margin-top: 20px; margin-right: 42px" />
            
            <div class="members-content">
            	<div style="position: relative; float: left; font-size: 12px; width: 665px; margin-left: 20px;">
                    
                	<h1>FAQs</h1>
                    
       				<p>
                            
                        <?php
                    
							$benefits = "SELECT * FROM empg_faq;";
												
							if(!$result = mysql_query($benefits)){
								echo mysql_error();
							}
							else{
								$i=1;
								
								while($row = mysql_fetch_array($result)){
									if($i%2 == 1){
										echo("<div style='clear: left; position: relative; float: left; width: 295px; margin-right: 25px; margin-bottom: 20px; display: table-cell;'>");
										echo("<div style='height: 45px; color: #ffffff; background-color: #7aba0c; padding: 3px; font-size: 18px;'><b>" . $row['Question'] . "</b></div>");
										echo("<div style='padding: 3px; color: #fff;'>" . $row['Answer'] . "</div>");
										echo("<div style='margin-top: 10px; padding: 3px; text-align: right; line-height: 24px; vertical-align: middle; color: #fff;'><a href='faq-edit.php?id=" . $row['FaqId'] . "'><img src='../images/edit-btn.png' alt='Contact us' style='float: right; margin-left: 5px; padding-right: 15px;' />Edit</a></div>");
										echo("</div>");
									}
									else{
										echo("<div style='position: relative; float: left; width: 295px; margin-right: 25px; margin-bottom: 20px; display: table-cell;'>");
										echo("<div style='height: 45px; color: #ffffff; background-color: #7aba0c; padding: 3px; font-size: 18px;'><b>" . $row['Question'] . "</b></div>");
										echo("<div style='padding: 3px; color: #fff;'>" . $row['Answer'] . "</div>");
										echo("<div style='margin-top: 10px; padding: 3px; text-align: right; line-height: 24px; vertical-align: middle; color: #fff;'><a href='faq-edit.php?id=" . $row['FaqId'] . "'><img src='../images/edit-btn.png' alt='Contact us' style='float: right; margin-left: 5px; padding-right: 15px;' />Edit</a></div>");
										echo("</div>");
									}
									
									$i++;
								}
							}	
			
							mysql_close($conn);
						
						?>
                        
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