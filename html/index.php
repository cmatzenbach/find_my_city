<?php
        
        echo '<script>var filters = ';
        echo json_encode($_POST, JSON_HEX_TAG);
        echo ';</script>';

        include("../private/helpers.php");
        render("map.php");
        
?>