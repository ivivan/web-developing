<?php
	//Connect to the database
	$pdo = new PDO('mysql:host=fastapps04.qut.edu.au;dbname=n9164766', 'n9164766', 'danielcavallaro1');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>