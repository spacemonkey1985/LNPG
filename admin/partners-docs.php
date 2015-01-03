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
	
	if(isset($_GET['delete'])){
		$delete = "DELETE FROM empg_partners_docs WHERE DocId = " . $_GET['delete'];
		mysql_query($delete);
		
		header('location: partners-docs.php?id=' . $_GET['id']);
	}
	
	$id= '0';
	$name = '';
	$order = '';
	
	if(isset($_GET['edit'])){
		$partner_doc = "SELECT * FROM empg_partners_docs WHERE DocId = " . $_GET['edit'];
		
		if(!$result = mysql_query($partner_doc)){
			echo mysql_error();
		}
		else{
			while($row = mysql_fetch_array($result)){
				$id = $row['DocId'];
				$name = $row['DocTitle'];
				$order = $row['DocOrder'];
			}
		}
	}
	
	if(isset($_POST['name'])){
		$target_path = '../forms/' . basename($_FILES['file']['name']); 

		move_uploaded_file($_FILES['file']['tmp_name'], $target_path);

		if($_POST['id'] == '0'){
			$insert = "INSERT INTO empg_partners_docs(PartnerId, DocTitle, DocLink, DocOrder) values(" . $_POST['partner'] . ", '" . $_POST['name'] . "', 'forms/" . $_FILES['file']['name'] . "', " . $_POST['order'] . ");";
		}
		else{
			$insert = "UPDATE empg_partners_docs SET PartnerId = " . $_POST['partner'] . ", DocTitle = '" . $_POST['name'] . "', DocLink = 'forms/" . $_FILES['file']['name'] . "', DocOrder = " . $_POST['order'] . " WHERE DocId = " . $_POST['id'] . ";";
		}
		
		mysql_query($insert);
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title>Landlords National Property Group</title>
<link type="text/css" href="../stylesheets/common.css" rel="stylesheet" />
<script>

	function submitForm(){
		var form = document.getElementById('partner-docs');
		
		var name = document.getElementById('name');
		var order = document.getElementById('order');
		
		var complete = 0;
		
		if(name.value != ''){
			complete += 1;
			name.style.border='1px solid #1b2e3d';
		}
		else{
			name.style.border='1px dotted #fd5529';
		}
		
		if(order.value != ''){
			complete += 1;
			order.style.border='1px solid #1b2e3d';
		}
		else{
			order.style.border='1px dotted #fd5529';
		}
		
		if(complete == 2){
			form.submit();
		}	
	}

</script>

</head>

<body>
    
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
                	<li><a href="partners-edit.php">New / Edit</a></li>
                    <li class="selected"><a href="partners-docs.php">Partner Documents</a></li>
                </ul>
            </div>
            
			<img src="../images/members-content-top-bg.png" alt="Top border" style="float: right; margin-top: 20px; margin-right: 42px" />
            
            <div class="members-content">
            	<div style="position: relative; float: left; font-size: 12px; width: 665px; margin-left: 20px;">
                    
                	<h1>Partner documents</h1>
                    
       				<p>
                            
                        Please select a partner from below:
                        
                        <form id="partner-docs" name="partner-docs" action="partners-docs.php" method="post" enctype="multipart/form-data">
                        	<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                        	<div class="fieldblock">
                                <label>Partner:</label>
                                <div class="input hover">
                                	<select name="partner" id="partner" onchange="window.location = 'partners-docs.php?id=' + this.value;">
                                    	<option value="0">-- Please choose one --</option>
                                    	<?php
										
											$partners = "SELECT * FROM empg_partners WHERE displayOrder != 0 ORDER BY displayOrder;";
									
											if(!$result = mysql_query($partners)){
												echo mysql_error();
											}
											else{
												while($row = mysql_fetch_array($result)){
													if(isset($_GET['id'])){
														if($_GET['id'] == $row['PartnerId']){
															echo("<option value=' " . $row['PartnerId'] ."' selected='selected'>" . $row['PartnerName'] . "</option>");
														}
														else{
															echo("<option value=' " . $row['PartnerId'] ."'>" . $row['PartnerName'] . "</option>");
														}
													}
													else{
														echo("<option value=' " . $row['PartnerId'] ."'>" . $row['PartnerName'] . "</option>");
													}
												}
											}
										
										?>
                                    </select>
                                </div>
                                
                                <div class="clear"></div>
                                
                                <?php
								
									if(isset($_GET['id'])){
										$partner_info = "SELECT * FROM empg_partners_docs WHERE PartnerId = " . $_GET['id'] . " ORDER BY DocOrder";
									
										if(!$result2 = mysql_query($partner_info)){
											echo mysql_error();
										}
										else{
											while($row2 = mysql_fetch_array($result2)){
												echo "<a href='partners-docs.php?id=" . $_GET['id'] . "&edit=" . $row2['DocId'] . "'><img src='../images/edit-btn.png' alt='Edit' style='border: none; margin-right: 15px;' /></a>";
												echo "<a href='partners-docs.php?id=" . $_GET['id'] . "&delete=" . $row2['DocId'] . "'><img src='../images/deactivate-btn.png' alt='Deactivate' style='border: none; margin-right: 15px;' /></a>";
												echo '<a href="../' . $row2['DocLink'] . '" target="_blank"><img src="../images/pdfIcon.png" alt="PDF Download" style="padding-right: 15px; vertical-align: middle;" /></a><a href="../' . $row2['DocLink'] . '" target="_blank">' . $row2['DocTitle'] . '</a><br />';
											}
										}
									}
									
								?>
                                
                                <br /><br />
                                <hr />
                                
                                <h1>New / edit document</h1>
                                
                                <div class="fieldblock">
                                    <label>File:</label>
                                    <div class="input hover">
                                        <input type="file" id="file" name="file" tabindex="0" value="" size="25" />
                                    </div>
                                </div>
                                
                                <div class="fieldblock">
                                    <label>Document Name:</label>
                                    <div class="input hover"><input type="text" id="name" name="name" tabindex="1" value="<?php echo $name; ?>" /><span>Required</span></div>
                                </div>
                                
                                <div class="fieldblock">
                                    <label>Document Order:</label>
                                    <div class="input hover"><input type="text" id="order" name="order" tabindex="2" value="<?php echo $order; ?>" /><span>Required</span></div>
                                </div>
                                
                                <div class="clear"></div>
                            
                            	<a href="#" onclick="submitForm();"><img src="../images/save-btn.png" alt="Save" style="margin-left: 180px; "/></a>
                                
                            </div>
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