<?php
// ===============================================================================
// Simple map example with sql and call to php function and javascript functions
// ===============================================================================
include_once '../includes/constants.inc.php';
include_once '../includes/sql_functions.inc.php';
include_once 'tst_connect.inc.php';       // added password
?>

<html>
<head>
<!-- ===================================================================================== -->
<!-- Map css, we will add this later to css file :  -->
<!-- ===================================================================================== -->
<style>#div_map { height: 300px; width:500px; }</style>

<!-- ===================================================================================== -->
<!-- Leaflet links to css and javascript - just copy and paste this code  -->
<!-- ===================================================================================== -->
<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.css" />
<!--[if lte IE 8]>
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.ie.css" />
<![endif]-->

<script src="http://cdn.leafletjs.com/leaflet-0.6.4/leaflet.js"></script>

<!-- ===================================================================================== -->
<!-- local javascript functions -->
<!-- ===================================================================================== -->
<script src="../includes/map_functions.js">
</script>

<title>Test leaflets maps - Intro with PHP and SQL</title>
</head>

<body>
<?php
  // ================================================ 
  // Get array of events with their addresses
  // in real life it should be done using Ajax/jQuery
  // ================================================
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
	
// Show the map	at: id="div_map" 
init_map(lat_pos, long_pos);

//===================================
// Create markers
// ==================================
	 var row = new Array();
	<?php foreach ($events as $event) { ;?>
	    row            = <?php echo json_encode($event) ; ?> ;
	    
	    var lat        = row ['latitude'];
	    var long       = row ['longitude'];
	    // If it is not null then add to map
	    if (lat && long) {  
	        // get text of the marker popup
	        marker_popup = get_marker_popup_text(row);
	        // add marker and pop up to the map
	        var marker = L.marker([lat, long]).addTo(map);
	        marker.bindPopup(marker_popup).openPopup();
	    }    
	<?php }; ?>
</script>
</body>
</html>
