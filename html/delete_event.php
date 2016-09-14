<?php 

require_once("../private/helpers.php");
require_once("../private/sql.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    render("delete_event_confirm.php", ["e_id" => $_GET["e_id"]]);
}

else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Must have Session User ID, GET Event ID and GET Mode or else EXIT
    if(!isset($_SESSION["user_id"])) {
        render("message.php", ["message" => "You must login to use this page!"]);
    }
    if(!isset($_GET["e_id"])) {
        render("message.php", ["message" => "Something's not right. Email tech the webmaster with this phrase: Event id missing from rsvp request."]);
    }

    // Pull Information about the event from the database
    $eventQuery = $pdo->prepare("SELECT * FROM event WHERE id = ?");
    $eventQuery->execute(array($_GET["e_id"]));
    $eventInfo = $eventQuery->fetchAll(PDO::FETCH_ASSOC);

    // This means they are not the owner of event trying to be deleted
    if ($_SESSION["user_id"] != $eventInfo[0]["user_id"]) {
        render("message.php", ["message" => "You are not allowed to delete other users' events!"]);
    }

    // If we're at this point, ok to delete event from table
    $deleteEvent = $pdo->prepare("DELETE FROM event WHERE id = ?");
    $deleteEvent->execute(array($_GET["e_id"]));
    $evtDel = $deleteEvent->rowCount();
    print_r($evtDel . " event(s) deleted\n");
    if ($evtDel === 0) render("message.php", ["message.php","Error: Could not delete event. Please contact the devs."]);

    // Now need to delete all attendance records for event
    $deleteAtt = $pdo->prepare("DELETE FROM attendance WHERE event_id = ?");
    $deleteAtt->execute(array($_GET["e_id"]));
    $attDel = $deleteAtt->rowCount();
    print_r($attDel . " attendances deleted\n");
    if ($attDel === 0) render("message.php", ["message" => "Error: Could not remove attendance records for event.  Please contact the devs."]);

    render("message.php", ["message" => "Event successfully deleted!"]);

}

?>