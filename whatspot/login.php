<?php include 'includes/header.inc'; ?>

<?php

	$loginError = '';
	$loginSuccess = '';
	$welcome = '';
	$redirectMsg = '';
	$uname = '';

	// check if login request was result of unauthorised access, if so explain to user why

	if (isset($_GET['redirect'])){
		if ($_GET['redirect'] == 'true'){
			$redirectMsg = '<p class="error" id="redirectMsg">I\'m sorry, you need to be logged in to use this function.</p>';
			$_SESSION['redirect'] = 'true';
		}
	}

	if (isset($_GET['itemID'])){

		if(!isset($_SESSION)){
			session_start();
		}

		$_SESSION['targetItem'] = $_GET['itemID'];
	}		

	// when user tries to submit

	if(isset($_POST['submit'])){

		if (isset($_POST['uname'])){
			$uname = prepare($_POST['uname']);
		} else {
			$uname = '';
		}

		// hash the password - later update to a better cypher than md5 (remove)

		try { 

			$hashed = $_POST['password'];

			// check login function located in incs/functions.inc

			checkLogin($pdo, $uname, $hashed);			

		} catch (PDOException $e) {

				// print PDO errors if there any any

				echo $e->getMessage(); 

		}

	}

?>
		
<div>

	<br><br><br>

	<form class="loginForm" id="loginForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">

		<h1>Login</h1>

		<?php echo $redirectMsg; ?>
		<p id="registrationRedirect">Don't have an account? <a href="register.php">Get one here!</a></p>

		<div>
		<label for="uname">Username: </label><input type="text" id="uname" name="uname" value="<?php echo $uname; ?>"/><br>
		</div>
		<div>
		<label for="password">Password: </label><input type="password" id="password" name="password" /><br>
		</div>
		<button type="submit" name="submit" class="button" id="loginButton" value="Login!">Login!</button><br><br>

		<span class="error"><?php echo $loginError; ?></span>


	</form>

</div>

<?php include 'includes/footer.inc'; ?>


