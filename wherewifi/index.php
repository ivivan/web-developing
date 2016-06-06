<!DOCTYPE html>
<html>
  <head>
  <title>WhereFi</title>
	<?php include "include/header.inc" ?>
  <script src="scripts/index.js"></script>
  </head>
  <body>
    <div id="wrapper">
      <?php include "include/menu.inc" ?>
      <div id="backdrop">
      	<div id="content">
          <p>Find your closest wifi hotspot.</p>
          <p>Search by:</p>
          <label class="button" onclick="changeSearch('name_search')">NAME</label>
          <label class="button" onclick="changeSearch('suburb_search')">SUBURB</label>
          <label class="button" onclick="changeSearch('rating_search')">RATING</label>
          <label class="button" onclick="changeSearch('location_search')">LOCATION</label>
          <br/><br/>
          <form action="results.php" method="POST">
            <input type="hidden" id="search_type" name="search_type" value="name_search">
            <div id="name_search">
            <br/>
            <input id="txtbox" name="name" type="search" placeholder="Enter wifi spot name" onchange="enableSubmit();" onclick="enableSubmit();"/>
            </div>
            <br/>
            <div id="suburb_search">
            <select name="suburb" onchange="enableSubmit();">
              <option>Select a Suburb</option>
              <?php
                try {
                  //Populate the suburb seach from the database
                  $result = $pdo->query('SELECT DISTINCT suburb FROM locations ORDER BY suburb asc');
                } catch (PDOException $e) {
                  echo $e->getMessage();
                }
                foreach ($result as $suburb) {
                  echo '<option value="' . $suburb['suburb'] . '">' . $suburb['suburb'] . '</option>';
                }
              ?>
            </select>
            <br/><br/>
            </div>
            <div id="rating_search">
              <input type="hidden" id="rating" name="rating" value="1">
      			  <img id="rating_image" src="images/signal1.png" alt="rating image" height="192" width="256" />
      			  <p>
              <label class="button" onclick="changeSignal(1)">1+</label>
              <label class="button" onclick="changeSignal(2)">2+</label>
              <label class="button" onclick="changeSignal(3)">3+</label>
      				<label class="button" onclick="changeSignal(4)">4+</label>
      				<label class="button" onclick="changeSignal(5)">5</label>
      			  </p>
            </div>
            <div id="location_search">
  	          <input type="hidden" name="longitude" id="longitude" value="0">
  	          <input type="hidden" name="latitude" id="latitude" value="0">
              <label class="button" onclick="getLocation()">Get Current Location</label>
              <p>Find wifi spots in <input type="number" name="distance" id="distance" value="5"> km radius</p>
  	  			  <br/>
  	  			  <div id="mapholder"></div>
            </div>
            <br/>
            <input class="button" id="submit" type="submit" disabled/>
          </form>
        <br/><br/>
        </div>
      </div>
    </div>
  <?php include "include/footer.inc" ?>
  </body>
</html>