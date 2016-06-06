// hotspots = [['lattitude',longitude','description'],[]];
function create_map(hotspots, zoom) {
  // Create the map
  var map = new google.maps.Map(document.getElementById('map'));
  // Bounds are used for mutliple markers to position the view evenly
  var bounds = new google.maps.LatLngBounds();
  // Used to display information for each marker
  var infowindow = new google.maps.InfoWindow();

  // Loops until last array, which should be empty
  for (i = 0; i < hotspots.length-1; i++) {
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(hotspots[i][0], hotspots[i][1]),
      map: map
    });

    // Listener that allows use to click on a marker and display its information
    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(hotspots[i][2]);
        infowindow.open(map, marker);
      }
    })(marker, i));

    // Add it's maker to the bounds
    bounds.extend(marker.position);
  }

  // Fit the view to the bounds
  map.fitBounds(bounds);

  // If a specifc zoom level is given then set it, ie. for a single item
  if (zoom > 0) {
    var listener = google.maps.event.addListener(map, "idle", function () {
        map.setZoom(zoom);
        google.maps.event.removeListener(listener);
    });
  }
}

// Function to hide the map, used when no results are returned
function hide_map() {
  document.getElementById("map").style.display = 'none';
}