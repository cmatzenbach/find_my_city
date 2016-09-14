<?php

//currently unused but cute!


require("../private/helpers.php");
require("../private/sql.php");

//surpress errors (if you DARE -- because you know that they're BS')
//error_reporting(0);


//if no event id in request
if(isset($_SESSION["user_id"]))
{
        //get all users events
        $pull = $pdo->prepare("SELECT attendance.event_id, event.name FROM attendance INNER JOIN event ON attendance.event_id=event.id WHERE attendance.user_id = ?");
        $pull->execute(array($_SESSION["user_id"]));
        $userEventData = $pull->fetchAll(PDO::FETCH_ASSOC);


}

?>