<?php 
	ob_start();
	
	include('connect/db_connection.php');

	if(isset($_GET['member'])){
		$apply_to_partner = "INSERT INTO empg_member_partner(MemberNo, PartnerId, Status) VALUES(" . $_GET['member'] . ", " . $_GET['partner'] . ", 1);";
	
		mysql_query($apply_to_partner);
		
		mysql_close($conn);
		
		ob_clean(); 
		header('Location: ' . $_GET['form']);
	}
	else{
		ob_clean(); 
		header('Location: members.php');
	}
	   
?> 