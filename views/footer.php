<?php

if($_GET["map"] != "pkr")
{
  print("<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyD9P8DYB0zXsO4NfnnqrX8zeofdyK5OegA&libraries=places'></script><script src='js/fmc.js'></script>");
} else {
  print("<!-- default google map and local js omitted -->");
}
?>
  </body>
</html>