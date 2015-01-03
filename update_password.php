<?php

	ob_start(); 
	session_start();
	include('connect/db_connection.php');
	include('include/common.php');
	
	$key='r8181055';
	
	if(isset($_POST['new_password'])){
		$update_password = "UPDATE empg_member SET Password = '" . $_POST['new_password'] . "' WHERE MemberNo = " . $_SESSION['member_no'] . ";";
		
		mysql_query($update_password);
		
		header('location: login.php?changed=1');		
	}
	else{
		header('location: login.php?changed=0');
	}
	
	mysql_close($conn);
	
	$_SESSION['loggedIn'] = 0;
	
?>
