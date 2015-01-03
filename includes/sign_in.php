<?php
	session_start();
	
	ob_start();
	include('../connect/db_connection.php');
	
	if(isset($_GET['logout'])){
			$_SESSION['loggedIn'] = 0;
			
			ob_clean();
			header('location: ../index.php');
	}
	else{
		if(isset($_POST['un']) && isset($_POST['pw'])){
			$details = "SELECT * FROM empg_member WHERE Email = '" . $_POST['un'] . "' AND Password = '" . $_POST['pw'] . "' AND Active = 1;";
												
			if(!$result = mysql_query($details)){
				$_SESSION['loggedIn'] = 0;
				ob_clean();
				header('location: ../index.php');
			}
			else{
				if(mysql_num_rows($result) == 0){
					$_SESSION['loggedIn'] = 0;
					ob_clean();
					header('location: ../login.php?wrong=1');
				}
				else{
					while($row = mysql_fetch_array($result)){
						$_SESSION['loggedIn'] = 1;
						$_SESSION['member_no'] = $row['MemberNo'];
						$_SESSION['name'] = $row['Fullname'];
						$_SESSION['email'] = $row['Email'];
						$_SESSION['admin'] = $row['Administrator'];
						
						ob_clean();
						header('location: ../members.php');
					}
				}
			}
		}
		else{
			$_SESSION['loggedIn'] = 0;
			
			ob_clean();
			header('location: ../login.php?wrong=1');
		}
	}
?>