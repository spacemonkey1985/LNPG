<?php

	session_start();		
	
	if(isset($_POST['name'])){
		if($_POST['name'] != ''){
			$to = 'info@lnpg.co.uk';
			$subject = 'LNPG Contact Us - ' . $_POST['queryType'];
			$body = "Name: " . $_POST['name'] . "\r\nEmail: " . $_POST['email'] . "\r\nQuestion:\r\n" . $_POST['question'];
			$headers = 'From: webmaster@lnpg.co.uk' . "\n" .
						'Bcc: simon@simoncoulton.co.uk' . "\n" .
						'Reply-To: info@lnpg.co.uk' . "\n" .
						'X-Mailer: PHP/' . phpversion();
		
			mail($to, $subject, $body, $headers);
			
			$to =  $_POST['email'];
			$subject = 'LNPG Query - ' . $_POST['queryType'];
			$body = "Dear " . $_POST['name'] . "\r\n\r\nThank you for getting in touch. Your query has been sent to our support team and someone will respond as soon as they are available.";
			$headers = 'From: info@lnpg.co.uk' . "\n" .
						'Reply-To: info@lnpg.co.uk' . "\n" .
						'X-Mailer: PHP/' . phpversion();
		
			mail($to, $subject, $body, $headers);
			
			header("Location: contact.php?sent=1");
		}
	}
	
	include('connect/db_connection.php');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title>Landlords National Property Group</title>
<link type="text/css" href="stylesheets/common.css" rel="stylesheet" />
<script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
<script>

	function submitForm(){
		var form = document.getElementById('contact-form');
		
		var name = document.getElementById('name');
		var email = document.getElementById('email');
		var type = document.getElementById('queryType');
		var question = document.getElementById('question');
		
		var complete = 0;
		
		if(name.value != ''){
			complete += 1;
			name.style.border='1px solid #1b2e3d';
		}
		else{
			name.style.border='1px dotted #fd5529';
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
		
		if(question.value != ''){
			complete += 1;
			question.style.border='1px solid #1b2e3d';
		}
		else{
			question.style.border='1px dotted #fd5529';
		}
		
		if(complete == 3){
			form.submit();
		}	
	}
	
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
	  if(getQueryVariable('sent') == '1'){
		  launchWindow('#dialog');
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
</head>

<body>

	<div id="boxes">
    	<div id="dialog" class="window">
        	<a href="contact.php" class="close"><img src="images/modal/modal-top.png" /></a>

			<div style="width: 647px; background-image: url(images/modal/modal-middle.png); background-repeat: repeat-y; margin-top: -10px; padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
                <div style="width: 600px">
                    <h2>Thank you, your query has been posted...</h2>
                    Thanks for taking the time to contact us! Please feel free to ask us any queries via our contact form below. If you'd rather <a href="mailto: info@lnpg.co.uk">send us an email</a>, that's fine too. We try to respond to every email we get, <b>however due to the volume of email we receive, it could take us a little while to write back</b>. Don't worry, we haven't forgotten about you!
                </div>
            </div>
			<img src="images/modal/modal-bottom.png" />
		</div>
        <div id="mask"></div>
    </div>

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

			<img src="images/contact-title.png" alt="About us" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
        	
        	<div style="position: relative; float: left; width: 700px; margin-top: 20px;">
            
            	<div style="position: relative; float: left; font-size: 12px; width: 250px; margin-bottom: 20px;">
                    <span style="font-size: 42px; color: #1b75bc;">Company Address</span>
                    <br />
                    Lyndale House,<br />
                    24 High Street,<br />
                    Addlestone,<br />
                    Surrey,<br />
                    KT15 1TN            
                </div>
                
                <span style="font-size: 42px; color: #1b75bc;">Your query...</span><br /><br />
                
            	<p style="font-size: 12px; margin-bottom: 20px;">Thanks for taking the time to contact us! Please feel free to ask us any queries via our contact form below. If you'd rather <a href="mailto: info@lnpg.co.uk">send us an email</a>, that's fine too. We try to respond to every email we get, <b>however due to the volume of email we receive, it could take us a little while to write back</b>. Don't worry, we haven't forgotten about you!</p>
                
                <div style="margin-left: 70px">
                    <form name="contact-form" id="contact-form" method="post" action="contact.php">
                        
                            <div class="fieldblock">
                                <label>Full name:</label>
                                <div class="input hover"><input type="text" id="name" name="name" tabindex="1" /><span>Required</span></div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Email:</label>
                                <div class="input hover"><input type="text" id="email" name="email" tabindex="2" /><span>Required, valid email</span></div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Query type:</label>
                                <div class="input hover">
                                    <select id="queryType" name="queryType" tabindex="3">
                                        <option value="About LNPG">About LNPG</option>
                                        <option value="LNPG Meetings">LNPG Meetings</option>
                                        <option value="Subscribing to LNPG">Subscribing to LNPG</option>
                                        <option value="Using this site">Using this site</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Question:</label>
                                <div class="input hover">
                                    <textarea name="question" id="question" rows="10" cols="20" tabindex="4"></textarea>
                                </div>
                            </div>
                            
                            <div class="clear"></div>
                            
                            <a href="#" onclick="submitForm();"><img src="images/send-btn.png" alt="Send" style="margin-left: 180px; "/></a>
                            
                            <!-- <input type="image" name="modal" id="modal" src="images/send-btn.png" tabindex="5" value="Submit" style="margin-left: 180px; "/> -->
                        
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