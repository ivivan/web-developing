<?php
require('../connection.php');

//Process user inputs
$user = strip_tags($_POST['user']);
$passwd = $_POST['passwd'];
$email = $_POST['email'];
$bdate = strip_tags($_POST['bdate']);
$gender = strip_tags($_POST['gender']);
$wifi = (int)$_POST['wifi'];

$errors = [];
// Validate user unputs meet requirements
validate($errors, $_POST,'user', '/^\S*(?=\S{6,})\S*$/');
validate($errors, $_POST,'passwd', '/^\S*(?=\S{1,})\S*$/');
validate($errors, $_POST,'email', '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/');
validate($errors, $_POST,'bdate', '/^\S*(?=\S{6,})\S*$/');
validate($errors, $_POST,'gender', '/^\S*(?=\S{1,})\S*$/');
validate($errors, $_POST,'wifi', '/^\S*(?=\S{1,})\S*$/');


//Check whether data is posted
if(isset($user)&&isset($passwd)&&isset($email)&&isset($bdate)&&isset($gender)&&isset($wifi)) {
	$salt = uniqid();

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
			window.location.href='http://{$_SERVER['HTTP_HOST']}/n9164766/index.php';
			</script>";
		} else{
			echo "<script type= 'text/javascript'>alert('Data not successfully Inserted.');</script>";
		}
	}
}

?>