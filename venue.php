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
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript">   
	function initialize() {     
		var latlng = new google.maps.LatLng(53.103294, -1.323532);     
		var myOptions = {      
			zoom: 16,       
			center: latlng,       
			mapTypeId: google.maps.MapTypeId.ROADMAP     
			};     
		
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		
		//setMarkers(map, beaches); 
		
		var marker = new google.maps.Marker({       
			position: latlng,       
			title:"The Derbyshire Hotel"   
		});
		
		marker.setMap(map);
	}
	
	var beaches = [['The Derbyshire Hotel', 53.1034144, -1.3237978]]; 
	
	function setMarkers(map, locations) {   
		// Add markers to the map    
		// Marker sizes are expressed as a Size of X,Y   
		// where the origin of the image (0,0) is located   
		// in the top left of the image.    
		// Origins, anchor positions and coordinates of the marker   
		// increase in the X direction to the right and in   
		// the Y direction down.   
		
		var image = new google.maps.MarkerImage('images/beachflag.png',       
		// This marker is 20 pixels wide by 32 pixels tall.       
		new google.maps.Size(20, 32),       
		// The origin for this image is 0,0.       
		new google.maps.Point(0,0),       
		// The anchor for this image is the base of the flagpole at 0,32.       
		new google.maps.Point(0, 32));   
		var shadow = new google.maps.MarkerImage('images/beachflag_shadow.png',       
		// The shadow image is larger in the horizontal dimension       
		// while the position and offset are the same as for the main image.       
		new google.maps.Size(37, 32),       
		new google.maps.Point(0,0),       
		new google.maps.Point(0, 32));       
		// Shapes define the clickable region of the icon.       
		// The type defines an HTML <area> element 'poly' which       
		// traces out a polygon as a series of X,Y points. The final       
		// coordinate closes the poly by connecting to the first       
		// coordinate.   
		var shape = {       
			coord: [1, 1, 1, 20, 18, 20, 18 , 1],      
			type: 'poly'   
		};   
		
		for (var i = 0; i < locations.length; i++) {     
			var beach = locations[i];     
			var myLatLng = new google.maps.LatLng(beach[1], beach[2]);     
			var marker = new google.maps.Marker({         
				position: myLatLng,         
				map: map,         
				shadow: shadow,         
				icon: image,         
				shape: shape,         
				title: beach[0],         
				zIndex: beach[3]     
			});   
		} 
	}
</script>
</head>

<body onload="initialize();">

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

			<img src="images/meeting-title.png" alt="LNPG Meetings" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
        	
        	<div style="position: relative; float: left; width: 700px; margin-top: 20px;">
            
            	<div style="position: relative; float: left; font-size: 12px; width: 250px; margin-bottom: 20px; min-height: 300px; padding-right: 10px;">
                    <span style="font-size: 42px; color: #1b75bc; margin-bottom: 10px;">Download meeting invite</span>
                    <br /><br />
                    For your convenience, we've packaged our meetings in to this neat and tidy <b>iCal</b> meeting invite. Please feel free to <a href="meeting_invite.ics">download</a> it now or for future reference.
                               
                </div>
                
                <span style="font-size: 42px; color: #1b75bc;">Where to come to...</span><br /><br />
                
            	<p style="font-size: 12px; margin-bottom: 20px;">On the <b>first Monday of every month</b> we host a property meeting in the East Midlands where like-minded landlords gather to hear invited speakers delivering valuable information and we update everyone with news of new partners and the future for LNPG members. 
                            <br /><br />
                            The meeting is open to members and non-members alike and is a great opportunity to network with people like yourself who have an interest in property and their portfolios.</p>
                
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="return" value="http://www.LNPG.co.uk/meeting_booked.php"><input type="hidden" name="hosted_button_id" value="UXCXDM49T9QDU">
                    <input type="image" src="images/book-btn.png" border="0" name="submit" alt="Book now">
                    <img alt="" border="0" src="images/book-btn.png" width="1" height="1">
                </form>
                
                <div id="map_canvas" style="margin-top: 20px; margin-left: 25px; width:440px; height:420px; margin-bottom: 20px;"></div>        

            </div>
            
            <div style="position: relative; float: right; width: 240px; margin-top: 20px; margin-left: 20px;">
            	
                <a href="contact.php"><img src="images/contact-ad.png" alt="Contact us" /></a>
                
            </div>
            
            <div style="clear: right; height: 20px;"></div>
            
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