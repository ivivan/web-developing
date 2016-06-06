<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<?php
			$errors = array();
			require 'connection.php';
			require 'include/validate.inc';

			//check if user and password are inputted
			if(isset($_POST['submit'])){

				//create variables for registration input fields and validate if the inputs are right.
				$user = strip_tags($_POST['user']);
				$passwd = $_POST['passwd'];
				$email = $_POST['email'];
				$bdate = strip_tags($_POST['bdate']);
				if (!isset($_POST['gender'])) {
					validateGender($errors, $_POST, 'gender');
				} else {
					$gender = strip_tags($_POST['gender']);
				}
				$wifi = (int)$_POST['wifi'];
				validateUsername($errors, $_POST, 'user');
				validatePassword($errors, $_POST, 'passwd');
				validateEmail($errors, $_POST, 'email');
				validateBdate($errors, $_POST, 'bdate');

				validateDevices($errors, $_POST, 'wifi');

				//Check whether data is inserted into the fields
				if(isset($user)&&isset($passwd)&&isset($email)&&isset($bdate)&&isset($gender)&&isset($wifi)) {

					$salt = uniqid();

					//if no errors are found execute sql query
					if (!isset($errors['user'])&&!isset($errors['passwd'])&&!isset($errors['email'])&&!isset($errors['bdate'])&&!isset($errors['gender'])&&!isset($errors['wifi'])) {
						//get results of both user or email
						try {
							$result = $pdo->prepare('SELECT id '.
												  'FROM members '.
												  'WHERE username = :user');
							$result->bindValue(':user',$user);
							$result->execute();

							$result2 = $pdo->prepare('SELECT id '.
												   'FROM members '.
												   'WHERE email = :email');
							$result2->bindValue(':email',$email);
							$result2->execute();
						}
						catch (PDOException $e) {
							echo $e->getMessage();
						}

						//if any or both usernames/emails are used, return an error and redirect back to register page.
						if ($result->rowCount() > 0 && $result2->rowCount() > 0) {
							echo "<script>alert('Username and email is already in use. Please use another one');
							window.location.href='http://{$_SERVER['HTTP_HOST']}/n9164766/register.php';
							</script>";
						} else if ($result->rowCount() > 0) {
							echo "<script>alert('Username is already in use. Please use another one');
							window.location.href='http://{$_SERVER['HTTP_HOST']}/n9164766/register.php';
							</script>";
						} else if ($result2->rowCount() > 0) {
							echo "<script>alert('Email is already in use. Please use another one');
							window.location.href='http://{$_SERVER['HTTP_HOST']}/n9164766/register.php';
							</script>";
						} else { //if they are not matching anything in database insert data to database
							$sql = "INSERT INTO members (username, salt, password, email, birthdate, gender, wifi_devices)
							VALUES ('$user', '$salt', SHA2(CONCAT('$passwd','$salt'),0),'$email','$bdate', '$gender', '$wifi')";
							if ($pdo->query($sql)) {
								echo "<script>alert('Registration Complete, Thank you for registering $user');
								window.location.href='http://{$_SERVER['HTTP_HOST']}/n9164766/login.php';
								</script>";
							} else{
								echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
							}
						}
					}
				}
			}
			include "include/header.inc"
		?>
  </head>
  <body>
    <div id="wrapper">
  	  <?php include "include/menu.inc" ?>
      <div id="backdrop">
      	<form id="form" action="register.php" method="POST">
          <h1>Register</h1>
		  <?php
			input_field($errors, 'user', 'text', '', 'Username');
			input_field($errors, 'passwd', 'password', '', 'Password');
			input_field($errors, 'email', 'email', 'adress@email.com', 'Email');
			input_field($errors, 'bdate', 'text', 'yyyy-mm-dd', 'Birthdate');
			input_radio_button($errors, 'gender', 'radio', 'Male', 'Female', 'Other', 'Gender');
			input_field($errors, 'wifi', 'number', '', 'How many wifi enabled devices do you own?');
		  ?>
          <br /><br />
          <input class="button" name="submit" type="submit">
        </form>
      </div>
	  <?php include "include/footer.inc" ?>
    </div>
  </body>
</html>