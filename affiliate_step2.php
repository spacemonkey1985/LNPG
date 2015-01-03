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
<script type="text/javascript">
	function enableRefer(){
		var agree = document.getElementById('agree');
		var refer = document.getElementById('refer');
		
		if(agree.checked){
			refer.style.display = 'inline';
		}
		else{
			refer.style.display = 'none';
		}
	}
	function submitForm(){
		var form = document.getElementById('affiliate');
		
		form.submit();		
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
                	<li><a href="members-edit.php">My details</a></li>
                    <li class="selected"><a href="affiliate.php">Refer a Landlord</a></li>
                </ul>
            </div>
            
			<img src="images/members-content-top-bg.png" alt="Top border" style="float: right; margin-top: 20px; margin-right: 42px" />
            
            <div class="members-content">
            	<div style="position: relative; float: left; font-size: 12px; width: 665px; margin-left: 20px;">
                	<h1>Refer a Landlord</h1>
                    <p>
                    	By refering other landlords to the Landlords National Property Group, you agree to the following terms and conditions
                        <br /><br />
                        <h2>Terms & Conditions</h2>
                        <ol>
                            <li><p>Members can become Affiliates by entering or uploading Landlords' email addresses to the LNPG website.</p></li>
                            <li><p>A Landlord's email address is tagged to the affiliate on a first come first served basis.  A landlord's email address cannot be tagged to more than one affiliate.</p></li>
                            <li><p>Should the Landlord subsequently join, using the email address supplied by the Affiliate, the Affiliate will receive £45 commission.  The joining Landlord must register with the exact email address that the Affiliate used to refer the landlord for the &pound;45 to become due.</p></li>
                            <li><p>Commission becomes payable 60 days after the referred Landlord's joining date.</p></li>
                            <li><p>Should an Affiliate allow their membership to expire, all commission due prior to the membership expiry will be paid.  Any commission falling due after the date of membership expiry will not be paid.  Upon expiry of membership all connections with the Affiliate program end.  For the removal of doubt, links between the lapsed affiliate and their referred landlords will be removed never to be reinstated if they subsequently join again.</p></li>
                            <li><p>LNPG will use referred Landlords' email addresses to contact them about LNPG products and services.</p></li>
                            <li><p>By giving a Landlord's email addresses to LNPG it is agreed that the member has permission to give that Landlord's email address to 3rd parties for marketing purposes and the member will indemnify LNPG should it be later found that they do not have that permission.</p></li>
                            <li><p>LNPG will not sell the email addresses to 3rd parties.</p></li>
                            <li><p>The decision of LNPG Ltd is final.</p></li>
                        </ol>
                    </p>
                    
                    <form id="affiliate" name="affiliate" method="post" action="affiliate_step3.php">
                        <div class="fieldblock">
                            <label style="width: 230px;">I have read the Terms and Conditions</label>
                            <div class="input hover" style="width: 335px;">
                                <input type="checkbox" name="agree" id="agree" onclick="enableRefer();" />
                    		</div>
                        </div>
                        <input type="hidden" name="name1" id="name1" maxlength="100" style="width: 250px;" value="<?php echo($_POST['name1']); ?>" />
                        <input type="hidden" name="email1" id="email1" maxlength="100" style="width: 250px;"  value="<?php echo($_POST['email1']); ?>" />
                        <input type="hidden" name="name2" id="name2" maxlength="100" style="width: 250px;" value="<?php echo($_POST['name2']); ?>" />
                        <input type="hidden" name="email2" id="email2" maxlength="100" style="width: 250px;" value="<?php echo($_POST['email2']); ?>" />
                        <input type="hidden" name="name3" id="name3" maxlength="100" style="width: 250px;" value="<?php echo($_POST['name3']); ?>" />
                        <input type="hidden" name="email3" id="email3" maxlength="100" style="width: 250px;" value="<?php echo($_POST['email3']); ?>" />
                        <input type="hidden" name="name4" id="name4" maxlength="100" style="width: 250px;" value="<?php echo($_POST['name4']); ?>" />
                        <input type="hidden" name="email4" id="email4" maxlength="100" style="width: 250px;" value="<?php echo($_POST['email4']); ?>" />
                        <input type="hidden" name="name5" id="name5" maxlength="100" style="width: 250px;" value="<?php echo($_POST['name5']); ?>" />
                        <input type="hidden" name="email5" id="email5" maxlength="100" style="width: 250px;" value="<?php echo($_POST['email5']); ?>" />
                        <br />
                        <br />
                        <br />
                       	<div class="clear"></div>
                        
                        <img id="refer" name="refer" src="images/refer-btn.png" style="margin-left: 20px; cursor: pointer; display: none;" onclick="submitForm();" alt="Refer now" />
                    </form>
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