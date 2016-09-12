<?php

require("../private/helpers.php");
require("../private/sql.php");

//if no event id in request
if(!isset($_GET["e_id"]))
{
    render("message.php", [message => "Buddy, you forgot to put the e_id in the URL! (if you don't know what this means you're probably fine to just ignore it)"]);
} else {
        //query database for username    
        $pull = $pdo->prepare("SELECT * FROM event WHERE id = ?");
        $pull->execute(array($_GET["e_id"]));
        $rows = $pull->fetchAll(PDO::FETCH_ASSOC);
        $row = $rows[0];

        $eventOwner = $row["user_id"];

        $pull2 = $pdo->prepare("SELECT * FROM user WHERE id = ?");
        $pull2->execute(array($eventOwner));
        $owner_rows = $pull2->fetchAll(PDO::FETCH_ASSOC);
        $owner = $owner_rows[0];

        renderSimple("event_info_view.php", ["data" => $row, "owner" => $owner]);

}

?>