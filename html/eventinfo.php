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
        //query database for event ID    
        $pull = $pdo->prepare("SELECT * FROM event WHERE id = ?");
        $pull->execute(array($_GET["e_id"]));
        $eventData = $pull->fetch(PDO::FETCH_ASSOC);
        //$eventData = $rows[0];

        $eventOwner = $eventData["user_id"];

        //pull events
        $pull2 = $pdo->prepare("SELECT * FROM user WHERE id = ?");
        $pull2->execute(array($eventOwner));
        $ownerData = $pull2->fetch(PDO::FETCH_ASSOC);
        //$ownerData = $owner_rows[0];

        //pull attendees
        $pull3 = $pdo->prepare("SELECT user.id, user.displayName FROM attendance INNER JOIN user ON attendance.user_id=user.id WHERE attendance.event_id = ?");
        $pull3->execute(array($_GET["e_id"]));
        $attendees = $pull3->fetchAll(PDO::FETCH_ASSOC);
        $attendeeCount = count($attendees);
        
        //if user is logged in
        if(isset($_SESSION["user_id"]))
        {
            //check if user is attending
            $pull4 = $pdo->prepare("SELECT user_id FROM attendance WHERE user_id = ? AND event_id = ?");
            $pull4->execute(array($_SESSION["user_id"],$_GET["e_id"]));
            $userAttendee = $pull4->fetchAll(PDO::FETCH_ASSOC);
            $userAttendanceCount = count($userAttendee);
            if($userAttendanceCount > 0){
                $isAttending = "yes";
            }else{
                $isAttending = "no";
            }

        }
        
        //if attendee count has reached limit

        $disableRSVP = "No";
        if($attendeeCount >= $eventData["maxAllowed"])
        {
            $disableRSVP = "Yes";
        }

        renderSimple("event_info_view.php", ["data" => $eventData, "owner" => $ownerData, "attendeeCount" => $attendeeCount, "attendees" => $attendees, "isAttending" => $isAttending]);

}

?>