<?php
	$page = "";
	$page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

	echo "<ul>";
	
	if($page == "index.php" || $page == "" || $page == "Index.php"){
		echo "<li class='current' style='line-height: 40px;'><a href='index.php'>HOME</a></li>";
	}
	else{
		echo "<li style='line-height: 40px;'><a href='index.php'>HOME</a></li>";
	}
	
	if($page == "comparisons.php"){
		echo "<li class='current'><a href='comparisons.php'>COMPARE<br />OUR PRICES</a></li>";
	}
	else{
		echo "<li><a href='comparisons.php'>COMPARE<br />OUR PRICES</a></li>";
	}
	
	if($page == "benefits.php"){
		echo "<li class='current'><a href='benefits.php'>MEMBER<br />BENEFITS</a></li>";
	}
	else{
		echo "<li><a href='benefits.php'>MEMBER<br />BENEFITS</a></li>";
	}
	
	if($page == "partners.php"){
		echo "<li class='current'><a href='partners.php'>OUR<br />PARTNERS</a></li>";
	}
	else{
		echo "<li><a href='partners.php'>OUR<br />PARTNERS</a></li>";
	}
	
	if($page == "about.php"){
		echo "<li class='current' style='line-height: 40px;'><a href='about.php'>ABOUT US</a></li>";
	}
	else{
		echo "<li style='line-height: 40px;'><a href='about.php'>ABOUT US</a></li>";
	}
	
	if($page == "testimonials.php"){
		echo "<li class='current'><a href='testimonials.php'>LANDLORDS<br />TESTIMONIALS</a></li>";
	}
	else{
		echo "<li><a href='testimonials.php'>LANDLORDS<br />TESTIMONIALS</a></li>";
	}
	
	if($page == "news.php"){
		echo "<li class='current' style='line-height: 40px;'><a href='news.php'>NEWS</a></li>";
	}
	else{
		echo "<li style='line-height: 40px;'><a href='news.php'>NEWS</a></li>";
	}
	
	if($page == "venue.php"){
		echo "<li class='current'><a href='venue.php'>MEETINGS<br />AND EVENTS</a></li>";
	}
	else{
		echo "<li><a href='venue.php'>MEETINGS<br />AND EVENTS</a></li>";
	}
	
	if($page == "contact.php"){
		echo "<li class='current' style='line-height: 40px;'><a href='contact.php'>CONTACT US</a></li>";
	}
	else{
		echo "<li style='line-height: 40px;'><a href='contact.php'>CONTACT US</a></li>";
	}
	
	if($page == "faq.php"){
		echo "<li class='current' style='line-height: 40px;'><a href='faq.php'>FAQS</a></li>";
	}
	else{
    	echo "<li style='line-height: 40px;'><a href='faq.php'>FAQS</a></li>";
	}
	
	if($page == "members.php" || $page == "members-partners.php" || $page == "members-edit.php" || $page == "affiliate.php" || $page == "affiliate_step1.php" || $page == "affiliate_step2.php" || $page == "affiliate_step3.php"){
		echo "<li class='current'><a href='members.php'>MEMBERS<br />AREA</a></li>";
	}
	else{
		echo "<li><a href='members.php'>MEMBERS<br />AREA</a></li>";
	}
    
	echo "</ul>";
?>