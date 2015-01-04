<?php
/*
*  ====================================================================================================================
* History of change
* =====================================================================================================================
* Version | Name     |   Date     | Description
* ---------------------------------------------------------------------------------------------------------------------
* 1.00000 | Lev O    | 2013-11-11 | - initial version 
*         |          |            |
*         |          |            |         
*         |          |            |
*         |          |            |         
* =====================================================================================================================
*/

// So you need to first install Leaflet and Geocoder and then use this function to generate the map:
/** ===============================================================
 * Generate a simple map with a location pointer.
 *
 * @param string $location
 *   Location to use (for example the address).
 * @param string $country
 *   Name of the country to use.
 * 
 * @return string
 *   The rendered map.
 * ==================================================================
 */
function mysimplemap_map_create($location, $country) {
  $map = '';
  // Join the address parts to something geocoder / google maps understands.
  $address = sprintf('%s, %s', $location, $country);
 
  // Try to create a geographic point out of the given location values.
  if ($geo_point = geocoder('google', $address)) {
    // Create a JSON equivalent to the point.
    $geo_json = $geo_point->out('json');
    // Get map implementation provided by http://drupal.org/project/leaflet_googlemaps.
    $map = leaflet_map_get_info('google-maps-roadmap');
    // Set initial zoom level.
    $map['settings']['zoom'] = 16;
    
    // Decode the JSON string.
    $geo_data = json_decode($geo_json);
    // Create settings for the map.
    $map_features = array(
      array(
        'type' => 'point',
        'lon' => $geo_data->coordinates[0],
        'lat' => $geo_data->coordinates[1],
      ),
    );
    // Render the map with a fixed height of 250 pixels.
    $map = leaflet_render_map($map, $features, '250px');
  }
 
  return $map;
}
?>