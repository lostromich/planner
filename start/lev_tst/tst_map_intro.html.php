<?php
// ===================================================== 
// Simple map example with one markers and pop up
// =====================================================
?>

<html>
<head>
<!-- Map css:  -->
<style>#div_map { height: 300px; width:500px; }</style>

<!-- Leaflet links to css and javascript - just copy and paste this code  -->
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.css" />
<!--[if lte IE 8]>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.ie.css" />
<![endif]-->

<script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>

<title>Test leaflets maps - Intro</title>
</head>

<body>
<h3>Test leaflets maps - Introduction</h3>
	
	<!-- Here is will be the map -->
	<div id="div_map"></div>
	
	<script>
	// ===================================
	// Create map
	// ===================================

// 77 Roxborugh Lane latttitude and longituede:
var latt_1 = 	43.8120141;
var long_1 =  -79.445895;

//The Promenade: 
var latt_2 =  43.8067;
var long_2 =  -79.4525;

// Set view to 77 Roxborugh Lane
var map = L.map('div_map').setView([ latt_1, long_1], 13);
// =====================================================================
// my Key, we may use it later -  I registered this at CloudMade:
// =====================================================================
//c2eae2fec30845b69cf3bca210064758
// L.tileLayer('http://{s}.tile.cloudmade.com/c2eae2fec30845b69cf3bca210064758/997/256/{z}/{x}/{y}.png', {
//    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
//    maxZoom: 18
// }).addTo(map);
// ===================================================================
// Open street tiles
// ==================================================================
	 L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 18
}).addTo(map);

//===================================
// Create markers
// ===================================
	var marker_1 = L.marker([latt_1, long_1]).addTo(map);
	var marker_2 = L.marker([latt_2, long_2]).addTo(map);
//===================================
// Add pop up - address, event name
// ===================================
	marker_1.bindPopup("<b>Big Programming event</b><br>77 Roxborugh Lane<br>Thornhill").openPopup();
	marker_2.bindPopup("<b>Promende Mall</b><br>We will do shopping here").openPopup();
		</script>
</body>
</html>
