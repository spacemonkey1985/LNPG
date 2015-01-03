<?php
	$page = "";
	$page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);

	echo "<ul>";
	
	if($page == "members.php" || $page == "members-paid.php" || $page == "members-not-paid.php"){
		echo "<li class='current'><a href='members.php'>MEMBERS AREA</a></li>";
	}
	else{
		echo "<li><a href='members.php'>MEMBERS AREA</a></li>";
	}
    if($page == "benefits.php" || $page == "benefits-edit.php"){
		echo "<li class='current'><a href='benefits.php'>MEMBER BENEFITS</a></li>";
	}
	else{
		echo "<li><a href='benefits.php'>MEMBER BENEFITS</a></li>";
	}
	
	if($page == "partners.php" || $page == "partners-edit.php" || $page == "partners-docs.php"){
		echo "<li class='current'><a href='partners.php'>OUR PARTNERS</a></li>";
	}
	else{
		echo "<li><a href='partners.php'>OUR PARTNERS</a></li>";
	}
	if($page == "faq.php" || $page == "faq-edit.php"){
		echo "<li class='current'><a href='faq.php'>FAQS</a></li>";
	}
	else{
    	echo "<li><a href='faq.php'>FAQS</a></li>";
	}
	if($page == "reports.php" || $page == "google-reports.php"){
		echo "<li class='current'><a href='reports.php'>REPORTS</a></li>";
	}
	else{
    	echo "<li><a href='reports.php'>REPORTS</a></li>";
	}
	
	echo "</ul>";
?>