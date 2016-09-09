<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>FindMy.City <?= $title ?></title>

        <!-- http://getbootstrap.com/ -->
        <link href="/css/bootstrap.min.css" rel="stylesheet" />

        <!-- app's own CSS -->
        <link href="/css/styles.css" rel="stylesheet" />

        <!-- http://jquery.com/ -->
        <script src="/js/jquery-1.11.3.min.js"></script>

        <!-- http://getbootstrap.com/ -->
        <script src="/js/bootstrap.min.js"></script>

        <!-- http://parsleyjs.org/ - v2.4.4 -->
        <script src="/js/parsley.min.js"></script>

        <!-- eModal -->
        <script src="https://rawgit.com/saribe/eModal/master/dist/eModal.min.js"></script>

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
            <li><a href="#">Events Nearby</a></li>
            <li><a href="#">Map Filters</a></li>
            <li id="whatIsFindMyCity"><a href="javascript:;">What is FindMy.City?</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <?php 
          if(isset($_SESSION["user_id"]))
          {
            require("user_profile_navbar.php");
            require("user_events_dynamic_bar.php");
          }else{
            print('<li class="active" id="navRegister"><a href="javascript:;">Login/Register <span class="sr-only">(current)</span></a></li>');
          }?> 
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-->
    </nav>
  <!-- END NAV -->