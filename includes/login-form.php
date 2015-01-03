<?php

	if($_SERVER['HTTP_HOST']=='www.lnpg.co.uk')
	{
// First sectioon of GA script
$gascript = <<<EOT
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26473317-1']);
  _gaq.push(['_trackPageview']);
EOT;

		// Set custom var
		if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1)
		{
			if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
			{
$gascript .= <<<EOT
	_gaq.push(['_setCustomVar', 1, 'VisitorType', 'Admin', 1]);
EOT;
			}
			else
			{
$gascript .= <<<EOT
	_gaq.push(['_setCustomVar', 1, 'VisitorType', 'Member', 1]);
EOT;
			}
		}
	

// Last section of GA script
$gascript .= <<<EOT
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
EOT;

		echo $gascript;	
	}

	if(isset($_SESSION['loggedIn'])){
		if($_SESSION['loggedIn'] == 1){
			echo('<img src="images/members/' . $_SESSION['member_no'] . '/avatar.jpg" class="avatar" alt="Avatar" />');
			if(isset($_SESSION['admin'])){
				if($_SESSION['admin'] == 1){
					echo('<div class="welcome-msg">Welcome! <b>' . $_SESSION['name'] . '</b><br /><a href="admin/members.php">Administration</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="includes/sign_in.php?logout=1">Sign out</a></div>');
				}
			}
			else{
				echo('<div class="welcome-msg">Welcome! <b>' . $_SESSION['name'] . '</b><br /><a href="includes/sign_in.php?logout=1">Sign out</a></div>');
			}
		}
		else{
			echo('<a href="login.php" class="sign-in"><img src="images/sign-in-btn.png" alt="Sign In" /></a>');
        	echo('<a href="join.php" class="join-now"><img src="images/join-now-btn.png" alt="Join Now" /></a>');
		}
	}
	else{
		echo('<a href="login.php" class="sign-in"><img src="images/sign-in-btn.png" alt="Sign In" /></a>');
        echo('<a href="join.php" class="join-now"><img src="images/join-now-btn.png" alt="Join Now" /></a>');
	}

   	// Phone number
	echo '<div class="phoneNumber">';
	echo '<div class="phoneNumber1">Phone 01932 698146</div>';
	// echo '<div class="phoneTimes1">6 days a week</div>';
	echo '</div>';
?>