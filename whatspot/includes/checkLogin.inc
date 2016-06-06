<?php

	if (!isset($_SESSION['status'])) { 

		if (isset($_GET['itemID'])) {
			header("Location: login.php?redirect=true&itemID=" . $_GET['itemID']);
		} else {
			header("Location: login.php?redirect=true");
		}
	
	}

?>