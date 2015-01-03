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
	
	$id = "";
	$name = "";
	$logo = "";
	$description = "";
	$url = "";
	$contact = "";
	$address = "";
	$tel = "";
	$fax= "";
	$email = "";
	$discount = "";
	$instructions = "";
	
	if(isset($_GET['id'])){
		$user = "SELECT * FROM empg_partners WHERE PartnerId = " . $_GET['id'] . ";";
										
		if(!$result = mysql_query($user)){
			echo mysql_error();
		}
		else{
			while($row = mysql_fetch_array($result)){	
				$id = $row['PartnerId'];
				$name = $row['PartnerName'];
				$logo = $row['PartnerLogo'];
				$description = str_replace("<br />", "\n", $row['PartnerDescription']);
				$url = $row['PartnerURL'];
				$contact = $row['Contact'];
				$address = str_replace("<br />", "\n", $row['Address']);
				$tel = $row['Tel'];
				$fax= $row['Fax'];
				$email = $row['Email'];
				$discount = $row['Discount'];
				$instructions = str_replace("<br />", "\n", $row['Instructions']);
			}
		}		
	}
	
	if(isset($_POST['name'])){
		if($_POST['id'] == ""){
			$update = "INSERT INTO empg_partners(PartnerLogo, PartnerName, PartnerDescription, PartnerURL, Contact, Address, Tel, Fax, Email, Discount, Instructions) VALUES('images/partners/" . strtolower($_POST['name']) . "_logo.png', '" . $_POST['name'] . "', '" . str_replace("\n", "<br />", $_POST['description']) ."', '" . $_POST['url'] ."', '" . $_POST['contact'] ."', '" . str_replace("\n", "<br />", $_POST['address']) ."', '" . $_POST['tel'] ."', '" . $_POST['fax'] ."', '" . $_POST['email'] ."', '" . $_POST['discount'] ."', '" . str_replace("\n", "<br />", $_POST['instructions']) ."');";
		}
		else{
			$update = "UPDATE empg_partners SET PartnerName = '" . $_POST['name'] ."', PartnerDescription = '" . str_replace("\n", "<br />", $_POST['description']) ."', PartnerURL = '" . $_POST['url'] ."', Contact = '" . $_POST['contact'] ."', Address = '" . str_replace("\n", "<br />", $_POST['address']) ."', Tel = '" . $_POST['tel'] ."', Fax = '" . $_POST['fax'] ."', Email = '" . $_POST['email'] ."', Discount = '" . $_POST['discount'] ."', Instructions = '" . str_replace("\n", "<br />", $_POST['instructions']) ."' WHERE PartnerId = " . $_POST['id'] . ";";
		}
		
		mysql_query($update);
		
		if($_POST['logo'] != ''){
			copy($_POST['logo'], "../images/partners/" . strtolower($_POST['name']) . "_logo.png");
		}
		
		header("Location: partners-edit.php?saved=1");
	}
	
	mysql_close($conn);	
	
?>
<?php ini_set("memory_limit", "200000000"); // for large images so that we do not get "Allowed memory exhausted"?>
<?php
	function resize($orig_file,$thumb_file,$width,$height){
		$img = $orig_file;
		$constrain = true;
		$w = $width;
		$h = $height;
		
		// get image size of img
		$x = @getimagesize($img);
		// image width
		$sw = $x[0];
		// image height
		$sh = $x[1];
		
		if ($percent > 0) {
			// calculate resized height and width if percent is defined
			$percent = $percent * 0.01;
			$w = $sw * $percent;
			$h = $sh * $percent;
		} else {
			if (isset ($w) AND !isset ($h)) {
				// autocompute height if only width is set
				$h = (100 / ($sw / $w)) * .01;
				$h = @round ($sh * $h);
			} elseif (isset ($h) AND !isset ($w)) {
				// autocompute width if only height is set
				$w = (100 / ($sh / $h)) * .01;
				$w = @round ($sw * $w);
			} elseif (isset ($h) AND isset ($w) AND isset ($constrain)) {
				// get the smaller resulting image dimension if both height
				// and width are set and $constrain is also set
				$hx = (100 / ($sw / $w)) * .01;
				$hx = @round ($sh * $hx);
				
				$wx = (100 / ($sh / $h)) * .01;
				$wx = @round ($sw * $wx);
				
				if ($hx < $h) {
					$h = (100 / ($sw / $w)) * .01;
					$h = @round ($sh * $h);
				} else {
					$w = (100 / ($sh / $h)) * .01;
					$w = @round ($sw * $w);
				}
			}
		}
		
		$im = @ImageCreateFromJPEG ($img) or // Read JPEG Image
		$im = @ImageCreateFromPNG ($img) or // or PNG Image
		$im = @ImageCreateFromGIF ($img) or // or GIF Image
		$im = false; // If image is not JPEG, PNG, or GIF
		
		if (!$im) {
			// We get errors from PHP's ImageCreate functions...
			// So let's echo back the contents of the actual image.
			readfile ($img);
		} else {
			// Create the resized image destination
			$thumb = @ImageCreateTrueColor ($w, $h);
			
			imagecolortransparent($thumb, imagecolorallocatealpha($thumb, 0, 0, 0, 127));
 	    	imagealphablending($thumb, false);
    		imagesavealpha($thumb, true);
 
			// Copy from image source, resize it, and paste to image destination
			@ImageCopyResampled ($thumb, $im, 0, 0, 0, 0, $w, $h, $sw, $sh);
			// Output resized image
			@ImagePNG ($thumb,$thumb_file);
		}
	}

	// upload the file
	if ((isset($_POST["submitted_form"])) && ($_POST["submitted_form"] == "image_upload_form")) {
		
		if (($_FILES["image_upload_box"]["type"] == "image/png") && ($_FILES["image_upload_box"]["size"] < 4000000))
		{	  
			// some settings
			$max_upload_width = 200;
			$max_upload_height = 150;
			
			// if uploaded image was PNG
			if($_FILES["image_upload_box"]["type"] == "image/png"){
				$image_source = imagecreatefrompng($_FILES["image_upload_box"]["tmp_name"]);
			}
	
			$remote_file = "image_files/".$_FILES["image_upload_box"]["name"];
			$pngQuality = ($quality - 100) / 11.111111;
			$pngQuality = round(abs($pngQuality));
			
			imagecolortransparent($image_source, imagecolorallocatealpha($image_source, 0, 0, 0, 127));
			imagealphablending( $image_source, false ); 
			imagesavealpha( $image_source, true ); 
			imagepng($image_source, $remote_file, $pngQuality);
			
			if($_POST['p_name'] != ''){
				resize($remote_file, "../images/partners/" . $_POST['p_name'] . "_logo.png", 200, 150);
					
				header("Location: partners-edit.php?id=" . $_POST["id"]);
				exit;
			} else{
				$new_file = "../images/partners/" . rand() . "_logo.png";
				resize($remote_file, $new_file, 200, 150);
					
				header("Location: partners-edit.php?id=" . $_POST["id"] . "&logo=" . $new_file);
				exit;
			}
		}
		else{
			header("Location: partners-edit.php?id=" . $_POST["id"] .  "&upload_message=Make sure the file is png and that is smaller than 4MB&upload_message_type=error");
			exit;
		}
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

	function submitForm(){
		var form = document.getElementById('partners-form');
		
		var name = document.getElementById('name');
		var description = document.getElementById('description');
		var contact = document.getElementById('contact');
		var address = document.getElementById('address');
		var tel = document.getElementById('tel');
		
		var complete = 0;
		
		if(name.value != ''){
			complete += 1;
			name.style.border='1px solid #1b2e3d';
		}
		else{
			name.style.border='1px dotted #fd5529';
		}
		
		if(description.value != ''){
			complete += 1;
			description.style.border='1px solid #1b2e3d';
		}
		else{
			description.style.border='1px dotted #fd5529';
		}
		
		if(contact.value != ''){
			complete += 1;
			contact.style.border='1px solid #1b2e3d';
		}
		else{
			contact.style.border='1px dotted #fd5529';
		}
		
		if(address.value != ''){
			complete += 1;
			address.style.border='1px solid #1b2e3d';
		}
		else{
			address.style.border='1px dotted #fd5529';
		}
		
		if(tel.value != ''){
			complete += 1;
			tel.style.border='1px solid #1b2e3d';
		}
		else{
			tel.style.border='1px dotted #fd5529';
		}
		
		if(complete == 5){
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
	  if(getQueryVariable('saved') == '1'){
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
<link type="text/css" href="../stylesheets/common.css" rel="stylesheet" />
</head>

<body>
    
     <div id="boxes">
    	<div id="dialog" class="window">
        	<a href="faq.php" class="close"><img src="../images/modal/modal-top.png" /></a>

			<div style="width: 647px; background-image: url(../images/modal/modal-middle.png); background-repeat: repeat-y; margin-top: -10px; padding-left: 20px; padding-top: 20px; padding-bottom: 20px; padding-right: 20px;">
                <div style="width: 600px">
                    <h2>Partner saved...</h2>
                    This partner has been sucessfully saved!
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
                	<li><a href="partners.php">View</a></li>
                	<li class="selected"><a href="partners-edit.php">New / Edit</a></li>
                	<li><a href="partners-docs.php">Partner Documents</a></li>
                </ul>
            </div>
            
			<img src="../images/members-content-top-bg.png" alt="Top border" style="float: right; margin-top: 20px; margin-right: 42px" />
            
            <div class="members-content">
            	<div style="position: relative; float: left; font-size: 12px; width: 665px; margin-left: 20px;">
                    
                	<h1>Our Partners</h1>
                    
       				<p>
                           
                        <form action="partners-edit.php" method="post" enctype="multipart/form-data" name="image_upload_form" id="image_upload_form">
                        	<input name="submitted_form" type="hidden" id="submitted_form" value="image_upload_form" />
                            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                            <input type="hidden" id="p_name" name="p_name" value="<?php echo strtolower($name); ?>" />
                            
                            <div class="fieldblock">
                                <label>Logo:</label>
                                <div class="input hover">
                                	<?php
										if(isset($_GET['logo'])){
											echo "<img src='" . $_GET['logo'] . "' /><br />"; 
										} elseif($logo != ''){
											echo "<img src='../" . $logo . "' /><br />"; 
										}
									?>
                                	<input type="file" id="image_upload_box" name="image_upload_box" tabindex="0" value="" size="25" />
                                    <br /><br />
                                    <span><?php echo $_GET['upload_message']; ?></span>
                                    <!-- <input type="submit" name="submit" value="Upload image" /> -->
                                </div>
                            </div>
                            
                            <a href="#" onclick="document.getElementById('image_upload_form').submit();"><img src="../images/upload-btn.png" alt="Upload" style="margin-left: 180px; "/></a>
                        <br /><br />
                        </form> 
                        <form name="partners-form" id="partners-form" method="post" action="partners-edit.php">
                        	<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                            <input type="hidden" id="logo" name="logo" value="<?php echo $_GET['logo']; ?>" />
                            
                            <div class="fieldblock">
                                <label>Name:</label>
                                <div class="input hover"><input type="text" id="name" name="name" tabindex="1" value="<?php echo $name; ?>" /><span>Required</span></div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Description:</label>
                                <div class="input hover">
                                    <textarea name="description" id="description" rows="10" cols="20" tabindex="2"><?php echo $description; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Website:</label>
                                <div class="input hover"><input type="text" id="url" name="url" tabindex="3" value="<?php echo $url; ?>" /></div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Contact name:</label>
                                <div class="input hover"><input type="text" id="contact" name="contact" tabindex="4" value="<?php echo $contact; ?>" /><span>Required</span></div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Address:</label>
                                <div class="input hover">
                                    <textarea name="address" id="address" rows="10" cols="20" tabindex="5"><?php echo $address; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Tel no:</label>
                                <div class="input hover"><input type="text" id="tel" name="tel" tabindex="6" value="<?php echo $tel; ?>" /><span>Required</span></div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Fax no:</label>
                                <div class="input hover"><input type="text" id="fax" name="fax" tabindex="7" value="<?php echo $fax; ?>" /></div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Email:</label>
                                <div class="input hover"><input type="text" id="email" name="email" tabindex="8" value="<?php echo $email; ?>" /></div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Discount:</label>
                                <div class="input hover"><input type="text" id="discount" name="discount" tabindex="9" value="<?php echo $discount; ?>" /></div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Instructions:</label>
                                <div class="input hover"><textarea name="instructions" id="instructions" rows="10" cols="20" tabindex="10"><?php echo $instructions; ?></textarea></div>
                            </div>
                            
                            <div class="clear"></div>
                            
                            <a href="#" onclick="submitForm();"><img src="../images/save-btn.png" alt="Save" style="margin-left: 180px; "/></a>
                            
                            <!-- <input type="image" name="modal" id="modal" src="images/send-btn.png" tabindex="5" value="Submit" style="margin-left: 180px; "/> -->
                        
                        </form>
                        
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