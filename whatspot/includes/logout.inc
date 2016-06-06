<?php

	if(!isset($_SESSION)){
		session_start();
	}

	// make sure the user session status ends - without a doubt!

	unset($_SESSION['status']);
	session_unset();
	session_destroy();
	header('Location: login.php');
	die();

?>