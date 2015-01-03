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
	
	$myFile = "data/Line2D_1.xml";
	$myFile2 = "data/Line2D_2.xml";

	$fh = fopen($myFile, 'w') or die("can't open file");
	$fh2 = fopen($myFile2, 'w') or die("can't open file");
	
	$stringData = "<chart caption='Cumulative members per month' subcaption='For the past 12 months YTD' xAxisName='Month' yAxisName='Members' yAxisMinValue='0'  numberPrefix='' showValues='0' alternateHGridColor='99cccc' alternateHGridAlpha='20' divLineColor='1b75bc' divLineAlpha='50' canvasBorderColor='666666' baseFontColor='666666' lineColor='1b75bc'>\n";
	fwrite($fh2, $stringData);
	
	
	$stringData = "<chart caption='Members joining per month' subcaption='For the past 12 months YTD' xAxisName='Month' yAxisName='Members' yAxisMinValue='0'  numberPrefix='' showValues='0' alternateHGridColor='99cccc' alternateHGridAlpha='20' divLineColor='1b75bc' divLineAlpha='50' canvasBorderColor='666666' baseFontColor='666666' lineColor='1b75bc'>\n";
	fwrite($fh, $stringData);
	
	
	$stringData = "	<categories>\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);
	
	$last_month = "SELECT DateTimeStamp FROM empg_member ORDER BY DateTimeStamp DESC LIMIT 1;";
										
	if(!$result = mysql_query($last_month)){
		echo mysql_error();
	}
	else{
		while($row = mysql_fetch_array($result)){
			$date = date_create($row['DateTimeStamp']);
			
			$d = date_format($date, 'd');
			$m = date_format($date, 'm');
			$y = date_format($date, 'Y');
		
			for($i = 0;$i < 11;$i++){
				if($m == 1){
					$m = 12;
					$y = $y - 1;
				}
				else{
					$m = $m - 1;
				}
			}
				
			$date = date_create($y . '-' . $m . '-' . $d);
			
			for($i = 0;$i < 12;$i++){
				$d = date_format($date, 'd');
				$m = date_format($date, 'm');
				$y = date_format($date, 'Y');
				
				$stringData = "	 <category label='" . date_format($date, 'M Y') . "' />\n";
				fwrite($fh, $stringData);
				fwrite($fh2, $stringData);
				
				if($m == 12){
					$m = 1;
					$y = $y + 1;
				}
				else{
					$m = $m + 1;
				}
				
				$date = date_create($y . '-' . $m . '-' . $d);
			}
			
			$stringData = " </categories>\n";
			fwrite($fh, $stringData);
			fwrite($fh2, $stringData);
	
			$stringData = "  <dataset seriesName='Actual' color='1b75bc' anchorBorderColor='1b75bc' anchorBgColor='ffffff'>\n";
			fwrite($fh, $stringData);
			fwrite($fh2, $stringData);
				
			$date = date_create($row['DateTimeStamp']);
			
			$d = date_format($date, 'd');
			$m = date_format($date, 'm');
			$y = date_format($date, 'Y');
		
			for($i = 0;$i < 11;$i++){
				if($m == 1){
					$m = 12;
					$y = $y - 1;
				}
				else{
					$m = $m - 1;
				}
			}
			
			$date = date_create($y . '-' . $m . '-' . $d);
			
			$amount = 0;
			
			for($i = 0;$i < 12;$i++){
				$d = date_format($date, 'd');
				$m = date_format($date, 'm');
				$y = date_format($date, 'Y');
				
				
				$data1 = "SELECT COUNT(MemberNo) FROM empg_member WHERE DATE_FORMAT(DateTimeStamp, '%m') = " . $m . " AND DATE_FORMAT(DateTimeStamp, '%Y') = " . $y . ";";
										
				if(!$result = mysql_query($data1)){
					echo mysql_error();
				}
				else{
					while($row = mysql_fetch_array($result)){
						$stringData = "    <set value='" . $row[0] . "' />\n";
						fwrite($fh, $stringData);
						
						$amount = $amount + (int)$row[0];
						$stringData = "    <set value='" . $amount . "' />\n";
						fwrite($fh2, $stringData);
					}
				}
				
				if($m == 12){
					$m = 1;
					$y = $y + 1;
				}
				else{
					$m = $m + 1;
				}
				
				$date = date_create($y . '-' . $m . '-' . $d);
			}
			
			$stringData = "  </dataset>\n";
			fwrite($fh, $stringData);
			fwrite($fh2, $stringData);
			
			$stringData = "  <dataset seriesName='Forecast' color='f6861f' anchorBorderColor='f6861f' anchorBgColor='ffffff'>\n";
			fwrite($fh, $stringData);	
			fwrite($fh2, $stringData);
				
			$date = date_create($row['DateTimeStamp']);
			
			$d = date_format($date, 'd');
			$m = date_format($date, 'm');
			$y = date_format($date, 'Y');
		
			for($i = 0;$i < 11;$i++){
				if($m == 1){
					$m = 12;
					$y = $y - 1;
				}
				else{
					$m = $m - 1;
				}
			}
			
			$date = date_create($y . '-' . $m . '-' . $d);
			
			$amount = 0;
			
			for($i = 0;$i < 12;$i++){
				$d = date_format($date, 'd');
				$m = date_format($date, 'm');
				$y = date_format($date, 'Y');
				
				
				$data1 = "SELECT NoOfMembers FROM empg_members_target WHERE DATE_FORMAT(Date, '%m') = " . $m . " AND DATE_FORMAT(Date, '%Y') = " . $y . ";";
										
				if(!$result = mysql_query($data1)){
					echo mysql_error();
				}
				else{
					while($row = mysql_fetch_array($result)){
						$stringData = "    <set value='" . $row[0] . "' />\n";
						fwrite($fh, $stringData);
						
						$amount = $amount + (int)$row[0];
						$stringData = "    <set value='" . $amount . "' />\n";
						fwrite($fh2, $stringData);
					}
				}
				
				if($m == 12){
					$m = 1;
					$y = $y + 1;
				}
				else{
					$m = $m + 1;
				}
				
				$date = date_create($y . '-' . $m . '-' . $d);
			}
			
			$stringData = "  </dataset>\n";
			fwrite($fh, $stringData);
			fwrite($fh2, $stringData);
		}
	}
	
	$stringData = " <styles>\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);
	$stringData = "	  <definition>\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);
	$stringData = "	    <style name='Anim1' type='animation' param='_xscale' start='0' duration='1' />\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);
	$stringData = "	    <style name='Anim2' type='animation' param='_alpha' start='0' duration='0.6' />\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);
	$stringData = "	    <style name='DataShadow' type='Shadow' alpha='40'/>\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);
	$stringData = "	  </definition>\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);
	$stringData = "	  <application>\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);
	$stringData = "	    <apply toObject='DIVLINES' styles='Anim1' />\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);
	$stringData = "	    <apply toObject='HGRID' styles='Anim2' />\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);
	$stringData = "	    <apply toObject='DATALABELS' styles='DataShadow,Anim2' />\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);
	$stringData = "	  </application>\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);
	$stringData = " </styles>\n";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);

	$stringData = "</chart>";
	fwrite($fh, $stringData);
	fwrite($fh2, $stringData);

	fclose($fh);
	fclose($fh2);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title>Landlords National Property Group</title>
<script language="JavaScript" src="js/FusionCharts.js"></script>
<link type="text/css" href="../stylesheets/common.css" rel="stylesheet" />
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
                	<li class="selected"><a href="reports.php">Registration Reports</a></li>
                	<li><a href="google-reports.php">Google Analytics</a></li>
                </ul>
            </div>
            
			<img src="../images/members-content-top-bg.png" alt="Top border" style="float: right; margin-top: 20px; margin-right: 42px" />
            
            <div class="members-content">
            	<div style="position: relative; float: left; font-size: 12px; width: 665px; margin-left: 20px;">
                    
                	<h1>Member Registration Reports</h1>
                    
       				<p>
                            
                        <h2>Members joining per month</h2>
                        <div id="chartdiv1" align="center"> 
                        </div>
                        <script type="text/javascript">
                            var chart = new FusionCharts("charts/MSLine.swf", "ChartId1", "640", "300", "0", "0");
                            chart.setDataURL("data/Line2D_1.xml");		   
                            chart.render("chartdiv1");
                        </script>
                        <br /><br />
                        <h2>Cumulative members per month</h2>
                        <div id="chartdiv2" align="center"> 
                        </div>
                        <script type="text/javascript">
                            var chart = new FusionCharts("charts/MSLine.swf", "ChartId2", "640", "300", "0", "0");
                            chart.setDataURL("data/Line2D_2.xml");		   
                            chart.render("chartdiv2");
                        </script> 
                        
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