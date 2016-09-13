<?php

//terminolgy manage preferred over edit since this controller doesnt update the database

    require("../private/helpers.php");
    require("../private/sql.php");

if(isset($_GET["mode"]))
{

    if($_GET["mode"] == "modal")
    {
        if(!isset($_SESSION["user_id"])) 
        {
            renderSimple("message.php", ["message" => "You must login to use this page!"]);
            exit;
        }

        if(!isset($_GET["e_id"]) && !isset($_POST["event_id"])) {
            renderSimple("message.php", ["message" => "MISSING EVENT ID IN YOUR REQUEST! AHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHHH! (jk its cool but let the webmaster know)"]);
            exit;
        }

        $pull = $pdo->prepare("SELECT * FROM event WHERE id = ?");
        $pull->execute(array($_GET["e_id"]));
        $eventData = $pull->fetch(PDO::FETCH_ASSOC);
        
        if(count($eventData) > 0){
            renderSimple("event_edit_choose_view.php", ["eventData" => $eventData]);    
        }else{
            renderSimple("message.php", ["message" => "The event you are trying to edit does not exist!"]);
        }
    }

}else{
    renderSimple("message.php", ["message" => "Mode is missing in your event edit request!"]);
}


?>