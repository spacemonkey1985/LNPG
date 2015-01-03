<?php
	
	session_start();
	
	if(isset($_SESSION['loggedIn'])){
		if($_SESSION['loggedIn'] != 1){
			header('location: ../login.php');
		}
	}
	else{
		header('location: ../login.php');
	}
	
	$filename ="member_list.xls";
	
	header('Content-type: application/ms-excel');
	header('Content-Disposition: attachment; filename='.$filename);
	
	include('../connect/db_connection.php');	
	include('../includes/common.php');
	
	$contents = "Member no\tFull name\tAddress1\tCity\tCounty\tPostCode\tTel no\tEmail\tSignup Date\tJoin Date\tPay Date\tUpdated\n";
	
	if($_GET['type'] == 'registered'){
		$members = "SELECT * FROM empg_member WHERE Active = 1;"; // Active = 1
	}
	if($_GET['type'] == 'paid'){
		$members = "SELECT * FROM empg_member WHERE PaymentDate is not null;"; // Active <> 1 AND Password is not null
	}
	if($_GET['type'] == 'unpaid'){
		$members = "SELECT * FROM empg_member WHERE PaymentDate is null;"; // Password is null
	}
	
	if(!$result = mysql_query($members)){
		echo mysql_error();
	}
	else{
		while($row = mysql_fetch_array($result)){
			$address = $row['Add1'] . "\t" . $row['City'] . "\t" . $row['County'] . "\t" . $row['PostCode'];
			$contents = $contents . "M001" . str_pad((int) $row['MemberNo'],3,"0",STR_PAD_LEFT) . "\t" . $row['Fullname'] . "\t" . $address . "\t" . $row['TelNo'] . "\t" . $row['Email'] . "\t";
			$contents .= ($row['SignUpDate'] == '' || $row['SignUpDate'] ==  null) ? "" : date_format(date_create($row['SignUpDate']), 'Y/m/d');
			$contents .= "\t";
			$contents .= ($row['JoinDate'] == '' || $row['JoinDate'] ==  null) ? "" : date_format(date_create($row['JoinDate']), 'Y/m/d');
			$contents .= "\t";
			$contents .= ($row['PaymentDate'] == '' || $row['PaymentDate'] ==  null) ? "" : date_format(date_create($row['PaymentDate']), 'Y/m/d');
			$contents .= "\t";
			$contents .= ($row['DateTimeStamp'] == '' || $row['DateTimeStamp'] ==  null) ? "" : date_format(date_create($row['DateTimeStamp']), 'Y/m/d');
			
			$contents = $contents . "\n";
		}
	}

	echo $contents;
	
?>