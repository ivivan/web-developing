<?php include 'includes/header.inc'; ?>

<!-- A simple page with no dynamic functionality other than the header.inc .  Each section is contained in a homeSection div with appropriate formatting-->

<br>

<!-- image to welcome user -->

<div id="homeSplash">

	<img src="imgs%2FstoreyBridge.jpg" alt="Image of sunset of Brisbane's Storey Bridge">

</div>

<!-- A brief description of the site -->

<div class="homeSection">

	<h1>Welcome to Whatspot - Brisbane's best Council Operated WiFi Spot Finder</h1>

	<p> Hello and thanks for stopping by.  This site gives you the ability to search for and locate Brisbane City Council owned and
		operated WiFi hotspots.  They are free to use so why not check if one is near you today?  You can <a href="search.php">search</a>
		based on the following criteria: </p>

		<ul>
			
			<li>Hotpost Location Name</li>
			<li>Suburb Name</li>
			<li>Rating</li>
			<li>Distance - calculated from your current location!</li>

		</ul>

		<p>Search results are placed on a map.  You don't need to be a member to use this funcitonality, so give it a go!</p>

</div>

<!-- An explantation that Mozilla is the preferred browser -->

<div class="homeSection">
	
		<a href="https://www.mozilla.org/en-GB/firefox/new/"><img src="imgs/firefox.jpg" alt="Best used with Firefox (link)" width="114" height="128"></a>

		<h1>This site is designed for Mozilla Firefox</h1>

		<p>We take our user's experience very seriously and all attempts have been made to ensure compatability across all the major browsers.
		However, the site has been optimised for Mozilla Firefox v46.0.1 (you can get it <a href="https://www.mozilla.org/en-GB/firefox/new/">here</a>).
		This will ensure the best compatability - especially for letting us know your location for the best user experience</p><br><br>

</div>

<!-- A brief section referencing and linking to the registration page -->

<div class="homeSection">
	
	<h1>Why not become a member?</h1>

	<p>Become a member today so you can review a WiFi site and help other users make an informed choice.  It's very easy to do, just go to the 
	<a href="register.php">registration page</a></p>.

</div>


<?php include 'includes/footer.inc'; ?>

