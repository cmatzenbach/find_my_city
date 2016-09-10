jQuery(document).ready(function($){

	var latitude = -6.565067,
		longitude = 106.805026,
		map_zoom = 12;
	var is_internetExplorer11= navigator.userAgent.toLowerCase().indexOf('trident') > -1;
	var marker_url = ( is_internetExplorer11 ) ? 'http://gdurl.com/Uibp' : 'http://gdurl.com/kVn2';
	var	main_color = '#0000FF',
		saturation_value= 4,
		brightness_value= 5;
	var style= [ 
		{
			elementType: "labels",
			stylers: [
				{saturation: saturation_value}
			]
		},  
	    {
			featureType: "poi",
			elementType: "labels",
			stylers: [
				{visibility: "off"}
			]
		},
		{
	        featureType: 'road.highway',
	        elementType: 'labels',
	        stylers: [
	            {visibility: "off"}
	        ]
	    }, 
		{
			featureType: "road.local", 
			elementType: "labels.icon", 
			stylers: [
				{visibility: "off"} 
			] 
		},
		{
			featureType: "road.arterial", 
			elementType: "labels.icon", 
			stylers: [
				{visibility: "off"}
			] 
		},
		{
			featureType: "road",
			elementType: "geometry.stroke",
			stylers: [
				{visibility: "off"}
			]
		},
	/*	{ 
			featureType: "transit", 
			elementType: "geometry.fill", 
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		}, 
		{
			featureType: "poi",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "poi.government",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "poi.sport_complex",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "poi.attraction",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "poi.business",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "transit",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "transit.station",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "landscape",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
			
		},
		{
			featureType: "road",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		{
			featureType: "road.highway",
			elementType: "geometry.fill",
			stylers: [
				{ hue: main_color },
				{ visibility: "on" }, 
				{ lightness: brightness_value }, 
				{ saturation: saturation_value }
			]
		},
		**/
		{
			featureType: "water",
			elementType: "geometry",
			stylers: [
				//{ hue: "#551A8B" },
				{ visibility: "on" }
			]
		}

	];
	var map_options = {
      	center: new google.maps.LatLng(latitude, longitude),
      	zoom: map_zoom,
      	panControl: false,
      	zoomControl: true,
      	mapTypeControl: false,
      	streetViewControl: false,
      	mapTypeId: google.maps.MapTypeId.ROADMAP,
      	scrollwheel: false,
      	styles: style,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.SMALL,
			position: google.maps.ControlPosition.BOTTOM_LEFT
		}
    }
	var map = new google.maps.Map(document.getElementById('map'), map_options);	

	// Create the search box and link it to the UI element.
	var input = document.getElementById('pac-input');
	var searchBox = new google.maps.places.SearchBox(input);
	map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

	// create object prototype for markers, including markers array and relevant methods
	var Marker_proto = {

		markers: [],

		// constructor
		create: function () {
			var self = Object.create(this);
			//self.params = data;
			return self;
		},

		addMarker: function(place) {
			//create new latLng object
			var myLatLng = new google.maps.LatLng(place.lat,place.lon);

			// create new info window object
			//var infowindow = new google.maps.InfoWindow();
			
			// create marker for each place with a name label;
			this.markers[place.id] = new google.maps.Marker({
				position: myLatLng,
				draggable: false,
				raiseOnDrag: false,
				map: map
			});	
		},

		removeMarkers: function() {
			if (this.markers) {
				for (prop in this.markers) {
					if (prop !== "user") {
						this.markers[prop].setMap(null);
					}
				}
			}
		},

		update: function() {
			// get map's bounds
			var bounds = map.getBounds();
			var ne = bounds.getNorthEast();
			var sw = bounds.getSouthWest();

			// get places within bounds (asynchronously)
			var parameters = {
				ne: ne.lat() + "," + ne.lng(),
				//q: $("#q").val(),
				sw: sw.lat() + "," + sw.lng()
			};
			var that = this;
			$.getJSON("update.php", parameters)
			.done(function(data, textStatus, jqXHR) {
				// remove old markers from map
				that.removeMarkers();
				
				// add new markers to map
				for (var i = 0; i < data.length; i++)
				{
					that.addMarker(data[i]);
				}
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				// log error to browser's console
				console.log(errorThrown.toString());
			});
		}
	// End prototype declaration
	};

	// Create new child of prototype to be used in program
	var MarkerStack = Marker_proto.create();

	// Create the search box and link it to the UI element.
	var input = document.getElementById('pac-input');
	var searchBox = new google.maps.places.SearchBox(input);
	map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

	// Load markers on map (at beginning and every time map is moved)
	google.maps.event.addListener(map, 'idle', function () { 
		MarkerStack.update();
		searchBox.setBounds(map.getBounds());
	});

	// Listen for the event fired when the user selects a prediction and retrieve
	// more details for that place.
	searchBox.addListener('places_changed', function() {
    	var places = searchBox.getPlaces();

		if (places.length == 0) {
			return;
		}

		// For each place, get the icon, name and location.
		var bounds = new google.maps.LatLngBounds();
		places.forEach(function(place) {
			if (!place.geometry) {
				console.log("Returned place contains no geometry");
				return;
			}

			if (place.geometry.viewport) {
				// Only geocodes have viewport.
				bounds.union(place.geometry.viewport);
			} else {
				bounds.extend(place.geometry.location);
			}
		});
		map.fitBounds(bounds);
  	});

	// Try HTML5 geolocation.  If browser doesn't support, won't display anything
	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            map.setCenter(pos);
            }, function() { }
        );
	}

});


