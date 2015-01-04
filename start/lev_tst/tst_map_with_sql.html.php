<?php
// ===================================================== 
// Simple map example with sql and call to php function
// =====================================================
include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password
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

<title>Test leaflets maps - Intro with PHP and SQL</title>
</head>

<body>
<?php
  // Get array of events with their addresses
  list($errArr, $events) = fetch_top_events();  
  if (count($events) > 0) {
      $row_0 = $events[0];
   }
   else {
      $row_0 = NULL;
   }
?>
<h3>Test leaflets maps - Introduction  with PHP and SQL</h3>
	
	<!-- Here is will be the map -->
	<div id="div_map"></div>
	
	<script>
	// ===================================
	// Create map
	// ===================================

// Set up position of the map
// (1) if there are some events then setup position to the first element
// (2) if there is no events we will show current default location  - Toronto
  var lat_pos  =  <?php echo json_encode(DFT_LATITUDE) ; ?> ;
  var long_pos =  <?php echo json_encode(DFT_LONGITUDE); ?> ;
   
<?php if ( $row_0 != NULL && $row_0 ['latitude'] != NULL && $row_0 ['longitude'] != NULL ) { ; ?>
   lat_pos = <?php echo json_encode($row_0 ['latitude']) ; ?> ;
   long_pos = <?php echo json_encode($row_0 ['longitude'] ); ?> ;
<?php }; ?>

// Set view to 77 Roxborugh Lane
var map = L.map('div_map').setView([ lat_pos, long_pos], 13);
//
// We will use open street maps
	 L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	 attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 18
}).addTo(map);

//===================================
// Create markers
// ===================================
	<?php foreach ($events as $event) { ;?>
	    var lat        = <?php echo json_encode($event['latitude']) ; ?> ;
	    var long       = <?php echo json_encode($event['longitude']) ; ?> ;
	    //
	    var eventName  = <?php echo json_encode($event['eventName']) ; ?> ;
	    var genre      = <?php echo json_encode($event['genre']) ; ?> ;
	    var sdate_time = <?php echo json_encode($event['sdate_time']) ; ?> ;
	    var edate_time = <?php echo json_encode($event['edate_time']) ; ?> ;
	    // Address information
	     var street_no   = <?php echo json_encode($event['street_no']) ; ?> ;
	     var street_name = <?php echo json_encode($event['street_name']) ; ?> ;
	     var city        = <?php echo json_encode($event['city']) ; ?> ;
	     var addr_tel_no = <?php echo json_encode($event['addr_tel_no']) ; ?> ;
	    // If it is not null then add to map
	    if (lat && long) {  
	        var marker = L.marker([lat, long]).addTo(map);
	        if (genre.length > 0) {
		        var marker_genre = "(" + genre + ")";
	        }
	        else {
		        var marker_genre = " ";
	        }
	        // event name
	        marker_popup = "<b>" + eventName + " " + marker_genre + " </b> <br>"; 
	        // event date and time
	        marker_popup += "From: " + sdate_time + "  To: " + edate_time + "<br>";
	        // event address
	        marker_popup += "Address: " + street_no + " " + street_name + " City: " + city + "<br>"; 
	        // event phone number
	        marker_popup += "Phone: " +  addr_tel_no;
	        marker.bindPopup(marker_popup).openPopup();
	    }    
	
	<?php }; ?>

</script>
</body>
</html>
