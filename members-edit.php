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
	
	if(isset($_SESSION['email'])){
		$user = "SELECT * FROM empg_member WHERE email = '" . $_SESSION['email'] . "';";
										
		if(!$result = mysql_query($user)){
			echo mysql_error();
		}
		else{
			while($row = mysql_fetch_array($result)){	
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
				$referr = $row['Referee'];
				$sendEmail = $row['sendEmail'];
			}
		}	

		mysql_close($conn);
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
                	<li class="selected"><a href="members-edit.php">My details</a></li>
                    <li><a href="affiliate.php">Refer a Landlord</a></li>
                </ul>
            </div>
            
			<img src="images/members-content-top-bg.png" alt="Top border" style="float: right; margin-top: 20px; margin-right: 42px" />
            
            <div class="members-content">
            	<div style="position: relative; float: left; font-size: 12px; width: 665px; margin-left: 20px;">
                	<h1>My details</h1>
                    
       				<div style="background: #fff; margin-left: 10px; padding: 10px;">
                        <form name="details" id="details" method="post" action="members-save-details.php">
                            <input type="hidden" name="memberNo" id="memberNo" value="<?php echo $row['MemberNo']; ?>" />
                            
                            <div class="fieldblock">
                                <label>Email address:</label>
                                <div class="input hover">
                                    <input type="text" name="email" id="email" maxlength="100" style="width: 300px;" onchange="checkUsername();" disabled="disabled" value="<?php echo $_SESSION['email'] ?>" /><span>Required</span>
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
                        		<label>Please use my details to send me information:</label>
                            	<div class="input hover" style="height: 50px; line-height: 50px;">
                                	<input type="checkbox" name="updates" id="updates" <?php if($sendEmail == '1'){echo('checked="checked"');} ?> value="1" />
                            	</div>
                            </div>
                            
                            <div class="clear"></div>
                            
                            <img src="images/next-btn.png" style="margin-left: 180px; cursor: pointer;" onclick="submitForm();" alt="Next" />
                        </form>
                    </div>             
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