<?php
	$dbhost = 'localhost';
	$dbuser = 'scoulton';
	$dbpass = 'r8181055';
	$dbname = 'emarketing';
	
	if(!$conn = mysql_connect($dbhost, $dbuser, $dbpass)){
		echo mysql_error;
	}
	
	if(!mysql_select_db($dbname)){
		echo mysql_error;
	}
?> 
