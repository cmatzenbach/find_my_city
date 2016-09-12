<?php

require("../private/helpers.php");
require("../private/sql.php");

//surpress errors (if you DARE -- because you know that they're BS')
//error_reporting(0);


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

        //pull events
        $pull2 = $pdo->prepare("SELECT * FROM user WHERE id = ?");
        $pull2->execute(array($eventOwner));
        $owner_rows = $pull2->fetchAll(PDO::FETCH_ASSOC);
        $owner = $owner_rows[0];

        //pull attendees
        $pull3 = $pdo->prepare("SELECT user_id FROM attendance WHERE event_id = ?");
        $pull3->execute(array($_GET["e_id"]));
        $attendees = $pull3->fetchAll(PDO::FETCH_COLUMN);
        $attendeeCount = count($attendees);
        print("ATTENDEE PRINTR:");
        print_r($attendees);

        //if attendee count has reached limit
        if($attendeeCount >= $row["maxAllowed"])
        {
            $disableRSVP = "Yes";
        }

        renderSimple("event_info_view.php", ["data" => $row, "owner" => $owner, "attendeeCount" => $attendeeCount, "disableRSVP" => $disableRSVP, "attendees" => $attendees]);

}

?>