<!DOCTYPE html>
  <html>
	<head>
		<title>Login</title>
		<?php
			$errors = array();
			require 'connection.php';
			require 'include/validate.inc';
			//if button login is pressed start validating inputs
			if(isset($_POST['login'])){
				validateUsername($errors, $_POST, 'user');
				validatePassword($errors, $_POST, 'passwd');
				if(isset($_POST["user"])&&isset($_POST["passwd"])) { //check if user and password are inputted
					$user = $_POST['user'];
					$passwd = $_POST['passwd'];
					if (!isset($errors['user'])&&!isset($errors['passwd'])) {
						//compares values of posted data and database
						try {
							$result = $pdo->prepare('SELECT * '.
													'FROM members '.
													'WHERE username = :user and password = SHA2(CONCAT(:passwd, salt), 0) ');
							$result->bindValue(':user',$user);
							$result->bindValue(':passwd',$passwd);
							$result->execute();
						}

						catch (PDOException $e) {
							echo $e->getMessage();
						}

						//if the data gets a result, login as the user else returns invalid input and alerts to try again.
						if ($result->rowCount() > 0 ) {
							$row = $result->fetch();
							if(!isset($_SESSION))
							{
							    session_start();
							}
							$_SESSION['user'] = $user;
							$_SESSION['id'] = $row['id'];
							echo "<script>alert('Successfully Logged In');";
							header("Location: index.php");
						} else {
							echo "<script>alert('Invalid Username/Password');
							</script>";
						}
					}
				}
			}
		?>
		<?php include "include/header.inc" ?>
	</head>
	<body>
		<div id="wrapper">
			<?php include "include/menu.inc" ?>
			<div id="backdrop">
				<div class="widget">
					<form id="form" action="Login.php" method="POST">
						<h1>Login</h1>
						<?php
							 input_field($errors, 'user', 'text', '', 'Username');
							 input_field($errors, 'passwd', 'password', '', 'Password');
						?>
						<br/>
						<input class="button" name="login" type="submit" value="login"/>
						<br/><br/>
					</form>
				</div>
			 </div>
			<?php include "include/footer.inc" ?>
		</div>
	</body>
</html>