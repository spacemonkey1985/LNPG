<?php
	if($_SERVER['HTTP_HOST']=='test.lnpg.co.uk')
	{
		$dbhost = 'localhost';
		$dbuser = 'website';
		$dbpass = '^4OQu716JG';
		$dbname = 'lnpgtest';
	}
	else
	{
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = 'punkrock';
		$dbname = 'lnpg';
	}
	if(!$conn = mysql_connect($dbhost, $dbuser, $dbpass)){
		echo mysql_error();
	}
	
	if(!mysql_select_db($dbname)){
		echo mysql_error();
	}
?> 
