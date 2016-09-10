<?php

    require(__DIR__ . "/../private/sql.php");

    // ensure proper usage
    if (!isset($_GET["sw"], $_GET["ne"]))
    {
        http_response_code(400);
        exit;
    }

    // ensure each parameter is in lat,lng format
    if (!preg_match("/^-?\d+(?:\.\d+)?,-?\d+(?:\.\d+)?$/", $_GET["sw"]) ||
        !preg_match("/^-?\d+(?:\.\d+)?,-?\d+(?:\.\d+)?$/", $_GET["ne"]))
    {
        http_response_code(400);
        exit;
    }

    // explode southwest corner into two variables
    list($sw_lat, $sw_lng) = explode(",", $_GET["sw"]);

    // explode northeast corner into two variables
    list($ne_lat, $ne_lng) = explode(",", $_GET["ne"]);

    // find 10 cities within view, pseudorandomly chosen if more within view
    if ($sw_lng <= $ne_lng)
    {
        // doesn't cross the antimeridian
        $check = $pdo->prepare("SELECT * FROM event WHERE ? <= lat AND lat <= ? AND (? <= lon AND lon <= ?) ORDER BY RAND() LIMIT 15");
        $check->execute(array($sw_lat, $ne_lat, $sw_lng, $ne_lng));
        $rows = $check->fetchAll(PDO::FETCH_ASSOC);
    }
    else
    {
        // crosses the antimeridian
        $check2 = $pdo->prepare("SELECT * FROM event WHERE ? <= lat AND lat <= ? AND (? <= lon OR lon <= ?) ORDER BY RAND() LIMIT 15");
        $check2->execute(array($sw_lat, $ne_lat, $sw_lng, $ne_lng));
        $rows = $check2->fetchAll(PDO::FETCH_ASSOC);
    }

    // output places as JSON (pretty-printed for debugging convenience)
    header("Content-type: application/json");
    print(json_encode($rows, JSON_PRETTY_PRINT));

?>