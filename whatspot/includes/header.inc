<!DOCTYPE html>
<html>

<head>

	<!-- include stylesheet, javascript and title -->

	<link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css">
	<script type="text/javascript" src="scripts/scripts.js"></script>
	<title>Whatspot - Wifi Spot Locator for Brisbane</title>

<?php 

	// handles session data for every page - check to see it session exists then extracts session data

	include 'includes/pdo_connect.inc';
	include 'includes/functions.inc';

	if(!isset($_SESSION)){
		session_start();
	}

	if(isset($_SESSION['fname'])){
		$name = $_SESSION['fname'];
	}

	if(isset($_SESSION['memberID'])){
		$ID = 	$_SESSION['memberID'];
	}

	// dynamically build navbar depending on login status	
	
	if(!empty($_SESSION['status'])){		
		$logLink = '<li><a href="logout.php">Logout</a></li>';
		$regLink = '<li><a href="profile.php?userID=' . $ID . '">Profile</a></li>';
		
	} else {
		$logLink = '<li><a href="login.php">Login</a></li>';
		$regLink = '<li><a href="register.php">Register</a></li>';
	}

?>


</head>

<!-- begin Body - terminated in footer.inc -->

<body>

<!-- Begin main wrapper div - contains every in the body -->

<div id="wrapper"> 

	<!-- header - has logo and welcome message depending on login status-->

	<div id="header">

		<!-- Display Logo -->

		<div id="logo"><a href="index.php"><img src="imgs%2Flogo_big.png" alt="Whatspot Logo" width="217" height="71"></a></div>

		<?php 

			// if user is logged in display a welcome message in header

			if(!empty($_SESSION['status'])){
				echo '<span id="welcome">Welcome, ' . $name . ' (Id: ' . $ID .')</span><br>'; 
			}
		?>

	</div>

	<!-- navbar - dynamically built depending on login status -->

	<div id="navbar">

		<ul id="nav" class="nav">

			<li><a href="index.php">Home</a></li>
			<li><a href="search.php" onclick="getLocation();">Search</a></li>
			<li><a href="review.php">Review</a></li>					
			<?php echo $regLink; ?>
			<?php echo $logLink; ?>

		</ul>		

	</div>

	<!-- Begin main div each page's content goes in here - terminated in footer.inc -->

	<div id="main">



