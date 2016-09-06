<!DOCTYPE html>
<html>
    <head>

        <!-- http://getbootstrap.com/ -->
        <link href="/css/bootstrap.min.css" rel="stylesheet" />

        <!-- app's own CSS -->
        <link href="/css/styles.css" rel="stylesheet" />

        <!-- https://developers.google.com/maps/documentation/javascript/ -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACxiNX7F3MUxVS9eQ-m4kYmX-vQOeJYog"></script>
        <!-- http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerwithlabel/1.1.10/ -->
        
        <!-- This is fucking stupid we won't use this at all: -->
        <script src="/js/markerwithlabel_packed.js"></script>


        <!-- http://jquery.com/ -->
        <script src="/js/jquery-1.11.3.min.js"></script>
        <!-- http://getbootstrap.com/ -->
        <script src="/js/bootstrap.min.js"></script>
        <!-- http://underscorejs.org/ -->
        <script src="/js/underscore-min.js"></script>

        <!-- https://github.com/twitter/typeahead.js/ -->
        <script src="/js/typeahead.jquery.min.js"></script>

        <!-- app's own JavaScript -->
        <script src="/js/scripts.js"></script>

        <title>findmycity test</title>

    </head>

    <body>


        <!-- Start main panel -->
        <ul class="tab-row">
            <li class="selected"><a href="#">Events Near Me</a></li>
            <li><a href="#">My Gr&uuml;ps</a></li>
            <li><a href="#">Register</a></li>
        </ul>

        <div class="super-container">

        <div class="map-container">
