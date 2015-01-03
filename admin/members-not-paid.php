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
	include('../includes/common.php');
	
	$key='r8181055';
	
	if(isset($_GET['activate'])){
		$update_member = "UPDATE empg_member SET Active = 1 WHERE MemberNo = " . $_GET['activate'] . ";";
										
		mysql_query($update_member);
		
		if(is_dir("../images/members/" . $member_no)){
			copy("../images/members/avatar.jpg", "../images/members/" . $member_no . "/avatar.jpg");
		}
		else{
			if(mkdir("../images/members/" . $member_no)){
				copy("../images/members/avatar.jpg", "../images/members/" . $member_no . "/avatar.jpg");
			}
		}
	}
	if(isset($_GET['deactivate'])){
		$update_member = "UPDATE empg_member SET Active = 0 WHERE MemberNo = " . $_GET['deactivate'] . ";";
										
		mysql_query($update_member);
		
		if(is_dir("../images/members/" . $member_no)){
			copy("../images/members/avatar.jpg", "../images/members/" . $member_no . "/avatar.jpg");
		}
		else{
			if(mkdir("../images/members/" . $member_no)){
				copy("../images/members/avatar.jpg", "../images/members/" . $member_no . "/avatar.jpg");
			}
		}
	}
	if(isset($_GET['email'])){
		$member_no = $_GET['email'];
		$password = createRandomPassword();
		
		$update_member = "UPDATE empg_member SET DateTimeStamp = CURDATE(), Password = '" . $password . "' WHERE MemberNo = " . $member_no . ";";
		
		mysql_query($update_member);
		
		$details = "SELECT * FROM empg_member WHERE MemberNo = " . $member_no . ";";
							
		if(!$result = mysql_query($details)){
			echo mysql_error();
		}
		else{
			while($row = mysql_fetch_array($result)){
				$email = $row['Email'];
				$name = $row['Fullname'];
			}
		}

		$to = $email;
		$subject = 'Welcome to the LNPG Discount Club - Please save these details';
		
		$body = 'Your unique LNPG membership No is:
01' . str_pad((int) $member_no,3,"0",STR_PAD_LEFT) . '


The first thing you need to do is activate your account. Please follow the link below:
http://www.LNPG.co.uk/login.php?activate=' . urlencode(base64_encode($member_no)) . '

Once your account is activated, click on the Member\'s area link on the LNPG home page and enter the following details.

Username:
' . $email . '

Password:
' . $password . '

We recommend you change your password immediately and keep a note of it somewhere safe.

Once in the member\'s area follow the instructions for how to, either buy immediately or, initiate accounts with our partners.

If you have any problems with your membership or need advice on how to purchase please contact us on 01932 698146 quoting your name and membership number. 

In addition to the discounts you will enjoy, on the first Monday of every month we host a property meeting in the East Midlands where like-minded landlords gather to hear invited speakers delivering valuable information and we update everyone with news of new partners and the future for LNPG members.

The meeting is open to members and non-members alike and is a great opportunity to network with people like yourself who have an interest in property and their portfolios. For details please visit www.LNPG.co.uk

Please keep this email in a safe place for future reference.

Enjoy your membership and very best wishes from LNPG.

Best Regards
Peter Francis';
	
		mail($to, $subject, $body, 'From: info@LNPG.co.uk');
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title>Landlords National Property Group</title>
<script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
<script>

	$(document).ready(function() {	
	
		//select all the a tag with name equal to modal
		$('a[name=modal]').click(function(e) {
			//Cancel the link behavior
			e.preventDefault();
			//Get the A tag
			var id = $(this).attr('href');
		
			//Get the screen height and width
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		
			//Set height and width to mask to fill up the whole screen
			$('#mask').css({'width':maskWidth,'height':maskHeight});
			
			//transition effect		
			$('#mask').fadeIn(1000);	
			$('#mask').fadeTo("slow",0.8);	
		
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
				  
			//Set the popup window to center
			$(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);
		
			//transition effect
			$(id).fadeIn(2000); 
		
		});
		
		//if close button is clicked
		$('.window .close').click(function (e) {
			//Cancel the link behavior
			e.preventDefault();
			$('#mask, .window').hide();
		});		
		
		//if mask is clicked
		$('#mask').click(function () {
			$(this).hide();
			$('.window').hide();
		});			
		
	});
	
	$(document).ready(function () {
	  //id is the ID for the DIV you want to display it as modal window
	  if(getQueryVariable('activate') != '0'){
		  launchWindow('#activated');
	  }
	  if(getQueryVariable('deactivate') != '0'){
		  launchWindow('#deactivated');
	  }
	  if(getQueryVariable('email') != '0'){
		  launchWindow('#email');
	  }
	});
	
	$(document).keyup(function(e) {
	  if(e.keyCode == 13) {
		$('#mask').hide();
		$('.window').hide();
	  }
	});
	
	$(window).resize(function () {
		
			//Get the screen height and width
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		 
			//Set height and width to mask to fill up the whole screen
			$('#mask').css({'width':maskWidth,'height':maskHeight});
				  
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
				   
			//Set the popup window to center
			$(id).css('top',  winH/2-$(id).height()/2);
			$(id).css('left', winW/2-$(id).width()/2);
	
	});
	
	function launchWindow(id) {
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height());
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	}
	
	function getQueryVariable(variable) { 
  		var query = window.location.search.substring(1); 
  		var vars = query.split("&"); 
  
  		for (var i=0;i<vars.length;i++) { 
    		var pair = vars[i].split("="); 
    
			if (pair[0] == variable) { 
      			return pair[1]; 
    		} 
  		} 
  		return "0"; 
	} 

</script>
<link type="text/css" href="../stylesheets/common.css" rel="stylesheet" />
</head>

<body>
    
    <div id="boxes">
    	<div id="activated" class="window">
        	<a href="members-not-paid.php" class="close"><img src="../images/modal/modal-top.png" /></a>

			<div style="width: 647px; background-image: url(../images/modal/modal-middle.png); background-repeat: repeat-y; margin-top: -10px; padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
                <div style="width: 600px">
                    <h2>Member activation sucessful...</h2>
                    <?php 
						if(isset($_GET['activate'])){
							echo "Member M001" . str_pad((int) $_GET['activate'],3,"0",STR_PAD_LEFT) . " was sucessfully <b>activated</b>!"; 
						}
					?>
                </div>
            </div>
			<img src="../images/modal/modal-bottom.png" />
		</div>
        <div id="deactivated" class="window">
        	<a href="members-not-paid.php" class="close"><img src="../images/modal/modal-top.png" /></a>

			<div style="width: 647px; background-image: url(../images/modal/modal-middle.png); background-repeat: repeat-y; margin-top: -10px; padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
                <div style="width: 600px">
                    <h2>Member deactivation sucessful...</h2>
                    <?php 
						if(isset($_GET['deactivate'])){
							echo "Member M001" . str_pad((int) $_GET['deactivate'],3,"0",STR_PAD_LEFT) . " was sucessfully <b>deactivated</b>!"; 
						}
					?>
                </div>
            </div>
			<img src="../images/modal/modal-bottom.png" />
		</div>
        <div id="email" class="window">
        	<a href="members-not-paid.php" class="close"><img src="../images/modal/modal-top.png" /></a>

			<div style="width: 647px; background-image: url(../images/modal/modal-middle.png); background-repeat: repeat-y; margin-top: -10px; padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
                <div style="width: 600px">
                    <h2>Members details sent...</h2>
                    <?php 
						if(isset($_GET['email'])){
							echo "Member M001" . str_pad((int) $_GET['email'],3,"0",STR_PAD_LEFT) . "'s details were sucessfully <b>sent</b>!"; 
						}
					?>
                </div>
            </div>
			<img src="../images/modal/modal-bottom.png" />
		</div>
        <div id="mask"></div>
    </div>
    
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
                	<li><a href="members.php">Members</a></li>
                	<li><a href="members-paid.php">Unactivated</a></li>
                	<li class="selected"><a href="members-not-paid.php">Not Paid</a></li>
                </ul>
            </div>
            
			<img src="../images/members-content-top-bg.png" alt="Top border" style="float: right; margin-top: 20px; margin-right: 42px" />
            
            <div class="members-content">
            	<div style="position: relative; float: left; font-size: 12px; width: 665px; margin-left: 20px;">
                	<div style="float: right; line-height: 24px;">
                    	<a href="members-export.php?type=unpaid" target="_blank"><img src="../images/export-btn.png" alt="Export" style="padding-right: 15px; vertical-align: middle;" />Export</a>
                    </div>
                    
                    <h1>Unpaid Members</h1>
                    
       				<p>
                            
                        <table cellpadding="3" class="member-list">
                            <tr>
                                <td width="70px"><b>Member no</b></td>
                                <td width="90px"><b>Full name</b></td>
                                <td width="100px"><b>Address</b></td>
                                <td width="90px"><b>Tel no</b></td>
                                <td width="100px"><b>Email</b></td>
                                <td width="80px"><b>Join Date</b></td>
                                <td colspan="3"></td>
                            </tr>
                            
                            <?php
                                
                                $members = "SELECT * FROM empg_member WHERE Password is null;";
                                                
								if(!$result = mysql_query($members)){
									echo mysql_error();
								}
								else{
									while($row = mysql_fetch_array($result)){
										echo("<tr>");
										echo("<td style='vertical-align: top;'>M001" . str_pad((int) $row['MemberNo'],3,"0",STR_PAD_LEFT) . "</td>");
										echo("<td style='vertical-align: top;'>" . $row['Fullname'] . "</td>");
										echo("<td style='vertical-align: top;'>" . $row['Add1'] . "<br />" . $row['City'] . "<br />" . $row['County'] . "<br />" . $row['PostCode'] . "</td>");
										echo("<td style='vertical-align: top;'>" . $row['TelNo'] . "</td>");
										echo("<td style='vertical-align: top;'><a href='mailto:" . $row['Email'] . "'>" . $row['Email'] . "</a></td>");
										
										if($row['JoinDate'] == '' || $row['JoinDate'] ==  null)
										{
											echo("<td style='vertical-align: top;'></td>");
										}
										else
										{
											echo("<td style='vertical-align: top;'>" . date_format(date_create($row['JoinDate']), 'd-m-Y') . "</td>");
										}
										
										echo("<td style='vertical-align: top; text-align: center;'><a href='member-edit.php?member='" . $row['MemberNo'] . "'><img src='../images/edit-btn.png' alt='Edit' title='Edit member' style='border: none;' /></a></td>");
										
										if($row['Active'] == 1){
											echo("<td style='vertical-align: top; text-align: center;'><a href='members-not-paid.php?deactivate=" . $row['MemberNo'] . "'><img src='../images/deactivate-btn.png' alt='Deactivate' title='Deactivate member' style='border: none;' /></a></td>");
										}
										else{
											echo("<td style='vertical-align: top; text-align: center;'><a href='members-not-paid.php?activate=" . $row['MemberNo'] . "'><img src='../images/activate-btn.png' alt='Activate' title='Activate member' style='border: none;' /></a></td>");
										}
										
										echo("<td style='vertical-align: top; text-align: center;'><a href='members-not-paid.php?email=" . $row['MemberNo'] . "'><img src='../images/mail-btn.png' alt='Send email' title='Send email' style='border: none;' /></a></td>");
										
										echo("</tr>");
									}
								}	
				
								mysql_close($conn);
                                
                            ?>
                            
                        </table>
                        
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