<?php 

	//include('simple_html_dom.php');
	
	//$house_site = 'http://www1.landregistry.gov.uk/house-prices/';
	$house_site = 'http://www.landregistry.gov.uk/public/house-prices-and-sales';
	
	$house_html = file_get_html($house_site);
	
	$house_index = $house_html->find('span[id=hpi-average]', 0);
	$house = $house_index ->find('strong', 0);
	
	$house_monthly_annual = $house_html->find('div[class=hpi-result]', 0);
	$house_monthly_annual = str_replace("</div>", "", $house_monthly_annual);
	$house_monthly_annual = str_replace("<div", "", $house_monthly_annual);
	$house_monthly_annual = str_replace('class="hpi-result">', "", $house_monthly_annual);
	//echo $house_monthly_annual;
	
	/*$house_table = $house_index ->find('table[class=publications]', 0);
		
	$house = $house_table ->find('strong', 0);
	$monthly = $house_table ->find('strong', 1);
	$annual = $house_table ->find('strong', 2);
	*/
	
	$house = str_replace("</strong>", "", $house);
	$house = str_replace("<strong>", "", $house);
	$house = str_replace("£", "&pound;", $house);
	$temp = explode("<br />", $house_monthly_annual);
	
	$monthly = str_replace("Monthly ", "", $temp[0]);
	$annual = str_replace("Annual  ", "", $temp[1]);
	
	//echo $house . "<br />";
	//echo $monthly . "<br />";
	//echo $annual;
?> 