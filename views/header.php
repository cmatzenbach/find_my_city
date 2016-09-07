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

        <!-- eModal -->
        <script src="https://rawgit.com/saribe/eModal/master/dist/eModal.min.js"></script>
 

        <title>FindMy.City</title>

    </head>

    <body>


        <!-- Start main panel -->
        <ul class="tab-row">
            <li id="navEventsNearMee"><a href="#">Events Near Me</a></li>
            <li id="navMyCity"><a href="#"><strong>My</strong> City</a></li>
            <li id="navRegister"><a href="#">Register/Login</a></li>
        </ul>
       <script>
        $('#myModal').modal('show');

        $("#navRegister").click(function() {

            var options = {
                    url: "renderstration.php",
                    title:'Login/Register',
                    size: 'xl',
                    subtitle: 'Login is required to add new events'
                };

            eModal.ajax(options);
        });
        </script>


        <div class="super-container">
        <!-- end HEADER FILE -->
