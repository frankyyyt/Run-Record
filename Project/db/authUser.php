<?php

	include_once "db.php";

	if(isset($_POST['username']) && isset($_POST['password'])) {

		$username = $_POST['username'];
		$pass = $_POST['password'];

		print($username);
		print($password);

		if(authUser($username, $pass)) {
			setcookie("User", $username, time() + (86400 * 30), "/"); // 86400 = 1 day
			setcookie("loginError", "", time() - 3600, "/"); //reset any login errors
			header('Location: https://webdev.cs.kent.edu/~knovak18/web2/Test/Project/main.php');
		}
		else {
			setcookie("loginError", "password", time() + (30), "/");
			header('Location:https://webdev.cs.kent.edu/~knovak18/web2/Test/Project/login.php');
		}
	}
?>