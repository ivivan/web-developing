<header>
<h1 class="black_title">WhereFi</h1>
<a href="index.php">Home</a> |
<a href="register.php">Register</a> |
<?php
	// Check if session has started or not
	if(!isset($_SESSION)) {
        session_start();
    }
	// Display login/logout option
	if(isset($_SESSION['user'])) {
		echo "<a href='login/logout.php'>";
		echo $_SESSION['user'],	"-logout</a>";
	}else{
		echo "<a href='login.php'>Login</a>";
	}
?>
</header>