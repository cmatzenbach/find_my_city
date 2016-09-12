<?php
    
require("../private/helpers.php");
require("../private/sql.php");

if (!isset($_GET["displayName"])) {
    render("message.php", ["message" => "Error. Please <a href=\'mailto:cmatzenbach@gmail.com\'>contact</a> the devs."]);
}

else {
    // lookup database for displayName
    $pull = $pdo->prepare("SELECT * FROM user WHERE displayName = ?");
    $pull->execute(array($_GET["displayName"]));
    $rows = $pull->fetchAll(PDO::FETCH_ASSOC);
    //prepare json
    print(json_encode($rows, JSON_PRETTY_PRINT));
}

?>