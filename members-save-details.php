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
	$sendEmail = "0";
	
	if(isset($_SESSION['email'])){
		if($_POST['updates'] == '1'){
			$sendEmail = "1";
		}
		
		$update = "UPDATE empg_member SET Fullname = '" . $_POST['name'] . "', BusinessName = '" . $_POST['bus_name'] . "', Add1 = '" . $_POST['add1'] . "', City = '" . $_POST['city'] . "', County = '" . $_POST['county'] . "', PostCode = '" . $_POST['post_code'] . "', TelNo = '" . $_POST['tel'] . "', FaxNo = '" . $_POST['fax'] . "', MobNo = '" . $_POST['mob'] . "', sendEmail = '" . $sendEmail . "' WHERE MemberNo = " . $_SESSION['member_no'] . ";";
		
		mysql_query($update);
		
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
                	<h1>My details saved...</h1>
                    
       				<div style="margin-left: 10px; padding: 10px;">
                            
                        <div class="my-label">Email address:</div>
                        <div class="my-data"><?php echo $_SESSION['email'] ?></div>
                        <br />
                        <div class="my-label">Full name:</div>
                        <div class="my-data"><?php echo $name ?></div>
                        <br />
                        <div class="my-label">Business name<br />(if applicable):</div>
                        <div class="my-data"><?php echo $bus_name ?></div>
                        <br />
                        <div class="my-label">House number and Street:</div>
                        <div class="my-data"><?php echo $add1 ?></div>
                        <br />
                        <div class="my-label">City:</div>
                        <div class="my-data"><?php echo $city ?></div>
                        <br />
                        <div class="my-label">County:</div>
                        <div class="my-data"><?php echo $county ?></div>
                        <br />
                        <div class="my-label">Post code:</div>
                        <div class="my-data"><?php echo $post_code ?></div>
                        <br />
                        <div class="my-label">Tel no:</div>
                        <div class="my-data"><?php echo $tel ?></div>
                        <br />
                        <div class="my-label">Fax no:</div>
                        <div class="my-data"><?php echo $fax ?></div>
                        <br />
                        <div class="my-label">Mobile no:</div>
                        <div class="my-data"><?php echo $mob ?></div>
                        
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