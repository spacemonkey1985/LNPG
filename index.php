<?php

//	if (isset($_GET))
//	{
//		echo "GET: \n";
//		foreach ($_GET as $ind=>$val)
//		  {
//			echo "$ind : $val\n"; 
//		  } 
//		echo "-----------------------------------------------------------------\n" ;
//	}
	session_start();
	
	include('connect/db_connection.php');
	
	if(isset($_POST['name'])){
		$query = "INSERT INTO empg_subscriptions(Name, Email) VALUES('" . $_POST['name'] . "', '" . $_POST['email'] . "');";
		
		mysql_query($query);
		
		$to = 'newsletter@lnpg.co.uk';
		$subject = 'LNPG newsletter request';
		$body = "Name: " . $_POST['name'] . "\r\nEmail: " . $_POST['email'];
		$headers = 'From: webmaster@lnpg.co.uk' . "\n" .
					'Reply-To: newsletter@lnpg.co.uk' . "\n" .
					'X-Mailer: PHP/' . phpversion();
	
		mail($to, $subject, $body, $headers);
		
		header("Location: index.php?sent=1");
	}
	
	include('includes/common.php');
	
	$key='r8181055';
	
	if(isset($_GET['refer'])){
		$refer = urldecode(base64_decode($_GET['refer']));
		
		$referer = "SELECT Fullname, Email FROM empg_member where MemberNo = " . $refer;
		
		if(!$result = mysql_query($referer)){
			echo mysql_error();
		}
		else{
			while($row = mysql_fetch_array($result)){
				$_SESSION['referer_no'] = $refer;
				$_SESSION['referer_name'] = $row['Fullname'];
				$_SESSION['referer_email'] = $row['Email'];
			}
		}
	}
	// Analytics tracking codes to session vars
	if (isset($_GET['utm_source'])) $_SESSION['utm_source'] = $_GET['utm_source'];
	if (isset($_GET['utm_medium'])) $_SESSION['utm_medium'] = $_GET['utm_medium'];
	if (isset($_GET['utm_campaign'])) $_SESSION['utm_campaign'] = $_GET['utm_campaign'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<meta name="keywords" content="LNPG, Landlords National Property Group, Property Group, Landlords Discount Group, landlords discount club, Landlords Group" />
<meta name="description" content="At the landlords discount club (landlords discount group) we offer a unique and brand new concept to property investment." />
<title>Landlords Discount Club - Landlords Discount Group - Home</title>
<link type="text/css" href="stylesheets/common.css" rel="stylesheet" />
<script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>

<link rel="stylesheet" href="stylesheets/nivo-slider.css" type="text/css" media="screen" />
<script src="javascript/jquery.nivo.slider.pack.js" type="text/javascript"></script>

<script>

	function submitForm(){
		var form = document.getElementById('contact-form');
		
		var name = document.getElementById('name');
		var email = document.getElementById('email');
		
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
		
		if(complete == 2){
			form.submit();
		}	
	}

$(window).load(function() {
    $('#slider-tag').nivoSlider({
        effect: 'fade', // Specify sets like: 'fold,fade,sliceDown'
							//sliceDown
							//sliceDownLeft
							//sliceUp
							//sliceUpLeft
							//sliceUpDown
							//sliceUpDownLeft
							//fold
							//fade
							//random
							//slideInRight
							//slideInLeft
							//boxRandom
							//boxRain
							//boxRainReverse
							//boxRainGrow
							//boxRainGrowReverse
        slices: 15, // For slice animations
        boxCols: 8, // For box animations
        boxRows: 4, // For box animations
        animSpeed: 700, // Slide transition speed
        pauseTime: 5000, // How long each slide will show
        startSlide: 0, // Set starting Slide (0 index)
        directionNav: false, // Next & Prev navigation
        directionNavHide: true, // Only show on hover
        controlNav: true, // 1,2,3... navigation
        controlNavThumbs: false, // Use thumbnails for Control Nav
        controlNavThumbsFromRel: false, // Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', // Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
        keyboardNav: true, // Use left & right arrows
        pauseOnHover: true, // Stop animation while hovering
        manualAdvance: false, // Force manual transitions
        captionOpacity: 0.8, // Universal caption opacity
        prevText: 'Prev', // Prev directionNav text
        nextText: 'Next', // Next directionNav text
        randomStart: false, // Start on a random slide
        beforeChange: function(){}, // Triggers before a slide transition
        afterChange: function(){}, // Triggers after a slide transition
        slideshowEnd: function(){}, // Triggers after all slides have been shown
        lastSlide: function(){}, // Triggers when last slide is shown
        afterLoad: function(){} // Triggers when slider has loaded
    });
    $('#slider-promo').nivoSlider({
        effect: 'slideInLeft', // Specify sets like: 'fold,fade,sliceDown'     
							//sliceDown
							//sliceDownLeft
							//sliceUp
							//sliceUpLeft
							//sliceUpDown
							//sliceUpDownLeft
							//fold
							//fade
							//random
							//slideInRight
							//slideInLeft
							//boxRandom
							//boxRain
							//boxRainReverse
							//boxRainGrow
							//boxRainGrowReverse
        slices: 15, // For slice animations
        boxCols: 8, // For box animations
        boxRows: 4, // For box animations
        animSpeed: 700, // Slide transition speed
        pauseTime: 5000, // How long each slide will show
        startSlide: 0, // Set starting Slide (0 index)
        directionNav: true, // Next & Prev navigation
        directionNavHide: false, // Only show on hover
        controlNav: true, // 1,2,3... navigation
        controlNavThumbs: false, // Use thumbnails for Control Nav
        controlNavThumbsFromRel: false, // Use image rel for thumbs
        controlNavThumbsSearch: '.jpg', // Replace this with...
        controlNavThumbsReplace: '_thumb.jpg', // ...this in thumb Image src
        keyboardNav: true, // Use left & right arrows
        pauseOnHover: true, // Stop animation while hovering
        manualAdvance: false, // Force manual transitions
        captionOpacity: 0.6, // Universal caption opacity
        prevText: 'Prev', // Prev directionNav text
        nextText: 'Next', // Next directionNav text
        randomStart: false, // Start on a random slide
        beforeChange: function(){}, // Triggers before a slide transition
        afterChange: function(){}, // Triggers after a slide transition
        slideshowEnd: function(){}, // Triggers after all slides have been shown
        lastSlide: function(){}, // Triggers when last slide is shown
        afterLoad: function(){} // Triggers when slider has loaded
    });
});	
	
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
	  launchWindow('#dialog2');
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
        	<a href="#" class="close"><img src="images/modal/modal-top.png" /></a>

			<div style="width: 647px; background-image: url(images/modal/modal-middle.png); background-repeat: repeat-y; margin-top: -10px; padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
                <div style="width: 600px">
                    <h2>Subscribe to our email bulletins... for free!</h2>
                    <form name="contact-form" id="contact-form" method="post" action="index.php">
                        
                        <div class="fieldblock">
                            <label>Full name:</label>
                            <div class="input hover"><input type="text" id="name" name="name" tabindex="1" /><span>Required</span></div>
                        </div>
                        
                        <div class="fieldblock">
                            <label>Email:</label>
                            <div class="input hover"><input type="text" id="email" name="email" tabindex="2" /><span>Required, valid email</span></div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <a href="#" onclick="submitForm();"><img src="images/send-btn.png" alt="Send" style="margin-left: 180px; "/></a>
                        
                        <!-- <input type="image" name="modal" id="modal" src="images/send-btn.png" tabindex="5" value="Submit" style="margin-left: 180px; "/> -->
                    
                    </form>
                </div>
            </div>
			<img src="images/modal/modal-bottom.png" />
		</div>
        <div id="dialog2" class="window">
        	<a href="index.php" class="close"><img src="images/modal/modal-top.png" /></a>

			<div style="width: 647px; background-image: url(images/modal/modal-middle.png); background-repeat: repeat-y; margin-top: -10px; padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
                <div style="width: 600px">
                    <h2>Thank you, you have been added to our distribution list...</h2>
                    Thanks for taking the time to visit us and subscribe to our updates! Please feel free to ask us any queries via our contacts page. If you'd rather <a href="mailto: info@lnpg.co.uk">send us an email</a>, that's fine too. We try to respond to every email we get, <b>however due to the volume of email we receive, it could take us a little while to write back</b>. Don't worry, we haven't forgotten about you!
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
    
    <!-- Advert banner -->

    <div class="promo-banner">
    	<div class="promo-banner-content">

            <div id="slider-tag" class="nivoSlider-tag">
                <img src="images/tag-line/tag-line.jpg" alt="" title="" /> <!--Set title for caption-->
                <a href="comparisons.php"><img src="images/tag-line/magnet-deal.jpg" alt="" /></a>
                <img src="images/tag-line/new-century-deal.jpg" alt="" />
                <img src="images/tag-line/pts-deal-2.jpg" alt="" />
                <img src="images/tag-line/tag-line.jpg" alt="" title="" />
                <img src="images/tag-line/pts-deal.jpg" alt="" />
                <img src="images/tag-line/tag-line.jpg" alt="" title="" />
            </div>
<!--            <div id="htmlcaption-tag" class="nivo-html-caption">
                <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
            </div>
-->        
            <div id="slider-promo" class="nivoSlider-promo">
                <a href="comparisons.php"><img src="images/promo-rotator/kitchens.jpg" alt=""  title="Magnet Contract Kitchen Solutions - kitchens" /></a>
                <img src="images/promo-rotator/bathrooms.jpg" alt=""  title="PTS - Boilers, bathrooms and heating" />
                <img src="images/promo-rotator/carpets.jpg" alt="" title="Designer Contracts - carpets and flooring" />
                <img src="images/promo-rotator/doors.jpg" alt=""  title="New Century Doors - doors" />
                <a href="partners.php"><img src="images/promo-rotator/partners.jpg" alt="" title="Our Discount Partners" /></a>
            </div>
<!--            <div id="htmlcaption-promo" class="nivo-html-caption">
                <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>.
            </div>
-->            

            <a href="about.php" class="more-btn"><img src="images/more-btn.png" alt="Find Out More" /></a>
            <a href="#dialog" name="modal" class="updates-btn"><img src="images/updates-btn.png" alt="Get Free Updates" /></a>
        </div>
    </div>

    <!-- End Advert banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="home-content-content">
        
        	<a href="about.php" class="wade-lyn"><img src="images/wade-lyn.png" alt="Supported by Wade Lyn, HRH Prince Charles' Ambassador for West Midlands and Managing Director, Cleone Foods" style="padding-bottom: 30px; margin-top: -10px;" /></a>
            
            <div class="quote" onclick="window.location = 'testimonials.php';">
            	<div class="quote-text">
                
            		<i>I recommend joining LNPG if you are a landlord. You must become members if you have any number of properties at all</i>
                    
				</div>
                
                <div class="quote-person">
                    Roger Lancaster,<br />
                    <span style="font-size: 14px">Established member</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- End Content -->

	<!-- Home special content -->
    
    <div class="home-special">
    	<div class="home-special-content">
        
        	<div class="checklist" onclick="window.location = 'join.php';">
            	
                <div class="checklist-text">
                    <ul>
                        <li>Save money on your refurbishment, maintenance and repairs?</li>
                        <li>Save hours price matching products and materials?</li>
                        <li>Use top quality companies who deliver directly to your door?</li>
                        <li>Maintain and even increase your property's value</li>
                    </ul>
				</div>
                
            </div>
            
            <div class="pledge">
            	<img src="images/plus-header.png" alt="Plus..." style="margin-left: -5px;" /><br />
                <p style="padding-left: 15px;">We are so sure you will save money as a member of LNPG that we'll give you your joining fee back if you can't!</p>
            </div>
            
            <div class="gurantee">
            	
                <img src="images/money-back.png" alt="Money Back Guarantee" class="money-back" />
                
                <div class="gurantee-text">
                	<br /><br />
					All this for an annual membership fee of
				</div>
                
                <a href="join.php"><img src="images/price.png" alt="£199 - Join Now" style="margin-top: -15px; margin-left: 5px;" /></a>
                
            </div>
            
        </div>
    </div>
    
    <!-- End Home special content -->

	<!-- Footer -->
    
    <div class="footer">
    	<div class="footer-content">
        
        </div>
    </div>
    
    <!-- End Footer -->
        
</body>
</html>