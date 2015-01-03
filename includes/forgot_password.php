<?php

	ob_start(); 
	session_start();
	include('../connect/db_connection.php');
	include('../include/common.php');
	
	$key='r8181055';
	
	$_SESSION['loggedIn'] = 0;
	
	if(isset($_POST['email'])){
		$get_password = "SELECT Password FROM empg_member WHERE Email = '" . $_POST['email'] . "';";
		
		if(!$result = mysql_query($get_password)){
			ob_clean();
			header('location: ../login.php?error=1');
		}
		else{
			if(mysql_num_rows($result) == 0){
				ob_clean();
				header('location: ../login.php?error=1');
			}
			else{
				while($row = mysql_fetch_array($result)){					
					$to = $_POST['email'];
					$subject = 'LNPG - Forgot Password';
					$body = "Hi, \r\nYour password for your LNPG account is:\r\n\r\n" . $row['Password'];
				
					mail($to, $subject, $body, 'From: info@LNPG.co.uk');
					
					ob_clean();
					header('location: ../login.php?sent=1');
				}
			}
		}						
	}
	else{
		ob_clean();
		header('location: ../login.php?no_email=1');
	}
	
	mysql_close($conn);
	
?>