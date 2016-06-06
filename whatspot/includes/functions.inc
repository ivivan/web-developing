<?php

	function prepare($data){

		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);

		return $data;

	}

	function haversine($lat1, $lng1, $lat2, $lng2){

		$earthRadius = 6373;

		$dlat = (($lat2 - $lat1)*pi())/180;
		$dlng = (($lng2 - $lng1)*pi())/180;

		$a = pow((sin($dlat/2)),2) + cos($lat1) * cos($lat2) * pow((sin($dlng/2)),2);
		$c = 2 * atan2(sqrt($a), sqrt(1 - $a));

		$distance = $earthRadius * $c;

		return $distance;	

	}

	function checkLogin($pdo, $uname, $hashed){

			$sql = "SELECT * FROM Members WHERE memberName = ? AND pwdHash = SHA2(CONCAT(?, salt), 0)";
			$query = $pdo->prepare($sql);
			$query->bindParam(1, $uname);
			$query->bindParam(2, $hashed);
			$query->execute();

			$result = $query->fetchAll(PDO::FETCH_ASSOC);

			// if username exists and matches and the hashed password matches start session and log user in

			if($result){

					if(!isset($_SESSION)){
						session_start();
					}

				$_SESSION['memberID'] = $result[0]['memberID'];
				$_SESSION['uname'] = $uname;
				$_SESSION['status'] = 1;
				$_SESSION['fname'] = $result[0]['fname'];

				// javascript script to redirect user on login

				// check if login was due to redirect, if it was redirect to review page otherwise go to profile page

				if (!empty($_SESSION['redirect'])){
					$redirectLink = '\'review.php?\'';
				} else {
					$redirectLink = '\'profile.php?userID=' . $_SESSION['memberID'] . '&login=good\'';
				}

				// if there was also a target item after redirect then prep review page ready to review that item

				if (!empty($_SESSION['targetItem'])){
					$redirectLink = '\'review.php?itemID=' . $_SESSION['targetItem'] . '\'';
				} 

			?>  
				<script type="text/javascript">
					window.location.href = <?php echo $redirectLink; ?>;
				</script>

			<?php 
				
				die();

			} else {

				$loginError = "<p class=\"error\">Login Credentials are incorrect, please try again.</p>";
				
			}

	}

?>