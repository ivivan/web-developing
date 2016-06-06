<!DOCTYPE html>
  <head>
    <title>Hotspot</title>
    <?php
      include "include/header.inc";
      //Make sure no one is tampering with the data
      $id = 0;
      //Allows post or get for location
      if (isset($_POST['location'])) {
        $id = (int)$_POST['location'];
      } else {
      	if(isset($_GET['id'])) {
        	$id = (int)$_GET['id'];
        }
      }
      if (!isset($id) || $id == 0) {
        header("Location: index.php");
        die();
      }
      try {
        //Process user inputs
        $result = $pdo->prepare('SELECT * FROM locations where id = :id');
        $result->bindValue(':id',$id);
        $result->execute();
        $result = $result->fetch();
        $name = $result['name'];
        $address = $result['address'];
        $suburb = $result['suburb'];
        $latitude = $result['latitude'];
        $longitude = $result['longitude'];
      } catch (PDOException $e) {
        echo $e->getMessage();
      }
    ?>
    <!-- Mircodata information for location -->
    <script src="scripts/map.js"></script>
    <script type="application/ld+json">
      [{
        "@context": "http://schema.org",
        "@type": "Place",
        "name": "<?php echo $name ?>",
        "geo": {
        "@type":"Geocoordinates",
          "latitude": <?php echo $latitude ?>,
          "longitude": <?php echo $longitude ?>
          },
        "address": {
          "@type": "PostalAddress",
          "streetAddress": "<?php echo $address ?>"
        }
      }]
    </script>
  </head>
  <body>
      <?php include "include/menu.inc" ?>
      <div id="backdrop">
      	<div id="content">
			<h1><?php echo $name; ?></h1>
      <hr>
      <div id="map"></div>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAxMOqlfLNUZXLeU-uOTFB4hgyUBJ6-Uk8"></script>
      <script type="text/javascript">
        //Form data for marker information
        var contentString = <?php echo '\'<div id="content"><div id="siteNotice"></div>' .
        '<div id="bodyContent">' .
        '<p>' . $name . "</p><p>" . $address . "</p><p>" . $suburb . '</p></div></div>\'' ?>;
        create_map([[<?php echo $latitude ?>,<?php echo $longitude ?>, contentString],[]],15);
      </script>
      <hr>
		  <table class="result_table">
        <tr class ="table_headings">
          <td>Address</td>
          <td>Suburb</td>
        </tr>
        <tr>
          <td><?php echo $address; ?></td>
          <td><?php echo $suburb; ?></td>
        </tr>
      </table>
      <?php
        if(isset($_SESSION['user'])){
          if(isset($_POST['review'])) {
            //Process user inputs for reviews
            $review = strip_tags($_POST['review']);
            $rate = $_POST['rate'];
            $location = $_POST['location'];
            $user = $_SESSION['id'];

            //Add the review to the database
            if(isset($review) && isset($rate) && isset($location) && isset($user)) {
              try {
                $query = 'INSERT INTO reviews (user_id, location_id, rating, message, date) ' .
                          'VALUES (:user, :location, :rate, :message, NOW())';
                $result = $pdo->prepare($query);
                $result->bindValue(':user', $user);
                $result->bindValue(':location', $location);
                $result->bindValue(':rate', $rate);
                $result->bindValue(':message', $review);
                $result->execute();
                echo "<hr><p>Review Submitted Successfully</p>";
              } catch (PDOException $e) {
                echo $e->getMessage();
              }
            }
          }
          include "include/review.inc";
        }
      ?>
      <hr>
      <h2>Reviews</h2>
      <table class="result_table">
        <tr class ="table_headings">
       		<td>Date</td>
          <td>Username</td>
          <td>Comments</td>
          <td>Rating</td>
			   </tr>
        <?php
          try {
            //Grab all relevant reviews
            $result = $pdo->prepare('SELECT m.username, r.message, r.rating, r.date FROM reviews r, members m where r.location_id = :id AND m.id = r.user_id');
            $result->bindValue(':id', $id);
            $result->execute();
          } catch (PDOException $e) {
            echo $e->getMessage();
          }
          if ($result->rowCount()) {
            foreach ($result as $review) {
              //Print all of the retrievded reviews
              echo '<tr>' .
                '<td>' . $review['date'] . '</td>' .
                '<td>' . $review['username'] . '</td>' .
                '<td>' . $review['message'] . '</td>' .
                '<td><img class="smallRating" src="images/signal' . $review['rating'] . '.png" alt="Rating"></td>' .
                '</tr>';

                //Microdata information for review
                echo "\r\n" . '<script type="application/ld+json">' .
                  '[{
                    "@context": "http://schema.org",
                    "@type": "Review",
                    "itemReviewed": "' . $name . '",
                    "reviewBody": "' . $review['message'] . '",
                    "dateCreated": "' . $review['date'] . '",
                    "reviewRating": {
                      "name": "Review of ' . $name . '",
                      "ratingValue": ' . $review['rating'] .
                      '},
                    "author": "' . $review['username'] . '"
                  }]
                }]
                </script>' . "\r\n";
            }
          } else {
            echo "<tr><th colspan='3'>No reviews for this location.<th></tr>";
          }
        ?>
		  </table>
      </div>
    </div>
    <?php include "include/footer.inc" ?>
  </body>
</html>