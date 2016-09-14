<?php 

require_once("../private/helpers.php");
require_once("../private/sql.php");

// Must have Session User ID, GET Event ID and GET Mode or else EXIT
if(!isset($_SESSION["user_id"]))
{
    render("message.php", ["message" => "You must login to use this page!"]);
    exit;
}
if(!isset($_GET["e_id"]))
{
    render("message.php", ["message" => "Something's not right. Email tech the webmaster with this phrase: Event id missing from email attendee request."]);
    exit;
}

// Pull Information about the event from the database
$eventQuery = $pdo->prepare("SELECT * FROM event WHERE id = ?");
$eventQuery->execute(array($_GET["e_id"]));
$eventInfo = $eventQuery->fetch(PDO::FETCH_ASSOC);

if($_SESSION["user_id"] != $eventInfo["user_id"]){
    render("message.php", ["message" => "You do not have permission to email the attendees of this event!"]);
    exit;
}

    //pull attendees
    $joinPull = $pdo->prepare("SELECT user.id, user.email FROM attendance INNER JOIN user ON attendance.user_id=user.id WHERE attendance.event_id = ?");
    $joinPull->execute(array($_GET["e_id"]));
    $attendees = $joinPull->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    render("email_attendees_form.php", ["eventInfo" => $eventInfo]);
}
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(empty($_POST["message"]))
    {
        render("message.php", ["message" => "You didn't write a message! Better luck next time!"]);
        exit;
    }
    //pull attendees
    $joinPull = $pdo->prepare("SELECT user.id, user.email FROM attendance INNER JOIN user ON attendance.user_id=user.id WHERE attendance.event_id = ?");
    $joinPull->execute(array($_GET["e_id"]));
    $attendees = $joinPull->fetchAll(PDO::FETCH_ASSOC);

    $subject = "FindMy.City | Message regarding " . $eventInfo["name"];
    $msg = $_POST["message"];
//    $msg = $msg + "\n\n You received this message because you registered to attend an event on findmy.city. Email webmaster@findmy.city with any comments or concerns. ";

    //wrap long lines
    $msg = wordwrap($msg,70);

    foreach($attendees as $attendee)
    {
        mail($attendee["email"],$subject,$msg);
    }

    render("message.php", ["message" => "Email Sent!"]);
}

?>