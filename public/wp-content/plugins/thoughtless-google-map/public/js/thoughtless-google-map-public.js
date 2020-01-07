
// Callback function from google maps
function initMap() {
	// define vars
	let $ 		= jQuery,
	$wrapper 	= $('#map-wrapper'),
	$map 		= $wrapper.find('#thoughtless-map'),
	map 		= $map.get(0),
	authRequest = new XMLHttpRequest(),
	get_token   = 'http://localhost/wp/thoughtless/public/wp-json/jwt-auth/v1/token',
	credentials = {
		'username': thoughtless_google_map_credentials.username,
		'password': thoughtless_google_map_credentials.password
	},
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

	// setting up authentication with jwt
	authRequest.open('POST', get_token);
	authRequest.setRequestHeader('Content-type', 'application/json');
	authRequest.setRequestHeader('Accept', 'application/json');
	authRequest.send(JSON.stringify(credentials));
	authRequest.onreadystatechange = () => {
		if(authRequest.readyState == 4) {			
			let authJson = JSON.parse(authRequest.responseText);
			
			// this is the jwt we need to pass, when getting info through wp rest api
			let token = authJson.token;

		}

	}

}