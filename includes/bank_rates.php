<?php 

	//include('simple_html_dom.php');
	
	$site = 'http://www.bankofengland.co.uk/Pages/home.aspx';
	
	$site_html = file_get_html($site);
	
	$rate = $site_html->find('span[id=ctl00_ctl20_g_85a990cc_e102_4ad9_a336_dd321212c1d7_ctl00_lstKeyFacts_ctrl0_Label2]', 0);
	$inflation = $site_html ->find('span[id=ctl00_ctl20_g_85a990cc_e102_4ad9_a336_dd321212c1d7_ctl00_lstKeyFacts_ctrl2_Label2]', 0);
	
	//echo $rate . "<br />";
	//echo $inflation;
	
?> 