<?php 

	include 'includes/header.inc';

	// make sure the user is logged in, otherwise redirect to the login page 
	require 'includes/checkLogin.inc';

?>

<?php

	// get posted userID to retrieve relevant user information

	$userID = $_GET['userID'];
	$loginMessage = '';

	// check to see if the loading of this page was due to a successful login - if it was inform them so

	if (isset($_GET['login'])){

		$loginStatus = $_GET['login'];

			if ($loginStatus == "good"){
				$loginMessage = 'Login Successful!';
			}

	}

	// prepare pdo query - select all user information for this member's memberID

	$stmt = $pdo->prepare('SELECT * FROM members WHERE memberID = ?');
	$stmt->bindParam(1, $userID);	
	$stmt->execute();

	// retrieve the result (we know that it will exist as user must already be logged in)

	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	// reallocate data to variables with shorter, more manageable names

	$memberID = $result['memberID'];
	$memberName = $result['memberName'];
	$memberFname = $result['fname'];
	$memberLname = $result['lname'];
	$memberEmail = $result['email'];
	$memberPC = $result['addressPC'];
	$memberMarketing = $result['marketing'];
	$memberDOB = $result['DOB'];

	// make a new query this time getting the users reviews (if any) otherwise inform that they don't have any and give them a link to the reviews page

	$stmt = $pdo->prepare('SELECT * FROM reviews WHERE authorID = ?');
	$stmt->bindParam(1, $userID);
	$stmt->execute();

	$row = $stmt->fetchAll();

	// check to see if any results were returned

	if ($row) {

		// if there were prepare table header

		$results = '<p class="tableTitle">Your Reviews</p>';
		$results = $results . '<table> <tr> <th>Review Number</th> <th>Review Title</th> <th>Date</th> <th>Rating</th> </tr>';

		// now create and populate a row for each review giving a link to the individual review via its title

		foreach ($row as $reviews){

			$results = $results . '<tr>';
			$results = $results . '<td>' . $reviews['reviewID'] . '</td>';
			$results = $results . '<td><a href="readReview.php?reviewID=' . $reviews['reviewID'] . '">' . $reviews['reviewTitle'] . '</a></td>';
			$results = $results . '<td>' . $reviews['reviewDate'] . '</td>';
			$results = $results . '<td>' . $reviews['reviewRating'] . '</td>';
			$results = $results . '</tr>';

		}

		// end table

		$results = $results . '</table>';

	} else {

		// display this if the user currently has not made any reviews

		$results = '<br><br><span class="returnError">You have not made any reviews
					Why not make one <a href="review.php">here</a>?</span>';
	}

?>

<!-- Start HTML -->

<div>
	<span class="success" ><?php echo $loginMessage; ?></span><br>
</div>

<div class="userData">

	<!-- Output each piece of information on its own line with a descriptor before it -->
	
	<h1><?php echo $memberName; ?></h1><br>

	<b>User ID: </b><?php echo $memberID; ?><br>
	<b>First Name: </b><?php echo $memberFname; ?><br>
	<b>Surname: </b><?php echo $memberLname; ?><br>
	<b>Email Address: </b><?php echo $memberEmail; ?><br>
	<b>Post Code: </b><?php echo $memberPC; ?><br>
	<b>Marketing Status: </b><?php echo $memberMarketing; ?><br>
	<b>DOB: </b><?php echo $memberDOB; ?><br>


</div>

<!-- Add a default image for the user - normally they would be able to add their own but this functionality has not been added yet -->

<div id="userImg">
	
	<img src="imgs%2Fuserpic.png" alt="User Picture">

</div>

<div>	

<!-- echo the results table as created in the PHO code above -->

	<?php echo $results; ?>

</div>

<?php include 'includes/footer.inc'; ?>