<!DOCTYPE html>
<html>
  <head>
    <title>Results</title>
  	<?php include "include/header.inc" ?>
    <script src="scripts/map.js"></script>
  </head>
  <body>
    <div id="wrapper">
      <?php include "include/menu.inc" ?>
      <div id="backdrop">
      <h1>Results</h1>
        <div id="content">
          <div id="map"></div>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxMOqlfLNUZXLeU-uOTFB4hgyUBJ6-Uk8"></script>
          <table id="result_table">
            <tr class ="table_headings">
              <td>Name</td>
              <td>Address</td>
              <td>Suburb</td>
              <td>Rating</td>
              <td>Reviews</td>
            <?php

            	if (!isset($_POST['search_type'])) {
            		header("Location: index.php");
            		die();
            	}

              //Process the user inputs
              $search_name = strip_tags($_POST['search_type']);
              $name = strip_tags($_POST['name']);
              $suburb = strip_tags($_POST['suburb']);
              $rating = (int)$_POST['rating'];
              $latitude = (double)$_POST['latitude'];
              $longitude = (double)$_POST['longitude'];
              $distance = (int)$_POST['distance'];

              if ($search_name == "location_search") {
                echo '<td>Distance</td>';
              }
              try {
                //Structure the query
                $query = 'SELECT l.id, l.name, l.address, l.suburb, AVG(r.rating) as rating_avg, count(r.rating) as rating_count, l.latitude, l.longitude ' .
                          'FROM locations l ' .
                          'LEFT JOIN reviews r ' .
                          'ON  l.id = r.location_id ' .
                          'GROUP BY l.id ';

                if ($search_name == "name_search") {
                  $filter = 'HAVING l.name LIKE :name';
                }
                if ($search_name == "suburb_search") {
                  $filter = 'HAVING l.suburb LIKE :sub';
                }
                if ($search_name == "rating_search") {
                  $filter = 'HAVING rating_avg >= :rate';
                }
                if ($search_name == "location_search") {
                  $filter = '';
                }

                $result = $pdo->prepare($query . $filter);
                if ($search_name == "name_search") {
                  $result->bindValue(':name', '%'.$name.'%');
                }
                if ($search_name == "suburb_search") {
                  $result->bindValue(':sub', '%'.$suburb.'%');
                }
                if ($search_name == "rating_search") {
                  $result->bindValue(':rate', $rating);
                }
                $result->execute();
              } catch (PDOException $e) {
                echo $e->getMessage();
              }
              $result_count = 0;
              if ($result->rowCount()) {
                $hotspots = array();
                foreach ($result as $location) {
                  $d = 0;
                  $print_row = 0;

                  // Calculate distance to location
                  if ($search_name == 'location_search') {
                    $R = 6371;
                    $dLat = ($location['latitude']-$latitude) * (pi() / 180);
                    $dLon = ($location['longitude']-$longitude) * (pi() / 180);
                    $a = sin($dLat/2) * sin($dLat/2) +
                            sin($dLon/2) * sin($dLon/2) * cos($latitude * (pi() / 180)) * cos($location['latitude'] * (pi() / 180));
                    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
                    $d = round($R * $c, 1);
                    if ($d < $distance) {
                      $print_row = 1;
                    }
                  } else {
                    $print_row = 1;
                  }

                  if ($print_row) {
                    $description = '\'<div id="content"><div id="siteNotice"></div>' .
                      '<div id="bodyContent">' .
                      '<p><a href="item.php?id=' . $location['id'] . '">'. str_replace("'", "", $location['name']) . "</a></p><p>" . str_replace("'", "", $location['address']) . "</p><p>" . str_replace("'", "", $location['suburb']) . '</p></div></div>\'';

                    array_push($hotspots, array($location["latitude"],$location["longitude"], $description));

                    $result_count += 1;
                    echo '<tr>';
                    echo '<td>' . '<a href="item.php?id=' . $location['id'] . '">' . $location['name'] . '</a></td>';
                    echo '<td>' . $location['address'] . '</td>';
                    echo '<td>' . $location['suburb'] . '</td>';
                    echo '<td>' . round($location['rating_avg'], 1) . '</td>';
                    echo '<td>' . $location['rating_count'] . '</td>';
                    if ($search_name == 'location_search') {
                      echo '<td>' . $d . '</td>';
                    }
                    echo '</tr>';
                  }
                }

                //Adjust zoom if we're just displaying one result
                $zoomlevel = 0;
                if (count($hotspots) == 1) {
                  $zoomlevel = 15;
                }

                //Create results map and add all of the markers
                echo '<script type="text/javascript">';
                  echo 'create_map([';
                    foreach ($hotspots as $place) {
                      echo '['.$place[0].','.$place[1].','.$place[2].'],';
                    }
                    echo '[]';
                  echo'],' . $zoomlevel . ');';
                echo '</script>';
              }
              if ($result_count == 0) {
                // Hide map if empty
                echo '<script>hide_map();</script>';
                // Display message if results matched the users search
                if ($search_name == 'location_search') {
                  echo "<tr><th colspan='6'>No wifi spot within $distance km of given location.</th></tr>";
                } else {
                  echo "<tr><th colspan='5'>No results match specified search.</th></tr>";
                }
              }
            ?>
          </table>
        </div>
      </div>
      <?php include "include/footer.inc" ?>
    </div>
  </body>
</html>