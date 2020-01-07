
// Callback function from google maps
function initMap() {
	// define vars
	let $ 		= jQuery,
	$wrapper 	= $('#map-wrapper'),
	$map 		= $wrapper.find('#thoughtless-map'),
	map 		= $map.get(0),
	authRequest = new XMLHttpRequest(),
	get_token   = 'http://localhost/wp/thoughtless/public/wp-json/jwt-auth/v1/token',
	endpoint    = 'http://localhost/wp/thoughtless/public/wp-json/wp/v2/us_stores',
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

			// getting information through wp rest api
			$.ajax({
				url: endpoint,
				success: response => {

					// grabs the acf fields for every store and sets them in a object
					response.forEach(store => {
						let cords = {
							lat: parseFloat(store.acf.store_latitude),
							lng: parseFloat(store.acf.store_longitude)
						};

						// for each store place a marker based on the acf fields
						new google.maps.Marker({
							position: cords,
							map: thoughtlessMap,
							animation: google.maps.Animation.DROP
						});
					});
				},
				error: error => {
					console.log(error);
				},

				// here I add the jwt as authentication
				beforeSend: xhr => {
					xhr.setRequestHeader("Authorization", 'Bearer ' + token);
				},
			});

		}

	}

	// adding eventlistener, to wath for clicks on a certain outlet
	document.body.addEventListener('click', e => {
		if(e.target.parentElement.classList.contains('card')) {
			zoomToOutlet(map, e);
		}
	});

}

function zoomToOutlet(map, e) {

	// getting cords based on what outlet beeing clicked
	var cords = {
		lat: parseFloat(e.target.dataset.lat),
		lng: parseFloat(e.target.dataset.lng)
	}
	
	// create a new map, with closer zoom, and center around the cords
	let thoughtlessMap = new google.maps.Map(map, {
		zoom: 16,
		center: cords,
		disableDefaultUI: true,
		gestureHandling: 'none',
		zoomControl: false
	})

	// place a marker to show where outlet is located
	let marker = new google.maps.Marker({
		position: cords,
		map: thoughtlessMap,
		animation: google.maps.Animation.DROP
	});

	
	// prevents default behaviour of the event
	e.preventDefault();
}