<?php
	
	session_start();
	
	include('connect/db_connection.php');
	include('includes/config.inc.php');
	
	$to = MAILADDR_MEMBERSHIP;
	$subject = 'New LNPG Member sign up: Step 1';
	$body = "Name: " . $_POST['name'] . "\n"  .
			"Email:" . $_POST['email']. "\n" .
			"Mobile:" . $_POST['mob']. "\n" .
			"Tel:" . $_POST['tel']. "\n" .
			"Referee:" . $_POST['ref'] ;
	$headers = 'From: webmaster@lnpg.co.uk' . "\n" .
				'Reply-To: ' . MAILADDR_MEMBERSHIP . "\n" .
				'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $body, $headers);
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
<title>Landlords National Property Group</title>
<link type="text/css" href="stylesheets/common.css" rel="stylesheet" />
<script type="text/javascript">
	function submitForm(){
		var form = document.getElementById('details');
		
		/*
		* var property_count = document.getElementById('property_count');
		var property_count_rv = document.getElementById('property_count_rv');
		
		if(property_count.value < 1){
			property_count_rv.style.display = "inline";
		}
		else{
			property_count_rv.style.display = "none";
			form.submit();
		}
		* */
		
		form.submit();
	}
	
	function addProperties(){
		var properties = document.getElementById('properties');
		var areas = document.getElementById('areas');
		var spend = document.getElementById('spend');
		var tenant = document.getElementById('tenant');
		var growth = document.getElementById('growth');
		
		var properties_rv = document.getElementById('properties_rv');
		var areas_rv = document.getElementById('areas_rv');
		var spend_rv = document.getElementById('spend_rv');
		var tenant_rv = document.getElementById('tenant_rv');
		var growth_rv = document.getElementById('growth_rv');
		
		var property_count = document.getElementById('property_count');
		var property_array = document.getElementById('property_array');
		
		var complete = 0;
		
		if(properties.value != ''){
			complete += 1;
			properties_rv.style.display = "none";
		}
		else{
			properties_rv.style.display = "inline";
		}
		
		if(areas.value != ''){
			complete += 1;
			areas_rv.style.display = "none";
		}
		else{
			areas_rv.style.display = "inline";
		}
		
		if(spend.value != ''){
			complete += 1;
			spend_rv.style.display = "none";
		}
		else{
			spend_rv.style.display = "inline";
		}
		
		if(tenant.value != ''){
			complete += 1;
			tenant_rv.style.display = "none";
		}
		else{
			tenant_rv.style.display = "inline";
		}
		
		if(growth.value != ''){
			complete += 1;
			growth_rv.style.display = "none";
		}
		else{
			growth_rv.style.display = "inline";
		}
		
		if(complete == 5){
			var table = document.getElementById("my_properties");               
			var rowCount = table.rows.length;             
			var row = table.insertRow(rowCount);               
			
			var cell6 = row.insertCell(0);
			cell6.innerHTML = "<img src='images/Remove-icon.png' name='del_" + rowCount + "' border='0' onclick='deleteProperties(" + rowCount + ");' style='cursor: pointer;'  />";
			cell6.style.border = "none";
			
			var cell5 = row.insertCell(0);             
			var element5 = document.createElement("input");             
			element5.type = "hidden";
			element5.name = "growth_" + rowCount;
			element5.value = growth.value;
			cell5.appendChild(element5);
			cell5.innerHTML = growth.value;
			cell5.style.borderRight = "solid 1px #1b75bc";
			
			var cell4 = row.insertCell(0);             
			var element4 = document.createElement("input");             
			element4.type = "hidden";
			element4.name = "tenant_" + rowCount;
			element4.value = tenant.value;
			cell4.appendChild(element4);
			cell4.innerHTML = tenant.value;
			
			var cell3 = row.insertCell(0);             
			var element3 = document.createElement("input");             
			element3.type = "hidden";
			element3.name = "spend_" + rowCount;
			element3.value = spend.value;
			cell3.appendChild(element3);
			cell3.innerHTML = spend.value;
			
			
			var cell2 = row.insertCell(0);             
			var element2 = document.createElement("input");             
			element2.type = "hidden";
			element2.name = "areas_" + rowCount;
			element2.value = areas.value;
			cell2.appendChild(element2);
			cell2.innerHTML = areas.options[areas.selectedIndex].text;
			
			var cell1 = row.insertCell(0);             
			var element1 = document.createElement("input");             
			element1.type = "hidden";
			element1.name = "properties_" + rowCount;
			element1.value = properties.value;
			cell1.appendChild(element1);
			cell1.innerHTML = properties.value;
			cell1.style.borderLeft = "solid 1px #1b75bc";
			
			rowCount = table.rows.length;
			var row2 = table.insertRow(rowCount);
			
			var cell0 = row2.insertCell(0);
			cell0.style.border = "none";
			cell0.style.height = "10px";
			
			if(property_array.value == ""){
				property_array.value = properties.value + "|" + areas.value + "|" + spend.value + "|" + tenant.value + "|" + growth.value;
			}
			else{
				property_array.value = property_array.value + ";" + properties.value + "|" + areas.value + "|" + spend.value + "|" + tenant.value + "|" + growth.value;
			}
			
			properties.value = "";
			areas.value = "";
			spend.value = "";
			tenant.value = "";
			growth.value = "";
			
			var checkboxes = document.getElementsByTagName("input");
			
			for(var i=0; i < checkboxes.length; i++){
				if(checkboxes.item(i).type == "checkbox"){
					checkboxes.item(i).checked = false;
				}
			}
			
			property_count.value = parseInt(property_count.value) + 1;
		}		
	}
	
	function deleteProperties(rowNo){             
		try {             
			var table = document.getElementById("my_properties");             
			var rowCount = table.rows.length;               
			
			var property_count = document.getElementById('property_count');
		
			for(var i=0; i<rowCount; i++) {                 
				var row = table.rows[i];                
				
				if(i == rowNo) {
					table.deleteRow(i);
					table.deleteRow(i+1);
					rowCount--;                     
					i--;                 
				}               
			}        
			
			property_count.value = parseInt(property_count.value) - 1;
		}
		catch(e) {                 
			alert(e);             
		}         
	}
	
	function updateTenant(id){
		var tenant = document.getElementById('tenant');
		var tenantIds = document.getElementById('tenantIds');
		var checkbox = document.getElementById(id);
		
		if(checkbox.checked){
			if(tenant.value == ""){
				tenant.value = checkbox.title;
				tenantIds.value = checkbox.value;
			}
			else
			{
				tenant.value = tenant.value + ", " + checkbox.title;
				tenantIds.value = tenantIds.value + ", " + checkbox.value;
			}
		}
		else{
			tenant.value = tenant.value.replace(", " + checkbox.title, "");
			tenant.value = tenant.value.replace(checkbox.title + ", ", "");
			tenant.value = tenant.value.replace(checkbox.title, "");
			
			tenantIds.value = tenantIds.value.replace(", " + checkbox.value, "");
			tenantIds.value = tenantIds.value.replace(checkbox.value + ", ", "");
			tenantIds.value = tenantIds.value.replace(checkbox.value, "");
		}
	}
	function addRow(number){
		var row = document.getElementById('row' + number);
		row.style.display = "inline";
	}
</script>
</head>

<body>

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

			<img src="images/join-title.png" alt="About us" />

        </div>
    </div>
    
    <!-- End Title banner -->
    
    <!-- Content -->
    
    <div class="content">
    	<div class="content-content">
        	
        	<div style="position: relative; float: left; width: 700px; margin-top: 20px;">
            
            	<div style="position: relative; float: left; font-size: 12px; width: 250px; height: 100px; margin-bottom: 20px;">
                              
                </div>
                
                <span style="font-size: 42px; color: #1b75bc;">About your portfolio</span><br /><br />
                
            	<p style="font-size: 12px; margin-bottom: 20px;">Thank you for choosing the LNPG. Please fill out your details to benefit from LNPG membership.</p>
                
                <div style="margin-left: 70px">
                    <form name="details" id="details" method="post" action="join_step3.php">
                        <input type="hidden" name="name" id="name" value="<?php echo($_POST['name']); ?>" />
                        <input type="hidden" name="bus_name" id="bus_name" value="<?php echo($_POST['bus_name']); ?>" />
                        <input type="hidden" name="add1" id="add1" value="<?php echo($_POST['add1']); ?>" />
                        <input type="hidden" name="city" id="city" value="<?php echo($_POST['city']); ?>" />
                        <input type="hidden" name="county" id="county" value="<?php echo($_POST['county']); ?>" />
                        <input type="hidden" name="post_code" id="post_code" value="<?php echo($_POST['post_code']); ?>" />
                        <input type="hidden" name="tel" id="tel" value="<?php echo($_POST['tel']); ?>" />
                        <input type="hidden" name="fax" id="fax" value="<?php echo($_POST['fax']); ?>" />
                        <input type="hidden" name="mob" id="mob" value="<?php echo($_POST['mob']); ?>" />
                        <input type="hidden" name="email" id="email" value="<?php echo($_POST['email']); ?>" />
                        <input type="hidden" name="ref" id="ref" value="<?php echo($_POST['ref']); ?>" />
                        
                        <div class="fieldblock">
                        	<label>Typical tenant:</label>
                            <div class="input hover">
								<?php
                                            
                                    $tenants = "SELECT * FROM empg_tenant_type;";
                                        
                                    if(!$result = mysql_query($tenants)){
                                        echo mysql_error();
                                    }
                                    else{
                                        $i = 0;
                                        
                                        while($row = mysql_fetch_array($result)){
                                            echo("<input type='checkbox' name='tenant_" . $i . "' id='tenant_" . $i . "' value='" . $row['TenantTypeId'] . "' onclick='updateTenant(this.id);' title='" . $row['TenantType'] . "' />&nbsp;<p>" . $row['TenantType'] . "</p><br /><br />");
                                             
                                            $i = $i + 1;
                                        }
                                    }	
                                    
                                ?>
                                
                                <input type="hidden" name="tenantIds" id="tenantIds" />
                                <input type="hidden" name="tenant" id="tenant" />
                                <div id="tenant_rv" style="color: red; font-size: 11px; display: none;">Please enter your typical tenant</div>
                            </div>
                        </div>
                        
                        <p style="font-size: 12px; margin-bottom: 20px;">Number of properties owned. Please complete the following table with the number of your properties in each county.</p>
                        
                        <div class="fieldblock">
                        	<label>County:</label>
                            <div class="input hover">
                            	<select name="areas" id="areas" style="width: 300px;" onchange="addRow(2);">
                                    <option value="blank">-- Please choose one --</option>
                                    <?php
                                    
                                        $areas = "SELECT * FROM empg_locations;";
                                        
                                        if(!$result = mysql_query($areas)){
                                            echo mysql_error();
                                        }
                                        else{
                                            while($row = mysql_fetch_array($result)){
                                                echo("<option value=' " . $row['LocationId'] ."'>" . $row['Location'] . "</option>");
                                            }
                                        }	
                                    
                                    ?>
                                    
                                </select>
                                
                                <div id="areas_rv" style="color: red; font-size: 11px; display: none;">Please enter your council areas</div>
                            </div>
						</div>
                        
                        <div class="fieldblock">
                            <label>Number of properties:</label>
                            <div class="input hover">
                                <input type="text" name="propertyCount" id="propertyCount" maxlength="50" style="width: 150px;" />
                            </div>
                        </div>
                        
                        <div id="row2" style="display: none;">
                        	<div class="fieldblock">
                                <label>County:</label>
                                <div class="input hover">
                                    <select name="areas" id="areas" style="width: 300px;" onchange="addRow(3);">
                                        <option value="blank">-- Please choose one --</option>
                                        <?php
                                        
                                            $areas = "SELECT * FROM empg_locations;";
                                            
                                            if(!$result = mysql_query($areas)){
                                                echo mysql_error();
                                            }
                                            else{
                                                while($row = mysql_fetch_array($result)){
                                                    echo("<option value=' " . $row['LocationId'] ."'>" . $row['Location'] . "</option>");
                                                }
                                            }	
                                        
                                        ?>
                                        
                                    </select>
                                    
                                    <div id="areas_rv" style="color: red; font-size: 11px; display: none;">Please enter your council areas</div>
                                </div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Number of properties:</label>
                                <div class="input hover">
                                    <input type="text" name="propertyCount" id="propertyCount" maxlength="50" style="width: 150px;" />
                                </div>
                            </div>
                            
						</div>
                        
                        <div id="row3" style="display: none;">
                        	<div class="fieldblock">
                                <label>County:</label>
                                <div class="input hover">
                                    <select name="areas" id="areas" style="width: 300px;" onchange="addRow(4);">
                                        <option value="blank">-- Please choose one --</option>
                                        <?php
                                        
                                            $areas = "SELECT * FROM empg_locations;";
                                            
                                            if(!$result = mysql_query($areas)){
                                                echo mysql_error();
                                            }
                                            else{
                                                while($row = mysql_fetch_array($result)){
                                                    echo("<option value=' " . $row['LocationId'] ."'>" . $row['Location'] . "</option>");
                                                }
                                            }	
                                        
                                        ?>
                                        
                                    </select>
                                    
                                    <div id="areas_rv" style="color: red; font-size: 11px; display: none;">Please enter your council areas</div>
                                </div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Number of properties:</label>
                                <div class="input hover">
                                    <input type="text" name="propertyCount" id="propertyCount" maxlength="50" style="width: 150px;" />
                                </div>
                            </div>
						</div>
                        
                        <div id="row4" style="display: none;">
                        	<div class="fieldblock">
                                <label>County:</label>
                                <div class="input hover">
                                    <select name="areas" id="areas" style="width: 300px;" onchange="addRow(5);">
                                        <option value="blank">-- Please choose one --</option>
                                        <?php
                                        
                                            $areas = "SELECT * FROM empg_locations;";
                                            
                                            if(!$result = mysql_query($areas)){
                                                echo mysql_error();
                                            }
                                            else{
                                                while($row = mysql_fetch_array($result)){
                                                    echo("<option value=' " . $row['LocationId'] ."'>" . $row['Location'] . "</option>");
                                                }
                                            }	
                                        
                                        ?>
                                        
                                    </select>
                                    
                                    <div id="areas_rv" style="color: red; font-size: 11px; display: none;">Please enter your council areas</div>
                                </div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Number of properties:</label>
                                <div class="input hover">
                                    <input type="text" name="propertyCount" id="propertyCount" maxlength="50" style="width: 150px;" />
                                </div>
                            </div>
						</div>
                        
                        <div id="row5" style="display: none;">
                        	<div class="fieldblock">
                                <label>County:</label>
                                <div class="input hover">
                                    <select name="areas" id="areas" style="width: 300px;">
                                        <option value="blank">-- Please choose one --</option>
                                        <?php
                                        
                                            $areas = "SELECT * FROM empg_locations;";
                                            
                                            if(!$result = mysql_query($areas)){
                                                echo mysql_error();
                                            }
                                            else{
                                                while($row = mysql_fetch_array($result)){
                                                    echo("<option value=' " . $row['LocationId'] ."'>" . $row['Location'] . "</option>");
                                                }
                                            }	
                                        
                                        ?>
                                        
                                    </select>
                                    
                                    <div id="areas_rv" style="color: red; font-size: 11px; display: none;">Please enter your council areas</div>
                                </div>
                            </div>
                            
                            <div class="fieldblock">
                                <label>Number of properties:</label>
                                <div class="input hover">
                                    <input type="text" name="propertyCount" id="propertyCount" maxlength="50" style="width: 150px;" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="clear"></div>
                        
                        <input type="image" name="submit" id="submit" src="images/next-btn.png" value="Submit" style="margin-left: 180px; "/>
                    
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