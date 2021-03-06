<?php
	function printActivePage($index) {
		if($index === 1) {
			if(strpos($_SERVER['PHP_SELF'],"record.php") !== FALSE){
				echo 'class="active"';
				return 'class=""';
			}
		}
		else if($index === 2) {
			if(strpos($_SERVER['PHP_SELF'],"myruns.php") !== FALSE || strpos($_SERVER['PHP_SELF'],"editRun.php") !== FALSE){
				echo 'class="active"';
				return 'class=""';
			}
		}
		else if($index === 3) {
			if(strpos($_SERVER['PHP_SELF'],"stats_main.php") !== FALSE){
				echo 'class="active"';
				return 'class=""';
			}
		}
		else if($index === 4) {
			if(strpos($_SERVER['PHP_SELF'],"profile.php") !== FALSE || strpos($_SERVER['PHP_SELF'],"edit.php") !== FALSE|| strpos($_SERVER['PHP_SELF'],"delete.php") !== FALSE|| strpos($_SERVER['PHP_SELF'],"changePassword.php") !== FALSE|| strpos($_SERVER['PHP_SELF'],"uploadPicture.php") !== FALSE){
				return 'class="active"';

			}
		}
	}
?>

<div id="navbar">
	<nav role="navigation" class="navbar navbar-inverse navbar-fixed">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
		    <span class="sr-only">Toggle navigation</span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		    <span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand logo" href="../main.php">Record•Run</a>
		</div>
		<div id="navbarCollapse" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li <?php printActivePage(1); ?> ><a href="../record.php">Record a Run</a></li>
				<li <?php printActivePage(2); ?> ><a href="../myruns.php">My Runs</a></li>
				<li <?php printActivePage(3); ?> ><a href="../stats/stats_main.php">Statistics</a></li>
			</ul>
			<?php
			print('<ul class="nav navbar-nav navbar-right">');
					if(isset($_COOKIE['User'])) {
						$active = printActivePage(4);
						print('<li '.$active.'><a href="../profile/profile.php">'.$_COOKIE['User'].'</a></li>');
						print('<li><a href="../logout.php">Log Out</a></li>');
					}
					else {
						print('<li><a href="../login.php#">Login</a></li>');
						print('<li><a href="../create.php">Create Account</a></li>');
						header('Location: ../welcome.php');
					}
				?>
				<!-- if the user is logged in, replace create account with
						"Profile" instead, and link to "Profile.php"-->
			</ul>
		</div>
	</nav>
</div>

<!-- NAVBAR BUFFER -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand logo" href="../welcome.php">Record•Run</a>
        </div>
    </div>
</nav>
