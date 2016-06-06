<?php include 'includes/header.inc'; ?>

<?php 

	// remove quotation marks from post value

	$itemID = str_replace('\"', '', $_GET['itemID']);
	$itemID = trim($itemID, '"');

	// pdo query for retrieving all columns for an item matching on itemID

	$stmt = $pdo->prepare('SELECT * FROM Items WHERE itemID = ?');
	$stmt->bindParam(1, $itemID);	
	$stmt->execute();

	// retrieve values
	
	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	// reallocate data to variables with shorter more manageable names
	
	$name = $result['Name'];
	$address = $result['Address'];
	$suburb = $result['Suburb'];
	$lat = $result['Latitude'];
	$long = $result['Longitude'];

	// build map string dynamically with lat and lng as 'q' parameters

	$mapString = "\"https://www.google.com/maps/embed/v1/place?key=AIzaSyAucGenGfs-Jnr2JYC_hdkmBVfVmagvf_c&q=$lat,$long\"";
	$result = '';	

?>

<!-- output site data in microdata format -->

<div class="itemData">

	<div itemscope itemtype="http://schema.org/Place">

		<h2><span itemprop="name"><?php echo $name; ?></span><br></h2>

		<div itemprop="geo" itemscope itemtype="http://schema.org/GeoCoordinates">
			
				<b>Latitude: </b><?php echo $lat; ?><br>
				<b>Longitude: </b><?php echo $long; ?><br>
				<meta itemprop="latitude" content="<?php echo number_format($lat, 5);?>" />
				<meta itemprop="longitude" content="<?php echo number_format($long, 5);?>" />

		</div>

		<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
			
			<b>Street Address: </b><span itemprop="streetAddress"><?php echo $address;?></span><br>
			<b>Locality: </b><span itemprop="addressLocality"><?php $suburbArr = explode(',', $suburb); echo $suburbArr[0] . ', Australia';?></span><br>
			<b>Postcode: </b><span itemprop="postalCode"><?php echo $suburbArr[1];?></span><br>

		</div>

	</div>

	<p>Review this site <a href="<?php echo "review.php?itemID=$itemID"; ?>">here!</a></p>

</div>

<div>	

	<iframe
		id="mapsFrame"
		width="400"
	    height="400"
	    src= <?php echo $mapString; ?> >
	</iframe>

</div>

<?php

	// php to build a table of al reviews for the site

	$stmt = $pdo->prepare('SELECT * FROM reviews WHERE siteID = ?');
	$stmt->bindParam(1, $itemID);
	$stmt->execute();

	// fetch data

	$row = $stmt->fetchAll();	

	// check to see if there was any data returned, if so build a table for it, if not advise user there isn't any and provide a link to do so

	if ($row) {

		// build table header

		echo '<br><br> <table> <tr> <th>Review Number</th> <th>Review Title</th> <th>Review Date</th> <th>Rating</th> </tr>';

		// make a row for each instance

		foreach ($row as $review){

			echo '<tr>';
			echo '<td>' . $review['reviewID'] . '</td>';
			echo '<td><a href="readReview.php?reviewID=' . $review['reviewID'] . '">' . $review['reviewTitle'] . '</td>';
			echo '<td>' . $review['reviewDate'] . '</td>';
			echo '<td>' . $review['reviewRating'] . '</td>';
			echo '</tr>';

		}

		// terminate table

		echo '</table>';

	} else {

		// message to display to user that no reviews exist yet - if this is the case

		$result = "<br><br><div><span class=\"error\">There are currently no reviews for this site.  
					Why not make one <a href=\"review.php?itemID=$itemID\">here</a>?</span></div>";

		// output the string to HTML

		echo $result;

	}

	

?>

<?php include 'includes/footer.inc'; ?>


<!-- Example of Metadata HTML output validated @ https://search.google.com/structured-data/testing-tool?hl=EN 24/5/16

<div itemscope="" itemtype="http://schema.org/Place">
		
	<h2><span itemprop="name">Sandgate Library Wifi</span><br></h2>
			
	<div itemprop="geo" itemscope="" itemtype="http://schema.org/GeoCoordinates">				
						
		<b>Latitude: </b>-27.32060523<br>						
		<b>Longitude: </b>153.0704927<br>						
		<meta itemprop="latitude" content="-27.32061">						
		<meta itemprop="longitude" content="153.07049">
			
	</div>

			
	<div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">				
				
		<b>Street Address: </b><span itemprop="streetAddress">Seymour Street</span><br>					
		<b>Locality: </b><span itemprop="addressLocality">Sandgate, Australia</span><br>					
		<b>Postcode: </b><span itemprop="postalCode"> 4017</span><br>
			
	</div>
	
</div> -->
