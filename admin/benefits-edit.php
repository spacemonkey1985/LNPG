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
	$title = "";
	$description = "";
	
	if(isset($_GET['id'])){
		$user = "SELECT * FROM empg_benefits WHERE BenefitId = " . $_GET['id'] . ";";
										
		if(!$result = mysql_query($user)){
			echo mysql_error();
		}
		else{
			while($row = mysql_fetch_array($result)){	
				$title = $row['Title'];
				$description = $row['Description'];
				$id = $_GET['id'];
			}
		}		
	}
	
	if(isset($_POST['title'])){
		if($_POST['id'] == ""){
			$update = "INSERT INTO empg_benefits(Title, Description) VALUES('" . $_POST['title'] . "', '" . $_POST['description'] ."');";
		}
		else{
			$update = "UPDATE empg_benefits SET Title = '" . $_POST['title'] . "', Description = '" . $_POST['description'] ."' WHERE BenefitId = " . $_POST['id'] . ";";
		}
		
		mysql_query($update);
		
		header("Location: benefits-edit.php?saved=1");
	}
	
	mysql_close($conn);	
	
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
		var form = document.getElementById('benefits-form');
		
		var title = document.getElementById('title');
		var description = document.getElementById('description');
		
		var complete = 0;
		
		if(title.value != ''){
			complete += 1;
			title.style.border='1px solid #1b2e3d';
		}
		else{
			title.style.border='1px dotted #fd5529';
		}
		
		if(description.value != ''){
			complete += 1;
			description.style.border='1px solid #1b2e3d';
		}
		else{
			description.style.border='1px dotted #fd5529';
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
                    <h2>Member benefit saved...</h2>
                    This member benefit has been sucessfully saved!
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
                	<li><a href="benefits.php">View</a></li>
                	<li class="selected"><a href="benefits-edit.php">New / Edit</a></li>
                </ul>
            </div>
            
			<img src="../images/members-content-top-bg.png" alt="Top border" style="float: right; margin-top: 20px; margin-right: 42px" />
            
            <div class="members-content">
            	<div style="position: relative; float: left; font-size: 12px; width: 665px; margin-left: 20px;">
                    
                	<h1>FAQs</h1>
                    
       				<p>
                            
                        <form name="benefits-form" id="benefits-form" method="post" action="benefits-edit.php">
                        	<input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                            <div class="fieldblock">
                                <label>Title:</label>
                                <div class="input hover"><input type="text" id="title" name="title" tabindex="1" value="<?php echo $title; ?>" /><span>Required</span></div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Description:</label>
                                <div class="input hover">
                                    <textarea name="description" id="description" rows="10" cols="20" tabindex="4"><?php echo $description; ?></textarea>
                                </div>
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