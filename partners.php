<?php
	
	session_start();

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
  launchWindow(id); 
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

</script>
</head>

<body>
	
    <div id="boxes">
        
        <?php
			
			$partners = "SELECT * FROM empg_partners WHERE displayOrder != 0 ORDER BY displayOrder;";
									
			if(!$result = mysql_query($partners)){
				echo mysql_error();
			}
			else{
				while($row = mysql_fetch_array($result)){
					echo("<div id='dialog" . $row['PartnerId'] . "' class='window'>");
					echo("<a href='#' class='close'><img src='images/modal/modal-top.png' /></a>");
					echo("<div style='width: 647px; background-image: url(images/modal/modal-middle.png); background-repeat: repeat-y; margin-top: -10px; padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;'>");
					echo("<div style='width: 600px'>");
					echo("<h2>" . $row['PartnerName'] . "</h2>");
					echo($row['PartnerDescription']);
					// Removed at request of Nick Watchorn
					// echo("<div style='text-align: right;'>Find out more at <a href='http://" . $row['PartnerURL'] . "' target='_blank'>" . $row['PartnerURL'] . "</a></div>");
					echo("</div>");
					echo("</div>");
					echo("<img src='images/modal/modal-bottom.png' />");
					echo("</div>");
				}
			}
		
		?>
        
        <!-- Do not remove div#mask, because you'll need it to fill the whole screen -->	
        <div id="mask"></div>
    </div>
    
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

			<img src="images/partners-title.png" alt="Our Partners" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
            
            <div class="left-column-alt">
            
            	<?php
			
					$partners = "SELECT * FROM empg_partners WHERE displayOrder != 0 ORDER BY displayOrder;";
											
					if(!$result = mysql_query($partners)){
						echo mysql_error();
					}
					else{
						while($row = mysql_fetch_array($result)){
							echo("<div class='partner-logo' >");
							echo("<a href='#dialog" . $row['PartnerId'] . "' name='modal'><img src='" . $row['PartnerLogo'] . "' alt='" . $row['PartnerName'] . "' style='border: 0px; margin-top: 10px; height: 85%;' /></a>");
							echo("</div>");
						}
					}	
	
					mysql_close($conn);
				
				?>
                
                <br />
            	<br />
            
            </div>
            
            <div class="right-column-alt">
            	<a href="join.php"><img src="images/join-ad.png" alt="Join now" style="margin-top: -15px;" /></a>
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