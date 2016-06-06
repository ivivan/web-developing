<?php
require('../connection.php');

//check if user and password are inputted
if(isset($_POST["user"])&&isset($_POST["passwd"])) {

	$user = $_POST['user'];
	$passwd = $_POST['passwd'];

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

	//if the data gets a result, login as the user
	if ($result->rowCount() > 0 ) {
		$row = $result->fetch();
		session_start();
		$_SESSION['user'] = $user;
		$_SESSION['id'] = $row['id'];
		echo "<script>alert('Successfully Logged In');
		window.location.href='http://{$_SERVER['HTTP_HOST']}/n9164766/index.php';
		</script>";
	} else {//redirect to login page with an error
		echo "<script>alert('Username or Password is not correct');
		window.location.href='http://{$_SERVER['HTTP_HOST']}/n9164766/login.php';
		</script>";
	}
}

?>