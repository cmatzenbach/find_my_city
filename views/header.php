<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Fullscreen Google Maps With Bootstrap 3.3.5</title>
    

    <link rel="stylesheet" href="css/styles.css">

  </head>

  <body>

    <!-- BEGIN NAV -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">FindMy.City</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Events Nearby</a></li>
            <li><a href="#">Map Filters</a></li>
            <li><a href="#">What is FindMy.City?</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <?php 
          if(isset($_GET["id"]))
          {
            require("user_navbar.php");
            require("user_events_dynamic_bar.php");
          }else{
            print('<li class="active" id="navRegister"><a href="#">Login/Register <span class="sr-only">(current)</span></a></li>');
          }?> 
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-->
    </nav>
  <!-- END NAV -->