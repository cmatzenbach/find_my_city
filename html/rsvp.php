<?php 

require_once("../private/helpers.php");
require("../private/sql.php");

// Must have Session User ID, GET Event ID and GET Mode or else EXIT
if(!isset($_SESSION["user_id"]))
{
    render("message.php", ["message" => "You must login to use this page!"]);
    exit;
}
if(!isset($_GET["e_id"]))
{
    render("message.php", ["message" => "Something's not right. Email tech the webmaster with this phrase: Event id missing from rsvp request."]);
    exit;
}
if(!isset($_GET["mode"]))
{
    render("message.php", ["message" => "Something's not right. Email tech the webmaster with this phrase: Mode parameter missing from rsvp request."]);
    exit;
}

// Pull Information about the event from the database
$eventQuery = $pdo->prepare("SELECT * FROM event WHERE id = ?");
$eventQuery->execute(array($_GET["e_id"]));
$eventInfo = $eventQuery->fetchAll(PDO::FETCH_ASSOC);

//if mode is RSVP YES
if($_GET["mode"] == "Y")
{
    //Check if they are attending the event
    $q1 = $pdo->prepare("SELECT * FROM attendance WHERE user_id = ? AND event_id = ?");
    $q1->execute(array($_SESSION["user_id"], $_GET["e_id"])); 
    $rows = $q1->fetchAll(PDO::FETCH_ASSOC);
    if(count($rows) > 0)
    {
        render("message.php", ["message" => "You were already registered for this event"]);
        exit;
    
    }else{
    //else they are not already attending the event

        if(count($eventInfo) > 0 && $eventInfo[0]["status"] != "full")
        {
            try{
                $q3 = $pdo->prepare("INSERT INTO attendance(user_id,event_id) VALUES(?,?)");
                $q3->execute(array($_SESSION["user_id"],$_GET["e_id"]));
            }catch(PDOException $e) {
                throw $e;
                exit;
            }

            $message = "You are now attending " . $eventInfo[0]["name"];

        }else {
            render("message.php", ["message" => "It looks like the event you're trying to RSVP for either doesn't exist or doesn't hava capacity for additional attendees."]);
            exit;
        }

    }
}elseif($_GET["mode"] == "N")
{
    //Check if they are attending the event
    $q8 = $pdo->prepare("SELECT * FROM attendance WHERE user_id = ? AND event_id = ?");
    $q8->execute(array($_SESSION["user_id"], $_GET["e_id"])); 
    $q8rows = $q8->fetchAll(PDO::FETCH_ASSOC);
    if(count($q8rows) > 0)
    {
        //delete attendance record
        $q9 = $pdo->prepare("DELETE FROM attendance WHERE user_id = ? AND event_id = ?");
        $q9->execute(array($_SESSION["user_id"], $_GET["e_id"]));
        //set update flag
        $message = "You are no longer attending " . $eventInfo[0]["name"];
    } else {
        render("message.php", ["message" => "You weren't attending " . $eventInfo[0]["name"] ]);
        exit;
    }
    
}else{
    render("message.php", ["message" => "Invalid Mode Specified!"]);
    exit;
}

//query the database to determine the new number of attendees
$q4 = $pdo->prepare("SELECT * FROM attendance WHERE event_id = ?");
$q4->execute(array($_GET["e_id"]));
$eventAttendance = $q4->fetchAll(PDO::FETCH_ASSOC);
$eventCount = count($eventAttendance);
//print("<h1> Event count is " . $eventCount . "</h1>");
//print("<h1> Event MAX is " . $eventInfo[0]["maxAllowed"] . "</h1>");
//print("<h1> Event MIN is " . $eventInfo[0]["minRequired"] . "</h1>");

//if the number of attendees is between min required and max allowed set status active
if($eventCount >= $eventInfo[0]["minRequired"] && $eventCount < $eventInfo[0]["maxAllowed"])
{
    $q5 =  $pdo->prepare("UPDATE event SET status='active' WHERE id=?")
        ->execute(array($_GET["e_id"]));

//else if event has less than minimum required set status pending
}elseif($eventCount < $eventInfo[0]["minRequired"])
{
        $q6 =  $pdo->prepare("UPDATE event SET status='pending' WHERE id=?");
        $q6->execute(array($_GET["e_id"]));

//else if event has greater than or equal to the than max allowed set status full
}elseif($eventCount >= $eventInfo[0]["maxAllowed"])
{
        $q7 =  $pdo->prepare("UPDATE event SET status='full' WHERE id=?");
        $q7->execute(array($_GET["e_id"]));
}

render("message.php", ["message" => $message]);


?>