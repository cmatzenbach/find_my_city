<?php

    require("../private/helpers.php");
    require("../private/sql.php");

    if(!isset($_SESSION["user_id"])) 
    {
        renderSimple("message.php", ["message" => "You must login to use this page!"]);
        exit;
    }


     //get all user attending events
        $dashboardPDO1 = $pdo->prepare("SELECT attendance.event_id, event.name FROM attendance INNER JOIN event ON attendance.event_id=event.id WHERE attendance.user_id = ?");
        $dashboardPDO1->execute(array($_SESSION["user_id"]));
        $userAttendingEvents = $dashboardPDO1->fetchAll(PDO::FETCH_ASSOC);

    //get all events created by user
        $dashboardPDO2 = $pdo->prepare("SELECT id, name FROM event WHERE user_id = ?");
        $dashboardPDO2->execute(array($_SESSION["user_id"]));
        $userOwnedEvents = $dashboardPDO2->fetchAll(PDO::FETCH_ASSOC);

    //get username
        $dashboardPDO3 = $pdo->prepare("SELECT displayName FROM user WHERE id = ?");
        $dashboardPDO3->execute(array($_SESSION["user_id"]));
        $ownerData = $dashboardPDO3->fetch(PDO::FETCH_ASSOC);

        render("dashboard_view.php", ["userAttendingEvents" => $userAttendingEvents, "userOwnedEvents" => $userOwnedEvents, "displayName" => $ownerData["displayName"]]);
?>