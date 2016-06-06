<?php 	

	include 'includes/header.inc';
	require 'includes/checkLogin.inc';

?>

<?php

	// declare empty variables;

	$reviewSuccessful = $titleError = $textError = $titleText = $reviewText = '';
	$errorCount = 0;

	try { 

		// check to see there was an actual POST event

		if ($_SERVER["REQUEST_METHOD"] == "POST"){

			// if user did not enter a title
			if (empty($_POST['reviewTitle'])){

				// inform them with an error and count error
				$titleError = 'Please enter a title.';
				$errorCount = $errorCount + 1;

			} else {
				$titleText = $_POST['reviewTitle'];
			}

			// if user did not enter any text
			if (empty($_POST['review'])){

				$textError = 'Please enter some review text.';
				$errorCount = $errorCount + 1;

			} else {
				$reviewText = $_POST['review'];
			}

			// if there are no errors - commit data to DB

			if (!$errorCount){

				// prepare PDO statement

				$sql = "INSERT INTO Reviews(authorID, siteID, reviewTitle, reviewText, reviewRating) 
						VALUES (:memberID, :itemID, :reviewTitle, :review, :rating)";
				$stmt = $pdo->prepare($sql);

				// execute data

				if ($stmt->execute(array(

						"memberID" => prepare($_SESSION['memberID']),	
						"itemID" => prepare($_POST['siteID']),
						"reviewTitle" => prepare($_POST['reviewTitle']),
						"review" => prepare($_POST['review']),
						"rating" => prepare($_POST['rating'])

					))){

						$reviewSuccessful = "Review Successful.";
						$titleText = $reviewText = '';
				} 
			}
		}

	} catch (PDOException $e) {

			echo $e->getMessage(); 

	}

?>

<br>

<form class="reviewForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>"" method="POST">

	<h1>Review</h1>

	<div>

		<label for="siteID">Site Name: </label><select id="siteID" name="siteID">

		<?php

			// check to see if session was started - if not - start one

			if(!isset($_SESSION)){
				session_start();
			}

			// prepare pdo statement

			$stmt = $pdo->prepare('SELECT itemID, Name FROM Items ORDER BY Name ASC');
			$stmt->execute();

			// fetch data

			$row = $stmt->fetchAll();

			foreach ($row as $option){

				// this is the code that will preselect a site by ID if it was passed in via the URL

				if(isset($_GET['itemID'])){

					if ($_GET['itemID'] == $option['itemID']){
						echo '<option value="' . $option['itemID'] . '" selected>' . $option['Name'] . '</option>';  // automatically preselct site if coming from a review link
					} else {
						echo '<option value="' . $option['itemID'] . '">' . $option['Name'] . '</option>';
					}

				} else {
					echo '<option value="' . $option['itemID'] . '">' . $option['Name'] . '</option>';
				}

			}

		?> </select><br>

		<label for="rating">Rating: </label><select id="rating" name="rating">

			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>

			</select><br>

		<label for="reviewTitle">Title: </label><input name="reviewTitle" size="100" value="<?php echo $titleText; ?>" placeholder="Enter your title here." autofocus/><span class="error"> <?php echo $titleError; ?></span><br>

		<label for="review">Review: </label> <br><textarea name="review" rows="20" cols="124" value="<?php echo $reviewText; ?>" placeholder="Enter your review text here."></textarea><span class="error"><?php echo $textError; ?></span><br>

	</div>

	<span id="querySuccess"><?php echo $reviewSuccessful; ?></span>

	<button type="submit" name="submit" class="button" id="reviewButton" value="Submit Review">Submit Review</button>	

</form>

<?php include 'includes/footer.inc'; ?>

