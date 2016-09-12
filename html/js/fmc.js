jQuery(document).ready(function($){

	var latitude = 39.999673,
		longitude = -83.012856,
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

			var iconurl = "https://www.findmy.city/img/" + place.category + ".png";

			// create new info window object for loading
			var infowind = new google.maps.InfoWindow({
                content: '<div id="infotext">loading...</div>'
            });
            

			// create marker for each place with a name label;
			this.markers[place.id] = new google.maps.Marker({
				position: myLatLng,
				icon: iconurl,
				draggable: false,
				raiseOnDrag: false,
				map: map
			});

			var that = this;
			//monitor marker for on-click
            google.maps.event.addListener(that.markers[place.id],'click', function(){
                // close previously opened info windows if they exist
                if (that.infowindPrevious) that.infowindPrevious.close(map,that.markers[place.id]);

			    // on click open the new info window
                infowind.open(map, that.markers[place.id]);
				// add prop to current object that holds last info window opened
				that.infowindPrevious = infowind;

				ajax_eventinfo(infowind,place.id);

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


/**
 *  returns event info for a given info window 
 **/ 
function ajax_eventinfo(winder,e_id) {
    var ajaj = new XMLHttpRequest();
    ajaj.onreadystatechange = function() {
        if(ajaj.readyState == 4 && ajaj.status == 200) {
			var jsdate = Date.parse(ajaj.response[0].eventTime); // result comes out as yyyy-mm-dd hh:mm:ss
			var dateFormatted = new Date(ajaj.response[0].eventTime);
            var html = '<div>'
            html += '<strong>Event:</strong> ';
            html += ajaj.response[0].name;
			html += '<br/><strong>Happening At:</strong> ';
			var finalDate = formatDate(dateFormatted,"ddd MMM d \@ h:mm TT");
			finalDate = finalDate.replace(/@/,'at');
			html += finalDate;
			html += '<br/><br/><span style="color:blue;cursor:pointer;text-decoration:underine;" onClick="eventInfoModal(';
			html += e_id;  // ",'" + ajaj.response[0].name; + "')heyy";
			html += ')">Click here for more details</span></div>';
            winder.setContent(html);
        }
    };
    var url = "infowindow.php?e_id=" + e_id;
    ajaj.responseType = 'json';
    ajaj.open("GET",url,true);
    ajaj.send();
}


// http://stackoverflow.com/questions/14638018/current-time-formatting-with-javascript

function formatDate(date, format, utc) {
    var MMMM = ["\x00", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var MMM = ["\x01", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var dddd = ["\x02", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var ddd = ["\x03", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    function ii(i, len) {
        var s = i + "";
        len = len || 2;
        while (s.length < len) s = "0" + s;
        return s;
    }

    var y = utc ? date.getUTCFullYear() : date.getFullYear();
    format = format.replace(/(^|[^\\])yyyy+/g, "$1" + y);
    format = format.replace(/(^|[^\\])yy/g, "$1" + y.toString().substr(2, 2));
    format = format.replace(/(^|[^\\])y/g, "$1" + y);

    var M = (utc ? date.getUTCMonth() : date.getMonth()) + 1;
    format = format.replace(/(^|[^\\])MMMM+/g, "$1" + MMMM[0]);
    format = format.replace(/(^|[^\\])MMM/g, "$1" + MMM[0]);
    format = format.replace(/(^|[^\\])MM/g, "$1" + ii(M));
    format = format.replace(/(^|[^\\])M/g, "$1" + M);

    var d = utc ? date.getUTCDate() : date.getDate();
    format = format.replace(/(^|[^\\])dddd+/g, "$1" + dddd[0]);
    format = format.replace(/(^|[^\\])ddd/g, "$1" + ddd[0]);
    format = format.replace(/(^|[^\\])dd/g, "$1" + ii(d));
    format = format.replace(/(^|[^\\])d/g, "$1" + d);

    var H = utc ? date.getUTCHours() : date.getHours();
    format = format.replace(/(^|[^\\])HH+/g, "$1" + ii(H));
    format = format.replace(/(^|[^\\])H/g, "$1" + H);

    var h = H > 12 ? H - 12 : H == 0 ? 12 : H;
    format = format.replace(/(^|[^\\])hh+/g, "$1" + ii(h));
    format = format.replace(/(^|[^\\])h/g, "$1" + h);

    var m = utc ? date.getUTCMinutes() : date.getMinutes();
    format = format.replace(/(^|[^\\])mm+/g, "$1" + ii(m));
    format = format.replace(/(^|[^\\])m/g, "$1" + m);

    var s = utc ? date.getUTCSeconds() : date.getSeconds();
    format = format.replace(/(^|[^\\])ss+/g, "$1" + ii(s));
    format = format.replace(/(^|[^\\])s/g, "$1" + s);

    var f = utc ? date.getUTCMilliseconds() : date.getMilliseconds();
    format = format.replace(/(^|[^\\])fff+/g, "$1" + ii(f, 3));
    f = Math.round(f / 10);
    format = format.replace(/(^|[^\\])ff/g, "$1" + ii(f));
    f = Math.round(f / 10);
    format = format.replace(/(^|[^\\])f/g, "$1" + f);

    var T = H < 12 ? "AM" : "PM";
    format = format.replace(/(^|[^\\])TT+/g, "$1" + T);
    format = format.replace(/(^|[^\\])T/g, "$1" + T.charAt(0));

    var t = T.toLowerCase();
    format = format.replace(/(^|[^\\])tt+/g, "$1" + t);
    format = format.replace(/(^|[^\\])t/g, "$1" + t.charAt(0));

    var tz = -date.getTimezoneOffset();
    var K = utc || !tz ? "Z" : tz > 0 ? "+" : "-";
    if (!utc) {
        tz = Math.abs(tz);
        var tzHrs = Math.floor(tz / 60);
        var tzMin = tz % 60;
        K += ii(tzHrs) + ":" + ii(tzMin);
    }
    format = format.replace(/(^|[^\\])K/g, "$1" + K);

    var day = (utc ? date.getUTCDay() : date.getDay()) + 1;
    format = format.replace(new RegExp(dddd[0], "g"), dddd[day]);
    format = format.replace(new RegExp(ddd[0], "g"), ddd[day]);

    format = format.replace(new RegExp(MMMM[0], "g"), MMMM[M]);
    format = format.replace(new RegExp(MMM[0], "g"), MMM[M]);

    format = format.replace(/\\(.)/g, "$1");

    return format;
};