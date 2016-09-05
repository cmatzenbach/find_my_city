// Google Map
var map;

// markers for map
var markers = [];


// info window
var info = new google.maps.InfoWindow();

// execute when the DOM is fully loaded
$(function() {

    // styles for map
    // https://developers.google.com/maps/documentation/javascript/styling
    var styles = [

        // hide Google's labels
        {
            featureType: "all",
            elementType: "labels",
            stylers: [
                {visibility: "off"}
            ]
        },

        // hide roads
        {
            featureType: "road",
            elementType: "geometry",
            stylers: [
                {visibility: "off"}
            ]
        }

    ];

    // options for map
    // https://developers.google.com/maps/documentation/javascript/reference#MapOptions
    var options = {
        center: {lat: 37.4236, lng: -122.1619}, // Stanford, California
        disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        maxZoom: 14,
        panControl: true,
        styles: styles,
        zoom: 13,
        zoomControl: true
    };

    // get DOM node in which map will be instantiated
    var canvas = document.getElementById("map-canvas");

    // instantiate map
    map = new google.maps.Map(canvas, options);

    // configure UI once Google Map is idle (i.e., loaded)
    google.maps.event.addListenerOnce(map, "idle", configure);


    // Google's code for getting user geolocation, modified to fit our program.  Displays users current position.  
    // Call on onload so it only executes once
    
    // Try HTML5 geolocation.  If browser doesn't support, won't display anything
    if (navigator.geolocation) {
            
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
    
            markers["user"] = new MarkerWithLabel({
                position: pos,
                draggable: false,
                raiseOnDrag: false,
                map: map,
                labelContent: "Your Location"
            });
            
            map.setCenter(pos);
            var infowindow = new google.maps.InfoWindow();
            infowindow.setContent("You are here!");
            infowindow.open(map, markers["user"]);
    
            }, function() { }
        );
      
    }

});

/**
 * function to copy object
 */
function copyObj(src, dst) {
    for (prop in src) {
        dst[prop] = src[prop];
    }
    return dst;
}

/**
 * take parsed ajax response with article data and turn into html string
 */
function parseArticles(data) {
    var htmlText = "<ul>";
    for (prop in data) {
        htmlText += "<li><a href=\'" + data[prop].link + "\' target=_blank>" + data[prop].title + "</li>";
    }
    htmlText += "</ul>";
    return htmlText;
}

/**
 * function to make ajax call for articles
 */
/*function getAjaxArticles(url, infowindow, marker) {

    var ajax = new XMLHttpRequest();
    
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            
            // use JSON.parse to parse responseText
            var stuff = JSON.parse(ajax.responseText);
            
            // then parse again with my own function, turning into <ul> and returning HTML string
            var parse = parseArticles(stuff);
            
            // change window content to html string returned from parseArticles
            infowindow.setContent(parse);
            infowindow.open(map, marker);
        }
    }
    
    ajax.open("GET", "/articles.php?geo=" + url, true);
    ajax.send();
}*/

/**
 * Adds marker for place to map.
 */
function addMarker(place)
{
    //create new latLng object
    var myLatLng = new google.maps.LatLng(place.latitude,place.longitude);
    
    // create new info window object
    var infowindow = new google.maps.InfoWindow();
    
    // create marker for each place with a name label
    markers[place.id] = new MarkerWithLabel({
       position: myLatLng,
       draggable: false,
       raiseOnDrag: false,
       map: map,
       labelContent: place.place_name
    });
    
    // when marker is clicked, close place marker, and call function to generate article listing
    google.maps.event.addListener(markers[place.id], 'click', function() {
        infowindow.close(map,markers[place.id]);
        getAjaxArticles(place.postal_code, infowindow, markers[place.id]); 
    });
}

/**
 * Configures application.
 */
function configure()
{
    // update UI after map has been dragged
    google.maps.event.addListener(map, "dragend", function() {
        update();
    });

    // update UI after zoom level changes
    google.maps.event.addListener(map, "zoom_changed", function() {
        update();
    });

    // remove markers whilst dragging
    google.maps.event.addListener(map, "dragstart", function() {
        removeMarkers();
    });

    // configure typeahead
    // https://github.com/twitter/typeahead.js/blob/master/doc/jquery_typeahead.md
    $("#q").typeahead({
        autoselect: true,
        highlight: true,
        minLength: 1
    },
    {
        source: search,
        templates: {
            empty: "no places found yet",
            suggestion: _.template("<p><%- place_name %>, <%- admin_name1 %> <%- postal_code %></p>")
        }
    });

    // re-center map after place is selected from drop-down
    $("#q").on("typeahead:selected", function(eventObject, suggestion, name) {

        // ensure coordinates are numbers
        var latitude = (_.isNumber(suggestion.latitude)) ? suggestion.latitude : parseFloat(suggestion.latitude);
        var longitude = (_.isNumber(suggestion.longitude)) ? suggestion.longitude : parseFloat(suggestion.longitude);

        // set map's center
        map.setCenter({lat: latitude, lng: longitude});

        // update UI
        update();
    });

    // hide info window when text box has focus
    $("#q").focus(function(eventData) {
        hideInfo();
    });

    // re-enable ctrl- and right-clicking (and thus Inspect Element) on Google Map
    // https://chrome.google.com/webstore/detail/allow-right-click/hompjdfbfmmmgflfjdlnkohcplmboaeo?hl=en
    document.addEventListener("contextmenu", function(event) {
        event.returnValue = true; 
        event.stopPropagation && event.stopPropagation(); 
        event.cancelBubble && event.cancelBubble();
    }, true);

    // update UI
    update();

    // give focus to text box
    $("#q").focus();
}

/**
 * Hides info window.
 */
function hideInfo()
{
    info.close();
}

/**
 * Removes markers from map.
 */
function removeMarkers()
{
    if (markers) {
        for (prop in markers) {
            if (prop !== "user") {
                markers[prop].setMap(null);
            }
        }
    }
}

/**
 * Searches database for typeahead's suggestions.
 */
function search(query, cb)
{
    // get places matching query (asynchronously)
    var parameters = {
        geo: query
    };
    $.getJSON("search.php", parameters)
    .done(function(data, textStatus, jqXHR) {

        // call typeahead's callback with search results (i.e., places)
        cb(data);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {

        // log error to browser's console
        console.log(errorThrown.toString());
    });
}

/**
 * Shows info window at marker with content.
 */
function showInfo(marker, content)
{
    // start div
    var div = "<div id='info'>";
    if (typeof(content) === "undefined")
    {
        // http://www.ajaxload.info/
        div += "<img alt='loading' src='img/ajax-loader.gif'/>";
    }
    else
    {
        div += content;
    }

    // end div
    div += "</div>";

    // set info window's content
    info.setContent(div);

    // open info window (if not already open)
    info.open(map, marker);
}

/**
 * Updates UI's markers.
 */
function update() 
{
    // get map's bounds
    var bounds = map.getBounds();
    var ne = bounds.getNorthEast();
    var sw = bounds.getSouthWest();

    // get places within bounds (asynchronously)
    var parameters = {
        ne: ne.lat() + "," + ne.lng(),
        q: $("#q").val(),
        sw: sw.lat() + "," + sw.lng()
    };
    $.getJSON("update.php", parameters)
    .done(function(data, textStatus, jqXHR) {

        // remove old markers from map
        removeMarkers();

        // add new markers to map
        for (var i = 0; i < data.length; i++)
        {
            addMarker(data[i]);
        }
     })
     .fail(function(jqXHR, textStatus, errorThrown) {

         // log error to browser's console
         console.log(errorThrown.toString());
     });
}