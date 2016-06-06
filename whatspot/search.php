 <?php include 'includes/header.inc'; ?>

<br>

<!-- Search Form - users can search by one of the four terms at a time - checkboxes are used to let user choose the relevant field and disable the other three -->

<div>

	<form class="searchForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">

		<h1>Search Form</h1>

		<!-- Lat and Long are stored in two hidden form fields ready to post back, they are prefilled with co-ordinates representing the Brisbane CBD incase the GeoLocation Javascript Fails  -->

		<input id="hiddenLat" name="hiddenLat" hidden>
		<input id="hiddenLng" name="hiddenLng" hidden><br>

		<!-- each search input has its own dive for easier CSS management -->

		<div>

			<!-- checkboxes will use javascript to enable/disable the search feature they want to use -->

			<input type="checkbox" id="nameSearch" name="nameSearch" value="on" onclick="toggleSearchName(this);" checked /><label for="nameSearch" class="searchLabel">Search by Name</label>
			
			<input type="text" id="name" name="name" autofocus /><br>

		</div>

		<div>

			<input type="checkbox" id="suburbSearch" name="suburbSearch" value="on" onclick="toggleSearchSuburb(this);"><label for="suburbSearch" class="searchLabel"> Search by Suburb</label>
		
			<select id="suburb" name="suburb">

				<option value="0">----</option>

				<!-- PDO query to automatically populate drop down select with every unique suburb instance from the DB -->

				<?php

					$stmt = $pdo->prepare('SELECT DISTINCT Suburb FROM Items ORDER BY Suburb ASC');
					$stmt->execute();

					$row = $stmt->fetchAll();

					foreach ($row as $option){
						echo '<option value="' . $option['Suburb'] . '">' . $option['Suburb'] . '</option>';
					}

				?> </select><br>

		</div>

		<div>

			<input type="checkbox" id="ratingSearch" name="ratingSearch" value="on" onclick="toggleSearchRating(this);"><label for="ratingSearch" class="searchLabel"> Search by Rating</label>

			<!-- User can search by average rating ranges -->
			
			<select id="rating" name="rating">
				<option value="0">----</option>
				<option value="2">1 - 2</option>
				<option value="3">2 - 3</option>
				<option value="4">3 - 4</option>
				<option value="5">4 - 5</option>
			</select><br>

		</div>

		<div>

			<!-- User can search by predefined distance ranges -->

			<input type="checkbox" id="distanceSearch" name="distanceSearch" value="on" onclick="toggleSearchDistance(this);"><label for="distanceSearch" class="searchLabel"> Search by Distance</label>

			<select id="distance" name="distance">
				<option value="0">----</option>
				<option value="2">2 km</option>
				<option value="5">5 km</option>
				<option value="10">10 km</option>
				<option value="20">20 km</option>
			</select><span id="locationStatus">Location Detected!</span><br>

			<!-- The above locationStatus is initally hidden and shown upon successfull location detection -->

		</div>

		<button type="submit" name="submit" class="button" id="searchButton" value="Search">Search</button>

	</form>

</div>

<!-- Some Javascript to set up GeoLocation co-ords and make the Name search option selected by default -->

<script>	

	// this function will prefill the hidden fields with coordinates of the Brisbane GPO incase GeoLocation fails

	prefillHiddenFields();

	// this tests to see whether geolocation is available and if so out the current position into the hidden fields

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showLocation);
    }

    // sets up name as default search paramter, disables others until they are selected by user

    initSearch();

</script>

<?php

	// prepare() function from functions.inc is used to prevent XSS - htmlspecialchars()

	$searchError = '';

	// check to see if there was actually a POST before processing form data - otherwise just initial page load

	if ($_SERVER["REQUEST_METHOD"] == "POST"){

		// name search - also JOINs in average rating for site (if one exists yet) - will match any substring into the name string in DB using %LIKE%

		if (isset($_POST['name'])) {

			$name = '%'. prepare($_POST['name']) .'%';
			$sql = "SELECT * FROM (SELECT * FROM items LEFT JOIN 
					(SELECT r.siteID, AVG(r.reviewRating) average FROM reviews r GROUP BY r.siteID) 
					AS results ON siteID = itemID) AS a WHERE name LIKE ?;";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(1, $name);
		
		}

		// suburb search - similar to name search but takes value from select options

		if (isset($_POST['suburb'])){

			$suburb = prepare($_POST['suburb']);
			$sql = "SELECT * FROM (SELECT * FROM items LEFT JOIN 
					(SELECT r.siteID, AVG(r.reviewRating) average FROM reviews r GROUP BY r.siteID)
					AS results ON siteID = itemID) AS a WHERE Suburb = ?;";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(1, $suburb);
		
		}

		// rating search function - takes a value, calculates a range and queries the DB

		if (isset($_POST['rating'])){

			$rating = prepare($_POST['rating']);

			$loLim = $rating - 1;
			$hiLim = $rating;

			$sql = "SELECT * FROM (SELECT * FROM items LEFT JOIN 
					(SELECT r.siteID, AVG(r.reviewRating) average 
					FROM reviews r GROUP BY r.siteID) 
					AS results ON siteID = itemID) AS a WHERE average BETWEEN ? AND ?;";

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(1, $loLim);
			$stmt->bindParam(2, $hiLim);

		}

		// distance search - takes the parameter maxDistance from the form - uses Haversine function integrated into SQL query		

		if (isset($_POST['distance'])){

			$maxDist = prepare($_POST['distance']);
			$lat = prepare($_POST['hiddenLat']);
			$lng = prepare($_POST['hiddenLng']);

			$sql = "SELECT * FROM (SELECT *, (6373 * 
					acos(cos(radians($lat)) 
					* cos(radians(Latitude)) 
					* cos(radians(Longitude) 
					- radians($lng)) 
					+ sin(radians($lat)) 
					* sin(radians(Latitude)))) 
					AS distance 
					FROM Items
					HAVING distance < $maxDist
					ORDER BY distance ASC) AS a LEFT JOIN ( 
					SELECT r.siteID, AVG(r.reviewRating) average 
					FROM reviews r GROUP BY r.siteID) 
					AS results ON siteID = itemID;";

			$stmt = $pdo->prepare($sql);

		}

		$stmt->execute();
		$row = $stmt->fetchAll();

		// check to see if there are actually any results returned - else inform user that there were no matching queries

		if ($row) {

			// generate <div> and javascript scripts to display Google maps map

			echo '<div id="map" style="width: 1024px;height: 500px"></div>';

			echo '<script> 

				function initMap() {
	        		var brisGPO = {lat: -27.4679, lng: 153.0279};

	        		var map = new google.maps.Map(document.getElementById(\'map\'), {
	          			zoom: 10,
	          			center: brisGPO
	        		});';

	        // loop through all search results and generate marker scripts for each as per maps API

	        foreach($row as $marker){

	        	$name = $marker['Name'];
	        	$position = '{lat: ' . $marker['Latitude'] . ', lng: ' . $marker['Longitude'] . '}';
	        	$suburb = $marker['Suburb'];
	        	$ID = $marker['itemID'];

	        	$markerContent =  'var markerContent' . $ID . ' = \'<div>' . 
		        	'<b>' . str_replace("'", "\'", $name) . '</b><br><br>' .
		        	'<a href="item.php?itemID=' . $ID . '">Site Description</a><br>' . 
		        	'<a href="review.php?itemID=' . $ID . '">Review this site!<a></div>\';';

		        echo $markerContent;	

		        echo 'var infoWindow' . $ID . ' = new google.maps.InfoWindow({content: markerContent' . $ID. '});';

		        echo 'var marker' . $ID .' = new google.maps.Marker({
			          position: ' . $position . ',
			          map: map,
			          animation: google.maps.Animation.DROP,
			          title: \'' . str_replace("'", "\'", $name) . ', ' . $suburb . '\'	
			        });'.
			        ' ';	

		        echo 'marker' . $ID . '.addListener(\'click\', function () { infoWindow' . $ID . '.open(map, marker' . $ID . ');});';
		        
	        }

	        echo '}</script>';

			echo '<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAucGenGfs-Jnr2JYC_hdkmBVfVmagvf_c&callback=initMap"></script>';

			// begin search results table with table header

			echo '<table id="searchTable"> <tr> <th>ID</th> <th>Name</th> <th>Address</th> <th>Suburb</th> <th>Distance</th> <th>Av Rat</th> </tr>';

			// loop through all search results again now to create a table row/entry for each one

			foreach($row as $item){

				$lat1 = $item['Latitude'];
				$lng1 = $item['Longitude'];

				$lat2 = $_POST['hiddenLat'];
				$lng2 = $_POST['hiddenLng'];

				// haversine function used to calculate distance at runtime and is located in functions.inc

				$distance = haversine($lat1, $lng1, $lat2, $lng2);

				// if there is no vale for item average rating yet (i.e. no reviews have been made) display N/A which is bit more user friendly

				if (empty($item['average'])){
					$item['average'] = 'N/A';
				} 

					echo '<tr>';
					echo '<td>' . $item['itemID'] . '</td>';
					echo '<td><a href=item.php?itemID=' . $item['itemID'] . '>' . $item['Name'] . '</a></td>';
					echo '<td>' . $item['Address'] . '</td>';
					echo '<td>' . $item['Suburb'] . '</td>';
					echo '<td>' . number_format($distance, 1) . ' km</td>';
					echo '<td>' . $item['average'] . '</td>';	
					echo '</tr>';

			}

			echo '</table>';

		} else {

			// message to inform users there were no matches to their query if this is the case

			$searchError = '<br>Sorry, there are no entries matching this criteria.  Please try again.';

		}	

	}

?>

<div>
	
	<span class="returnError"><?php echo $searchError;?></span>

</div>

<?php include 'includes/footer.inc'; ?>

