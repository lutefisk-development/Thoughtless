
// Callback function from google maps
function initMap() {
	// define vars
	let $ 		= jQuery,
	$wrapper 	= $('#map-wrapper'),
	$map 		= $wrapper.find('#thoughtless-map'),
	map 		= $map.get(0),
	latLng 		= {
		lat: 55.5915048, 
		lng: 13.00016
	};

	// initial map
	let thoughtlessMap = new google.maps.Map(map, {
		zoom: 13,
		center: latLng,
		disableDefaultUI: true,
		gestureHandling: 'none',
		zoomControl: false
	});

}