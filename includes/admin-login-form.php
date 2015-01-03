<?php
	if(isset($_SESSION['loggedIn'])){
		if($_SESSION['loggedIn'] == 1){
			echo('<img src="../images/members/' . $_SESSION['member_no'] . '/avatar.jpg" class="avatar" alt="Avatar" />');
			if(isset($_SESSION['admin'])){
				if($_SESSION['admin'] == 1){
					echo('<div class="welcome-msg">Welcome! <b>' . $_SESSION['name'] . '</b><br /><a href="../index.php">Main Site</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="../includes/sign_in.php?logout=1">Sign out</a></div>');
				}
			}
			else{
				echo('<div class="welcome-msg">Welcome! <b>' . $_SESSION['name'] . '</b><br /><a href="../includes/sign_in.php?logout=1">Sign out</a></div>');
			}
		}
		else{
			echo('<a href="../login.php" class="sign-in"><img src="images/sign-in-btn.png" alt="Sign In" /></a>');
        	echo('<a href="../join.php" class="join-now"><img src="images/join-now-btn.png" alt="Join Now" /></a>');
		}
	}
	else{
		echo('<a href="../login.php" class="sign-in"><img src="images/sign-in-btn.png" alt="Sign In" /></a>');
        echo('<a href="../join.php" class="join-now"><img src="images/join-now-btn.png" alt="Join Now" /></a>');
	}
?>