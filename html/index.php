<?php
        
        print_r(json_encode($_POST, JSON_HEX_TAG));
        echo '<script>var filters = ';
        echo json_encode($_POST, JSON_HEX_TAG);
        echo ';console.log(filters);</script>';

        include("../private/helpers.php");
        render("map.php");
?>