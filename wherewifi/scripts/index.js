// Function that gets triggered when user clicks on a button
function getLocation() {
	// Test to see if the browser supports geolocation
    if (navigator.geolocation) {
    	// Trigger geolocation api and pass in our functions
        navigator.geolocation.getCurrentPosition(showPosition, showError);
        enableSubmit();
    } else {
        document.getElementById("mapholder").innerHTML = "Geolocation is not supported by this browser.";
    }
}

// Function triggered if browser could determine location
function showPosition(position) {
	// Grab the browsers latitude and longitude
    var latlon = position.coords.latitude + "," + position.coords.longitude;
    document.getElementById("longitude").value = position.coords.longitude;
    document.getElementById("latitude").value = position.coords.latitude;
    // Display this co-ordinates as an image with google maps
    var img_url = "http://maps.googleapis.com/maps/api/staticmap?center="
    +latlon+"&zoom=14&size=400x300&sensor=false";
    document.getElementById("mapholder").innerHTML = "<img src='"+img_url+"'>";
}

// Function triggered if browser does support geolocation but cannot determine location
function showError(error) {
    disableSubmit();
	// Check error code and display correct error message
    switch(error.code) {
        case error.PERMISSION_DENIED:
            document.getElementById("mapholder").innerHTML = "Request for Geolocation has been denied."
            break;
        case error.POSITION_UNAVAILABLE:
            document.getElementById("mapholder").innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            document.getElementById("mapholder").innerHTML = "The request for Geolocation timed out."
            break;
        case error.UNKNOWN_ERROR:
            document.getElementById("mapholder").innerHTML = "An unknown error has occurred."
            break;
    }
}

//Function to change the display image of the selected rating
function changeSignal(rating) {
    document.getElementById("rating_image").src = "images/signal" + rating.toString() + ".png";
    document.getElementById("rating").value = rating;
    enableSubmit();
}

// Switch which search type is visible by hiding and showing divs
function changeSearch(visible) {
    document.getElementById("name_search").style.display = "none";
    document.getElementById("suburb_search").style.display = "none";
    document.getElementById("rating_search").style.display = "none";
    document.getElementById("location_search").style.display = "none";
    document.getElementById("search_type").value = visible;
    document.getElementById(visible).style.display = "block";
    disableSubmit();
}

// Allow the ability to searh for a hotspot
function enableSubmit() {
    document.getElementById("submit").disabled = false;
}

// Disable the ability to search for a hotspot
function disableSubmit() {
    document.getElementById("submit").disabled = true;
}