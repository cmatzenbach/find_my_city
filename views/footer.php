<?php

if(!isset($_GET["map"]))
{
 normalMap();

} else {

    if($_GET["map"] = "pkr"){

      print("<!-- default google map and local js omitted -->");
    }else{
        normalMap();    
    }
}
//print the normal map javascript
function normalMap() {
   print("<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyD9P8DYB0zXsO4NfnnqrX8zeofdyK5OegA&libraries=places'></script><script src='js/fmc.js'></script>");
}
?>

<script src='js/nav.js'></script>
  </body>
</html>