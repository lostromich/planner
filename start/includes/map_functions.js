/*
*  ====================================================================================================================
* History of change
* =====================================================================================================================
* Version | Name     |   Date     | Description
* ---------------------------------------------------------------------------------------------------------------------
* 1.00000 | Lev O    | 2013-11-16 | - initial version 
*         |          |            |
*         |          |            |         
*         |          |            |
*         |          |            |         
* =====================================================================================================================
*/
var map;          // global map
/* ==================================================================
 *  Signature  : (lat_pos, long_pos ) -> ()
* Description: Present a map with a center in provided location (lattitude, logitude) 
* Author: Lev O
* Date  : 2013-11-17
* ==================================================================
*/
function init_map(lat_pos, long_pos ) {
		 
	// Set view to one of the markers
	map = L.map('div_map').setView([ lat_pos, long_pos], 13);
	//
	// We will use open street maps
		 L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		 attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
	    maxZoom: 18
	}).addTo(map);
}

/* ==================================================================
 *  Signature  : (row) -> (text marker_popup)
* Description: Construct marker popup text 
* Author: Lev O
* Date  : 2013-11-17
* ==================================================================
*/
function get_marker_popup_text(row) {
	var marker_popup = ""; 
	//
	var eventName    = row['eventName'];
	var genre        = row['genre'];
	var sdate_time   = row['sdate_time'];
	var edate_time   = row['edate_time'];
	// Address information
	var street_no    = row['street_no'];
	var street_name  = row['street_name'];
	var city         = row['city'];
	var addr_tel_no  = row['addr_tel_no'];
	var marker_genre = "";
	if (genre.length > 0) {
		marker_genre = "(" + genre + ")";
	} else {
		marker_genre = " ";
	}
	// event name
	marker_popup = "<b>" + eventName + " " + marker_genre + " </b> <br>";
	// event date and time
	marker_popup += "From: " + sdate_time + "  To: " + edate_time + "<br>";
	// event address
	marker_popup += "Address: " + street_no + " " + street_name + " City: "
			+ city + "<br>";
	// event phone number
	marker_popup += "Phone: " + addr_tel_no;

	return marker_popup;
}
