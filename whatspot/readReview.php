<?php include 'includes/header.inc'; ?>

<?php

	// get review ID from url

	$reviewID = $_GET['reviewID'];

	// prepare pdo query - joins members, reviews and items so that the author name and site name can be published which is more user friendly than just ID numbers

	$stmt = $pdo->prepare('SELECT m.memberName, a.* FROM members m INNER JOIN 
						 (SELECT * FROM reviews r INNER JOIN 
						 items i ON r.siteID = i.itemID WHERE r.reviewID = ?) 
						 AS a ON a.authorID = m.memberID;');
	$stmt->bindParam(1, $reviewID);
	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	// rename variables for easier referencing

	$siteName = $result['Name'];
	$authorName = $result['memberName'];
	$suburb = $result['Suburb'];
	$reviewTitle = $result['reviewTitle'];
	$reviewText = $result['reviewText'];
	$reviewDate = $result['reviewDate'];
	$reviewRating = $result['reviewRating'];
	$lat = $result['Latitude'];
	$lng = $result['Longitude'];

?>

<div class="reviewData">

	<!-- This is the HTML output that encodes it with microdata -->

	<h2><?php echo $reviewTitle; ?></h2>

	<div itemscope="" itemtype="http://schema.org/Place">

		<b>Site: </b><span itemprop="name"><?php echo $siteName; ?></span><br>

		<!-- address microdata -->

		<div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">

			<b>Locality: </b><span itemprop="addressLocality"><?php $suburbArr = explode(',', $suburb); echo $suburbArr[0] . ', Australia';?></span><br>	
		
		</div>

		<!-- Coordinate microdata -->

		<div itemprop="geo" itemscope="" itemtype="http://schema.org/GeoCoordinates">
		
			<b>Latitude: </b><?php echo $lat; ?><br>
			<b>Longitude: </b><?php echo $lng; ?><br>
			<meta itemprop="latitude" content="<?php echo $lat; ?>">
			<meta itemprop="longitude" content="<?php echo $lng; ?>">

		</div>

		<!-- Review microdata -->

		<div itemprop="Review" itemscope="" itemtype="http://schema.org/Review">
		
			<meta itemprop="name" content="<?php echo $reviewTitle; ?>">
			<b>Date: </b><span itemprop="datePublished"><?php $dateArr = explode(' ', $reviewDate); echo $dateArr[0]; ?></span><br>
			<b>Author: </b><span itemprop="author"><?php echo $authorName; ?></span><br>
			<b>Rating: </b><?php echo $reviewRating; ?> out of 5<br><br>
			<b>Review: </b><br><span class="reviewDataText" itemprop="description"><?php echo $reviewText; ?></span><br>

		</div>
		
	</div>

</div>

<?php include 'includes/footer.inc'; ?>