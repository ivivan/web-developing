function showLocation(location){

	document.getElementById('hiddenLat').value = location.coords.latitude;
	document.getElementById('hiddenLng').value = location.coords.longitude;
	document.getElementById('locationStatus').style.display = "block";

}

// prefill hidden fields with coords for centre of Brisbane incase geolocation fails

function prefillHiddenFields(){

    document.getElementById('hiddenLat').value = -27.4710;
    document.getElementById('hiddenLng').value = 153.0234; 

}

function displayGeoWarning(){

    document.getElementById('locationStatus').style.color = "red";
    document.getElementById('locationStatus').innerHTML = "Geolocation Failed.  Using Coordinates from Brisbane GPO.";
    document.getElementById('locationStatus').style.display = "block";

}

function initSearch(){

	document.getElementById('name').disabled = false;
    document.getElementById('suburb').disabled = true;
    document.getElementById('rating').disabled = true;
    document.getElementById('distance').disabled = true;
    document.getElementById('locationStatus').style.display = "none";

}

function toggleSearchName(cb){

    if (cb.checked){
        
        document.getElementById('nameSearch').checked = true;
        document.getElementById('suburbSearch').checked = false;
        document.getElementById('ratingSearch').checked = false;
        document.getElementById('distanceSearch').checked = false;

        document.getElementById('name').disabled = false;
        document.getElementById('suburb').disabled = true;
        document.getElementById('rating').disabled = true;
        document.getElementById('distance').disabled = true;

    }

}

function toggleSearchDistance(cb){

    if (cb.checked){
        
        document.getElementById('nameSearch').checked = false;
        document.getElementById('suburbSearch').checked = false;
        document.getElementById('ratingSearch').checked = false;
        document.getElementById('distanceSearch').checked = true;

        document.getElementById('name').disabled = true;
        document.getElementById('suburb').disabled = true;
        document.getElementById('rating').disabled = true;
        document.getElementById('distance').disabled = false;

    }

}

function toggleSearchSuburb(cb){

    if (cb.checked){
        
        document.getElementById('nameSearch').checked = false;
        document.getElementById('suburbSearch').checked = true;
        document.getElementById('ratingSearch').checked = false;
        document.getElementById('distanceSearch').checked = false;

        document.getElementById('name').disabled = true;
        document.getElementById('suburb').disabled = false;
        document.getElementById('rating').disabled = true;
        document.getElementById('distance').disabled = true;
    }

}

function toggleSearchRating(cb){

    if (cb.checked){
        
        document.getElementById('nameSearch').checked = false;
        document.getElementById('suburbSearch').checked = false;
        document.getElementById('ratingSearch').checked = true;
        document.getElementById('distanceSearch').checked = false;

        document.getElementById('name').disabled = true;
        document.getElementById('suburb').disabled = true;
        document.getElementById('rating').disabled = false;
        document.getElementById('distance').disabled = true;
    }

}
