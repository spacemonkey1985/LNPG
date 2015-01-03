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
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title>Landlords National Property Group</title>
<link type="text/css" href="stylesheets/common.css" rel="stylesheet" />
<script type="text/javascript">
	function toggleDiv(a){
		if (document.getElementById(a)) {     
			e=document.getElementById(a);     
			e.style.display=(e.style.display && (e.style.display=="none"))?"block":"none";     
		}     
		
		return false;
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
                	<li class="selected"><a href="members-partners.php">Partners</a></li>
                	<li><a href="members-edit.php">My details</a></li>
                    <li><a href="affiliate.php">Refer a Landlord</a></li>
                </ul>
            </div>
            
			<img src="images/members-content-top-bg.png" alt="Top border" style="float: right; margin-top: 20px; margin-right: 42px" />
            
            <div class="members-content">
            	<div style="font-size: 12px; width: 665px; margin-left: 20px; float: left;">
                	<h1>Partners</h1>
                    
					<?php
                
						$partner_applications = "SELECT a.*, (SELECT DISTINCT b.Status FROM empg_member_partner b WHERE b.PartnerId = a.PartnerId AND b.MemberNo = " . $_SESSION['member_no'] . ") AS Status FROM empg_partners a WHERE (a.ApplicationForm != '' OR a.ApplicationForm != null) AND a.displayOrder != 0 ORDER by a.displayOrder;";
															
						if(!$result = mysql_query($partner_applications)){
							echo mysql_error();
						}
						else{
							while($row = mysql_fetch_array($result)){
								echo '<img src="images/partner-detail-header.png" alt="Partner header" />';
								echo '<div class="partner-detail">';
								//echo '<a href="#" onclick="return toggleDiv(\'infoPopup' . $row["PartnerId"] . '\');"><img src="images/step1-btn.png" alt="Step 1" style="float: right; margin-right: -100px;" /></a>';
								//echo '<a href="apply.php?member=' . $_SESSION['member_no'] . '&partner=' . $row['PartnerId']. '&form=' . $row['ApplicationForm'] . '" target="_blank"><img src="images/step2-btn.png" alt="Step 2" style="float: right; margin-right: -100px; margin-top: 115px;" /></a>';
								echo '<div class="partner-info" id="infoPopup' . $row["PartnerId"] . '">';
								echo '<img src="images/partner-info-head.png" alt="Header" />';
								echo '<div class="partner-info-content">';
								echo '<b>Partner Documents</b><br />';
										
								$partner_info = "SELECT * FROM empg_partners_docs WHERE PartnerId = " . $row["PartnerId"] . " ORDER BY DocOrder";
								
								if(!$result2 = mysql_query($partner_info)){
									echo mysql_error();
								}
								else{
									while($row2 = mysql_fetch_array($result2)){
										echo '<a href="' . $row2['DocLink'] . '" target="_blank"><img src="images/pdfIcon.png" alt="PDF Download" style="padding-right: 15px; vertical-align: middle;" /></a><a href="' . $row2['DocLink'] . '" target="_blank">' . $row2['DocTitle'] . '</a><br />' ;
									}
								}								
								
								echo '</div>';
								echo '<img src="images/partner-info-foot.png" alt="Header" />';
								echo '</div>';
								
								$partner_links = "SELECT * FROM empg_partners_links WHERE PartnerId = " . $row["PartnerId"] . " ORDER BY LinkOrder";
								
								if(!$result3 = mysql_query($partner_links)){
									echo mysql_error();
								}
								else{
									if(mysql_num_rows($result3) > 0){
										echo '<div class="partner-link" id="linkPopup' . $row["PartnerId"] . '">';
										echo '<img src="images/partner-info-head.png" alt="Header" />';
										echo '<div class="partner-link-content">';
										echo '<b>Partner Links</b><br />';
								
										while($row3 = mysql_fetch_array($result3)){
											echo '<a href="' . $row3['Link'] . '" target="_blank"><img src="images/lnkicon.png" alt="Web Link" style="padding-right: 15px; vertical-align: middle;" /></a><a href="' . $row3['Link'] . '" target="_blank">' . $row3['LinkTitle'] . '</a><br />' ;
										}
										
										echo '</div>';
										echo '<img src="images/partner-info-foot.png" alt="Header" />';
										echo '</div>';
									}
								}
								
								echo "<div style='float: left;'><img src='" . $row['PartnerLogo'] . "' alt='" . $row['PartnerName'] . "' /></div>";
								echo '<div style="float: left; margin-left: -10px;">';
								echo '<div class="label">Contact:</div>';
	                            echo '<div class="data">'. $row['Contact'] . '</div><br />';
								echo '<div class="label">Address:</div>';
	                            echo '<div class="data">'. $row['Address'] . '</div><br />';
                            	echo '<div class="label">Tel:</div>';
	                            echo '<div class="data">'. $row['Tel'] . '</div><br />';
								echo '<div class="label">Fax:</div>';
	                            echo '<div class="data">'. $row['Fax'] . '</div><br />';
								echo '<div class="label">Email:</div>';
	                            echo '<div class="data"><a href="mailto:' . $row['Email'] . '">'. $row['Email'] . '</a></div><br />';
                            	echo '</div>';
								echo '</div>';
								echo '<img src="images/partner-detail-footer.png" alt="Partner header" style="margin-bottom: 15px;" />';								
							}
						}
						
						$partner_discounts = "SELECT * FROM empg_partners WHERE (ApplicationForm = '' OR ApplicationForm is null) AND displayOrder != 0 ORDER by displayOrder;";
															
						if(!$result = mysql_query($partner_discounts)){
							echo mysql_error();
						}
						else{
							while($row = mysql_fetch_array($result)){
								echo '<img src="images/partner-detail-header.png" alt="Partner header" />';
								echo '<div class="partner-detail">';
								//echo '<a href="#" onclick="return toggleDiv(\'infoPopup' . $row["PartnerId"] . '\');"><img src="images/step1-btn.png" alt="Step 1" style="float: right; margin-right: -100px;" /></a>';
								echo '<div class="partner-info" id="infoPopup' . $row["PartnerId"] . '">';
								echo '<img src="images/partner-info-head.png" alt="Header" />';
								echo '<div class="partner-info-content">';
								echo '<b>Partner Documents</b><br />';
										
								$partner_info = "SELECT * FROM empg_partners_docs WHERE PartnerId = " . $row["PartnerId"] . " ORDER BY DocOrder";
								
								if(!$result2 = mysql_query($partner_info)){
									echo mysql_error();
								}
								else{
									while($row2 = mysql_fetch_array($result2)){
										echo '<a href="' . $row2['DocLink'] . '" target="_blank"><img src="images/pdfIcon.png" alt="PDF Download" style="padding-right: 15px; vertical-align: middle;" /></a><a href="' . $row2['DocLink'] . '" target="_blank">' . $row2['DocTitle'] . '</a><br />' ;
									}
								}									
								
								echo '</div>';
								echo '<img src="images/partner-info-foot.png" alt="Header" />';
								echo '</div>';
								
								$partner_links = "SELECT * FROM empg_partners_links WHERE PartnerId = " . $row["PartnerId"] . " ORDER BY LinkOrder";
								
								if(!$result3 = mysql_query($partner_links)){
									echo mysql_error();
								}
								else{
									if(mysql_num_rows($result3) > 0){
										echo '<div class="partner-link" id="linkPopup' . $row["PartnerId"] . '">';
										echo '<img src="images/partner-info-head.png" alt="Header" />';
										echo '<div class="partner-link-content">';
										echo '<b>Partner Links</b><br />';
								
										while($row3 = mysql_fetch_array($result3)){
											echo '<a href="' . $row3['Link'] . '" target="_blank"><img src="images/lnkicon.png" alt="Web Link" style="padding-right: 15px; vertical-align: middle;" /></a><a href="' . $row3['Link'] . '" target="_blank">' . $row3['LinkTitle'] . '</a><br />' ;
										}
										
										echo '</div>';
										echo '<img src="images/partner-info-foot.png" alt="Header" />';
										echo '</div>';
									}
								}
								
								echo "<div style='float: left;'><img src='" . $row['PartnerLogo'] . "' alt='" . $row['PartnerName'] . "'  /></div>";
								echo '<div style="float: left; margin-left: -10px;">';
								echo '<div class="label">Contact:</div>';
	                            echo '<div class="data">'. $row['Contact'] . '</div><br />';
								echo '<div class="label">Address:</div>';
	                            echo '<div class="data">'. $row['Address'] . '</div><br />';
                            	echo '<div class="label">Tel:</div>';
	                            echo '<div class="data">'. $row['Tel'] . '</div><br />';
								echo '<div class="label">Fax:</div>';
	                            echo '<div class="data">'. $row['Fax'] . '</div><br />';
								echo '<div class="label">Email:</div>';
	                            echo '<div class="data"><a href="mailto:' . $row['Email'] . '">'. $row['Email'] . '</a></div><br />';
                            	echo '</div>';
								echo '</div>';
								echo '<img src="images/partner-detail-footer.png" alt="Partner header" style="margin-bottom: 15px;" />';								
							}
						}
					
					?>
                    
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