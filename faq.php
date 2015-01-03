<?php

	session_start();
	
	include('connect/db_connection.php');		
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
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

			<img src="images/faq-title.png" alt="FAQs" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
        	
        	<div class="left-column">
            	<a href="join.php"><img src="images/join-ad-2.png" alt="Join now" style="margin-bottom: 20px;" /></a>
                
                <a href="contact.php"><img src="images/contact-ad.png" alt="Contact us" /></a>
            </div>
            
            <div class="right-column">
            	
                <a href="join.php"><img src="images/benefits-join-now.png" alt="Join now" /></a>
                
                <div class="benefits-checklist">
            	
                    <div class="benefits-checklist-text">
                        <ul>
                            <li>Save money on your refurbishment, maintenance and repairs?</li>
                            <li>Save hours price matching products and materials?</li>
                            <li>Use top quality companies who deliver directly to your door?</li>
                            <li>Maintain and even increase your property's value</li>
                        </ul>
                    </div>
                    
                </div>
                
                <div class="benefits-subtitle">
                	Welcome to our<br />frequently asked<br />questions area
				</div>
                
                <div class="benefits-content">
                
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
									echo("<div style='padding: 3px;'>" . $row['Answer'] . "</div>");
									echo("<div style='margin-top: 10px; padding: 3px; text-align: right; line-height: 30px; vertical-align: middle;'>Did this not answer your question?<a href='contact.php'><img src='images/contact-btn.png' alt='Contact us' style='float: right; margin-left: 5px;' /></a></div>");
									echo("</div>");
								}
								else{
									echo("<div style='position: relative; float: left; width: 295px; margin-right: 25px; margin-bottom: 20px; display: table-cell;'>");
									echo("<div style='height: 45px; color: #ffffff; background-color: #7aba0c; padding: 3px; font-size: 18px;'><b>" . $row['Question'] . "</b></div>");
									echo("<div style='padding: 3px;'>" . $row['Answer'] . "</div>");
									echo("<div style='margin-top: 10px; padding: 3px; text-align: right; line-height: 30px; vertical-align: middle;'>Did this not answer your question?<a href='contact.php'><img src='images/contact-btn.png' alt='Contact us' style='float: right; margin-left: 5px;' /></a></div>");
									echo("</div>");
								}
								
								$i++;
                            }
                        }	
        
                        mysql_close($conn);
                    
                    ?>
                
                	<br />
                    <br />
                    
                </div>
                
                <div style="clear: left; height: 20px;"></div>
                
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