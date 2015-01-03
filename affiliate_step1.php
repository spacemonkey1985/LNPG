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
	
?>
<script type="text/javascript">
	function submitForm(){
		var form = document.getElementById('affiliate');
		
		var name1 = document.getElementById('name1');
		var email1 = document.getElementById('email1');		
		var name2 = document.getElementById('name2');
		var email2 = document.getElementById('email2');
		var name3 = document.getElementById('name3');
		var email3 = document.getElementById('email3');
		var name4 = document.getElementById('name4');
		var email4 = document.getElementById('email4');
		var name5 = document.getElementById('name5');
		var email5 = document.getElementById('email5');
		
		var complete = 0;
		
		if(name1.value != ''){
			complete += 1;
			name1.style.border='1px solid #1b2e3d';
		}
		else{
			name1.style.border='1px dotted #fd5529';
		}
		
		if(email1.value != ''){
			email1.style.border='1px solid #1b2e3d';
			
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			
			if (!filter.test(email1.value)) {
				email1.style.border='1px dotted #fd5529';
			}
			else{
				complete += 1;
				email1.style.border='1px solid #1b2e3d';
			}
		}
		else{
			email1.style.border='1px dotted #fd5529';
		}
		
		if(name2.value != ''){
			if(email2.value != ''){
				email2.style.border='1px solid #1b2e3d';
				
				var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				
				if (!filter.test(email2.value)) {
					complete = 0;
					email2.style.border='1px dotted #fd5529';
				}
				else{
					complete += 1;
					email2.style.border='1px solid #1b2e3d';
				}
			}
			else{
				complete = 0;
				email2.style.border='1px dotted #fd5529';
			}
		}
		else{
			email2.style.border='1px solid #1b2e3d';
		}
		
		
		if(complete > 1){
			form.submit();
		}		
	}
	
</script>
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
            	<div style="position: relative; float: left; font-size: 12px; width: 665px; margin-left: 20px;">
                	<h1>Refer a Landlord</h1>
                    <p>
                    	Tell a fellow Landlord about us and collect &pound;45 when they subscribe. You can tell as many people as you like and there is no restriction on the commission you can collect.<br /><br />
                        You can choose if the commission goes to yourself, the Landlord or Charity
                        <br /><br />
                        Being part of LNPG is something that every Landlord can enjoy.  So let others know about LNPG and collect £45 for every new subscriber.
                        <br /><br />
                        Who do you wish to refer?
                        <br /><br />
                        
                        <div style="background: #fff; margin-left: 10px; padding: 10px;">
                            <form id="affiliate" name="affiliate" method="post" action="affiliate_step2.php">
                            
                            	<div style="position: absolute; float: left; width: 20px; height: 75px; border-right: 1px solid #e87f1c; color: #e87f1c; font-weight: bold; font-size: 18px;">
                                	1
                                </div>
                                <div class="fieldblock">
                                    <label>Name:</label>
                                    <div class="input hover">
                                        <input type="text" name="name1" id="name1" maxlength="100" style="width: 300px;" /><span>Required</span>
                                    </div>
                                </div>
                                <div class="fieldblock">
                                    <label>Email address:</label>
                                    <div class="input hover">
                                        <input type="text" name="email1" id="email1" maxlength="100" style="width: 300px;" /><span>Required</span>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; float: left; width: 20px; height: 75px; border-right: 1px solid #e87f1c; color: #e87f1c; font-weight: bold; font-size: 18px; margin-top: 85px;">
                                	2
                                </div>
                            	<div class="fieldblock">
                                    <label>Name:</label>
                                    <div class="input hover">
                                        <input type="text" name="name2" id="name2" maxlength="100" style="width: 300px;" />
                                    </div>
                                </div>
                                <div class="fieldblock">
                                	<label>Email address:</label>
                                    <div class="input hover">
                                        <input type="text" name="email2" id="email2" maxlength="100" style="width: 300px;" /><span>Required if name provided</span>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; float: left; width: 20px; height: 75px; border-right: 1px solid #e87f1c; color: #e87f1c; font-weight: bold; font-size: 18px; margin-top: 170px;">
                                	3
                                </div>
                            	<div class="fieldblock">
                                    <label>Name:</label>
                                    <div class="input hover">
                                        <input type="text" name="name3" id="name3" maxlength="100" style="width: 300px;" />
                                    </div>
                                </div>
                                <div class="fieldblock">
                                	<label>Email address:</label>
                                    <div class="input hover">
                                        <input type="text" name="email3" id="email3" maxlength="100" style="width: 300px;" /><span>Required if name provided</span>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; float: left; width: 20px; height: 75px; border-right: 1px solid #e87f1c; color: #e87f1c; font-weight: bold; font-size: 18px; margin-top: 255px;">
                                	4
                                </div>
                            	<div class="fieldblock">
                                    <label>Name:</label>
                                    <div class="input hover">
                                        <input type="text" name="name4" id="name4" maxlength="100" style="width: 300px;" />
                                    </div>
                                </div>
                                <div class="fieldblock">
                                	<label>Email address:</label>
                                    <div class="input hover">
                                        <input type="text" name="email4" id="email4" maxlength="100" style="width: 300px;" /><span>Required if name provided</span>
                                    </div>
                                </div>
                                
                                <div style="position: absolute; float: left; width: 20px; height: 75px; border-right: 1px solid #e87f1c; color: #e87f1c; font-weight: bold; font-size: 18px; margin-top: 340px;">
                                	5
                                </div>
                            	<div class="fieldblock">
                                    <label>Name:</label>
                                    <div class="input hover">
                                        <input type="text" name="name5" id="name5" maxlength="100" style="width: 300px;" />
                                    </div>
                                </div>
                                <div class="fieldblock">
                                	<label>Email address:</label>
                                    <div class="input hover">
                                        <input type="text" name="email5" id="email5" maxlength="100" style="width: 300px;" /><span>Required if name provided</span>
                                    </div>
                                </div>
                                
                                <div class="clear"></div>
                            
                           		<img src="images/next-btn.png" style="margin-left: 180px; cursor: pointer;" onclick="submitForm();" alt="Next" />
                            </form>
                        </div>
                        
                    </p>
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