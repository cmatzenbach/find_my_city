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
				{ hue: "#551A8B" },
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
			position: google.maps.ControlPosition.BOTTOM_CENTER
		}
    }
	var map = new google.maps.Map(document.getElementById('map'), map_options);			

	/*  
		var marker = new google.maps.Marker({
	  	position: new google.maps.LatLng(latitude, longitude),
	    map: map,
	    visible: true,
	 	icon: marker_url,
	}); 
	*/
	
	// Try HTML5 geolocation.  If browser doesn't support, won't display anything
	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            map.setCenter(pos);    
            }, function() { window.alert('trigger success'); }
        );
	}

	// create object prototype for markers, including markers array and relevant methods
	var Marker_proto = {

		markers: [],

		// methods
		create: function () {
			var self = Object.create(this);
			//self.params = data;
			return self;
		},

		addMarker: function(place) {
			//create new latLng object
			var myLatLng = new google.maps.LatLng(place.latitude,place.longitude);

			// create new info window object
			//var infowindow = new google.maps.InfoWindow();
			
			// create marker for each place with a name label;
			this.markers[place.id] = new google.maps.Marker({
				position: myLatLng,
				draggable: false,
				raiseOnDrag: false,
				map: map,
				//labelContent: place.place_name
			});
			
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
				//removeMarkers();

				// add new markers to map
				for (var i = 0; i < data.length; i++)
				{
					that.addMarker(data[i]);
				}
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				// log error to browser's console
				console.log(errorThrown.toString());
				console.log("fail");
			});
		}

	};

	//pop up for registration
	var MarkerStack = Marker_proto.create();
	
	//google.maps.event.addListenerOnce(map, 'bounds_changed', MarkerStack.update());
	google.maps.event.addListenerOnce(map, 'bounds_changed', function() {
		MarkerStack.update();
  	});


});

/* Registration/login Popup */
$("#navRegister").click(function() {

	var options = {
			url: "renderstration.php",
			title:'Login/Register',
			size: 'xl',
			subtitle: 'Login is required to add new events'
		};

	eModal.ajax(options);
});

/* Registration/login Popup */
$("#whatIsFindMyCity").click(function() {

	var options = {
			url: "https://findmy.city/about.php",
			title:'About FindMy.City',
			size: 'xl',
			subtitle: ''
		};

	eModal.ajax(options);
});

/* Logout Button */
// http://stackoverflow.com/questions/25260446/php-log-out-with-ajax-call
$("#logout_btn").click(function() {
            $.ajax({
                url: 'logout.php',
                success: function(data){
                    window.location.href = data;
                }
            });
        });

