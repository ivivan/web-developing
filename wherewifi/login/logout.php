<?php
//logs out user
session_start();
unset($_SESSION['user']);
echo "<script>alert('Logged out successfully');
	  window.location.href='http://{$_SERVER['HTTP_HOST']}/n9164766/index.php';
	  </script>";
?>