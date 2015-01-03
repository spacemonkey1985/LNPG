<?php

	session_start();
	
	include('connect/db_connection.php');	
	
	$name = "";
	$bus_name = "";
	$add1 = "";
	$city = "";
	$county = "";
	$post_code = "";
	$tel =  "";
	$fax = "";
	$mob = "";
	$email = "";
	$referee = "";
	$emailAvailable = 1;
	
	if(isset($_GET['email'])){
		$user = "SELECT * FROM empg_member WHERE email = '" . $_GET['email'] . "';";
										
		if(!$result = mysql_query($user)){
			echo mysql_error();
		}
		else{
			while($row = mysql_fetch_array($result)){
				if($row['PaymentDate'] != null){
					$emailAvailable = 0;
				}
				else{
					$emailAvailable = 1;
					
					$name = $row['Fullname'];
					$bus_name = $row['BusinessName'];
					$add1 = $row['Add1'];
					$city = $row['City'];
					$county = $row['County'];
					$post_code = $row['PostCode'];
					$tel =  $row['TelNo'];
					$fax = $row['FaxNo'];
					$mob = $row['MobNo'];
					$email = $row['Email'];
					$referee = $row['Referee'];
				}
			}
		}	

		mysql_close($conn);
	}	
	
	if(isset($_SESSION['referer_email'])){
		$referee = $_SESSION['referer_email'];
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title>Landlords National Property Group</title>
<link type="text/css" href="stylesheets/common.css" rel="stylesheet" />
<script type="text/javascript">
	function showOther(text){
		var dd = document.getElementById('otherBlock');
		
		if(text == 'other'){
			dd.style.display = 'inline';
		}
		else{
			dd.style.display = 'none';
		}
	}
	function checkUsername(){
		var form = document.getElementById('details');
		
		var email = document.getElementById('email');
		var email_na = document.getElementById('email_na');
		
		window.location = 'join.php?email=' + email.value;
	}
	function submitForm(){
		var form = document.getElementById('details');
		
		var name = document.getElementById('name');
		var add1 = document.getElementById('add1');
		var city = document.getElementById('city');
		var county = document.getElementById('county');
		var post_code = document.getElementById('post_code');
		var tel = document.getElementById('tel');
		var email = document.getElementById('email');
		
		
		var complete = 0;
		
		if(name.value != ''){
			complete += 1;
			name.style.border='1px solid #1b2e3d';
		}
		else{
			name.style.border='1px dotted #fd5529';
		}
		
		if(add1.value != ''){
			complete += 1;
			add1.style.border='1px solid #1b2e3d';
		}
		else{
			add1.style.border='1px dotted #fd5529';
		}
		
		if(city.value != ''){
			complete += 1;
			city.style.border='1px solid #1b2e3d';
		}
		else{
			city.style.border='1px dotted #fd5529';
		}
		
		if(county.value != ''){
			complete += 1;
			county.style.border='1px solid #1b2e3d';
		}
		else{
			county.style.border='1px dotted #fd5529';
		}
		
		if(post_code.value != ''){
			complete += 1;
			post_code.style.border='1px solid #1b2e3d';
		}
		else{
			post_code.style.border='1px dotted #fd5529';
		}
		
		if(tel.value != ''){
			complete += 1;
			tel.style.border='1px solid #1b2e3d';
		}
		else{
			tel.style.border='1px dotted #fd5529';
		}
		
		if(email.value != ''){
			email.style.border='1px solid #1b2e3d';
			
			var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			
			if (!filter.test(email.value)) {
				email.style.border='1px dotted #fd5529';
			}
			else{
				complete += 1;
				email.style.border='1px solid #1b2e3d';
			}
		}
		else{
			email.style.border='1px dotted #fd5529';
		}
		
		if(complete == 7){
			form.submit();
		}		
	}
</script>
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

			<img src="images/join-title.png" alt="About us" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
        	
        	<div style="position: relative; float: left; width: 700px; margin-top: 20px;">
            
            	<div style="position: relative; float: left; font-size: 12px; width: 250px; height: 100px; margin-bottom: 20px;">
                              
                </div>
                
                <span style="font-size: 42px; color: #1b75bc;">Your details</span><br /><br />
                
            	<p style="font-size: 12px; margin-bottom: 20px;">Thank you for choosing the LNPG. Please fill out your details to benefit from LNPG membership.</p>
                
                <div style="margin-left: 70px">
                    <form name="details" id="details" method="post" action="join_step2.php" onsubmit="return submitForm();">
                        
                        <div class="fieldblock">
                            <label>Email address:</label>
                            <div class="input hover">
                                <input type="text" name="email" id="email" maxlength="100" style="width: 300px;" onchange="checkUsername();" value="<?php echo $_GET['email'] ?>" /><span>Required, valid email</span>
                                <br />
                                <?php
                                    if($emailAvailable == 0){
                                        echo "<div id='email_na' style='color: red; font-size: 11px; display: inline;'>This email has all ready been registered</div><br />";
                                    }
                                ?>
                            </div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>Full name:</label>
                            <div class="input hover">
                                <input type="text" name="name" id="name" maxlength="100" style="width: 300px;"  value="<?php echo $name ?>" /><span>Required</span>
                            </div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>Business name<br />(if applicable):</label>
                            <div class="input hover">
                                <input type="text" name="bus_name" id="bus_name" maxlength="100" style="width: 300px;"  value="<?php echo $bus_name ?>" />
                            </div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>House number and Street:</label>
                            <div class="input hover">
                                <input type="text" name="add1" id="add1" maxlength="100" style="width: 300px;"  value="<?php echo $add1 ?>" /><span>Required</span>
                            </div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>City:</label>
                            <div class="input hover">
                                <input type="text" name="city" id="city" maxlength="100" style="width: 300px;"  value="<?php echo $city ?>" /><span>Required</span>
                            </div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>County:</label>
                            <div class="input hover">
                                <input type="text" name="county" id="county" maxlength="100" style="width: 300px;" value="<?php echo $county ?>" /><span>Required</span>
                            </div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>Post code:</label>
                            <div class="input hover">
                                <input type="text" name="post_code" id="post_code" maxlength="50" style="width: 150px;"  value="<?php echo $post_code ?>" /><span>Required</span>
                            </div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>Tel no:</label>
                            <div class="input hover">
                                <input type="text" name="tel" id="tel" maxlength="50" style="width: 150px;"  value="<?php echo $tel ?>" /><span>Required</span>
                            </div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>Fax no:</label>
                            <div class="input hover">
                                <input type="text" name="fax" id="fax" maxlength="50" style="width: 150px;"  value="<?php echo $fax ?>" />
                            </div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>Mobile no:</label>
                            <div class="input hover">
                                <input type="text" name="mob" id="mob" maxlength="50" style="width: 150px;"  value="<?php echo $mob ?>" />
                            </div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>Referred by:</label>
                            <div class="input hover">
                                <input type="text" name="ref" id="ref" maxlength="50" style="width: 300px;"  value="<?php echo $referee ?>" />
                            </div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>How did you hear about us?:</label>
                            <div class="input hover">
                                <select name="hear_about" id="hear_about" onchange="showOther(this.value);">
                                    <option value="blank">-- Please choose one --</option>
                                    <option value="meeting">LNPG Meeting</option>
                                    <option value="PIN">Property Investors Network</option>
                                    <option value="landlord">Through another landlord</option>
                                    <option value="google">Google search</option>
                                    <option value="facebook">Facebook</option>
                                    <option value="twitter">Twitter</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="fieldblock" id="otherBlock" style="display: none;">
                            <label>Please specify:</label>
                            <div class="input hover">
                                <input type="text" name="other" id="other" maxlength="50" style="width: 300px;" />
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <img src="images/next-btn.png" style="margin-left: 180px; cursor: pointer;" onclick="submitForm();" alt="Next" />
                    
                    </form>
                </div>
                    
            </div>
            
            <div style="position: relative; float: right; width: 240px; margin-top: 20px; margin-left: 20px;">
            	
                <img src="images/meeting-header.png" alt="Come to our next meeting" />
                
                <img src="images/map.png" alt="Derbyshire Hotel" />
                
                <a href="venue.php"><img src="images/more-btn.png" alt="Find Out More" style="float: right; margin-top: 20px; margin-bottom: 20px;" /></a>
                
            </div>
            
            <div style="clear: left; height: 20px;"></div>
            
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