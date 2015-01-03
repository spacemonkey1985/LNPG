<?php

	session_start();
	
	include('connect/db_connection.php');		
	
	if(isset($_POST['name'])){
		$query = "INSERT INTO empg_testimonials(Member, MemberType, Active, Testimonial) VALUES('" . $_POST['name'] . "', '" . $_POST['memberType'] . "', 0, '" . $_POST['testimonial'] . "');";
		
		mysql_query($query);
		
		
	$to = 'info@lnpg.co.uk';
	$subject = 'Landlord testimonial' . $_POST['queryType'];
	$body = "Name: " . $_POST['name'] . 
			"\nMemberType: " . $_POST['memberType'] . 
			"\nTestimonial: \n" . $_POST['testimonial'];
	$headers = "From: webmaster@lnpg.co.uk\n" .
				"Reply-To: info@lnpg.co.uk\n" .
				"X-Mailer: PHP/" . phpversion();
	
	mail($to, $subject, $body, $headers);
		
		header("Location: testimonials.php?sent=1");
	}
	
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
		var form = document.getElementById('testimonial-form');
		
		var name = document.getElementById('name');
		var type = document.getElementById('memberType');
		var testimonial = document.getElementById('testimonial');
		
		var complete = 0;
		
		if(name.value != ''){
			complete += 1;
			name.style.border='1px solid #1b2e3d';
		}
		else{
			name.style.border='1px dotted #fd5529';
		}
		
		if(testimonial.value != ''){
			complete += 1;
			testimonial.style.border='1px solid #1b2e3d';
		}
		else{
			testimonial.style.border='1px dotted #fd5529';
		}
		
		if(complete == 2){
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
<script type="text/javascript" src="javascript/swfobject.js"></script>
<script type="text/javascript">
	var flashvars = {};
	var params = {};
	params.scale = "noscale";
	params.salign = "tl";
	params.wmode = "transparent";
	params.allowScriptAccess = "always";
	params.allowFullScreen = "true";			
	var attributes = {};
	swfobject.embedSWF("flash/YouTubePlayer.swf", "testimonial-videos", "500", "300", "9.0.0", false, flashvars, params, attributes);
</script>
</head>

<body>

	<div id="boxes">
    	<div id="dialog" class="window">
        	<a href="contact.php" class="close"><img src="images/modal/modal-top.png" /></a>

			<div style="width: 647px; background-image: url(images/modal/modal-middle.png); background-repeat: repeat-y; margin-top: -10px; padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
                <div style="width: 600px">
                    <h2>Thank you, your testimonial has been posted...</h2>
                    Thanks for taking the time to let us know how you have benefited from LNPG membership! Your comment has been submitted for approval so you may not see it on the site straight away. Don't worry, we haven't forgotten about you!
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

			<img src="images/testimonials-title.png" alt="About us" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
        	
        	<div style="position: relative; float: left; width: 500px; margin-top: 20px;">
            
            	<div class="testimonial-videos" style="margin-bottom: 20px;">
                    <div id="testimonial-videos">
                        <iframe width="500" height="284" src="https://www.youtube.com/embed/q4EPuhox9v8" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
                
                <img src="images/testimonials-subtitle.png" alt="Please tell us what you have benefitted from by joining LNPG" style="margin-bottom: 15px;" />
                
                <p style="font-size: 12px;">
                	We would like to hear from you, <b>our landlords</b> on how you've benefited from joining the largest landlords discount club in the UK. Please fill out the form below, it only takes a few minutes and we'd really like to receive <b>your views</b>. Thank you.
                </p>
                
                <div style="margin-top: 20px; margin-left: -25px;">
                    <form name="testimonial-form" id="testimonial-form" method="post" action="testimonials.php">
                    
                        <div class="fieldblock">
                            <label>Full name:</label>
                            <div class="input hover"><input type="text" id="name" name="name" tabindex="1" /><span>Required</span></div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>Member type:</label>
                            <div class="input hover">
                            	<select id="memberType" name="memberType" tabindex="2">
                                	<option value="New member">New member</option>
                                    <option value="Established member">Established member</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>Message:</label>
                            <div class="input hover">
                            	<textarea name="testimonial" id="testimonial" rows="10" cols="20" tabindex="3" style="width: 330px;"></textarea>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <a href="#" onclick="submitForm();"><img src="images/send-btn.png" alt="Send" style="margin-left: 180px; "/></a>
                    
                    </form>
                </div>

            </div>
            
            <div style="position: relative; float: right; width: 440px; margin-top: 20px; margin-left: 20px;">
            	
                <?php
                    
					$testimonials = "SELECT * FROM empg_testimonials WHERE Active = 1 ORDER BY Testimonial ASC;";
										
					if(!$result = mysql_query($testimonials)){
						echo mysql_error();
					}
					else{
						while($row = mysql_fetch_array($result)){
							echo("<div style='width: 440px; background-image: url(images/top-quote-marks.png); background-repeat: no-repeat; padding-top: 30px;'>");
							echo("<div class='quote-text-testimonial'>");
							echo("<i>" . $row['Testimonial'] . "</i>");
							echo("</div>");
							echo("<div class='quote-person-testimonial'>");
                    		echo($row['Member'] . ",<br />");
                    		echo("<span style='font-size: 14px'>" . $row['MemberType'] . "</span>");
                			echo("</div>");
							echo("</div>");
							echo("<div style='height: 54px; width: 440px; background-image: url(images/bottom-quote-marks.png); background-repeat: no-repeat; 
	background-position: right; margin-bottom: 20px; margin-top: 10px;'>");
							echo("</div>");
						}
					}	
	
					mysql_close($conn);
				
				?>
                
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