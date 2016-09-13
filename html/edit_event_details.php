<?php 

require_once("../private/helpers.php");
require("../private/sql.php");

    // if user reached page via GET

    if(!isset($_SESSION["user_id"])) {
        render("message.php", ["message" => "LOGIN REQUIRED"]);
        exit;
    }

    if(!isset($_GET["e_id"])) {
        render("message.php", ["message" => "EVENT ID MISSING"]);
        exit;
    }

    if($_SERVER["REQUEST_METHOD"] == "GET") 
    {
        //query database for event ID    
        $pull = $pdo->prepare("SELECT * FROM event WHERE id = ?");
        $pull->execute(array($_GET["e_id"]));
        $eventData = $pull->fetch(PDO::FETCH_ASSOC);
        
        if($eventData["user_id"] == $_SESSION["user_id"])
        {
            render("edit_event_details_form.php", ["eventData" => $eventData]);            
        }else{
            render("message.php", ["message" => "HEY YOU DON'T OWN THAT EVENT!"]);
        }

    }
        






?>





















/*
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if(isset($_SESSION["user_id"])
    {
        if(!isset($_GET["map"])
        {
            render("message.php", ["message" => "Missing URL map parameter!"]);
        }else{
            render("new_event_form.php");
        }
    }else{
        render("message.php", ["message" => "You must login to view this form."]);
    }
} */

// if user reached page via POST
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    /**
      * First we'll make sure all required fields were filled out 
    **/
    $reqFields = array('name','lat','lon','day','hour','address','description','minRequired','maxAllowed');

    // Error to flag any empty req fields
    $reqError = false;
    // String to store error details
    $reqErrorList;
    foreach ($reqFields as $a) { 
        if(!isset($_POST[$a]) || empty($_POST[$a])) {
            // Add to error string, telling each req field that was left blank
            $reqErrorList .= $a . ' is a required field<br />';
            $reqError = true;
        }
    }

    //combine user entry for date and time into one field
    $userDateTime = $_POST["day"] . " " . $_POST["hour"];
    
    //replace / with - for MySQL purposes
    str_replace("/","-",$userDateTime);

    //define status of event based on whether new event has enought people attending
    if($_POST["minRequired"] <= 1)
    {
        $status = "active";
    }else{
        $status = "pending";
    }

    //if they are missing something give them a hint on the form
    if ($reqError) { 
        render("new_event_form.php", ["errorStack" => $reqErrorList]);
    }

    //else OK to proceed with queries
    else {

        try {
            //insert event
            $create = $pdo->prepare("INSERT INTO event(user_id,name,lat,lon,eventTime,address,description,category,status,minRequired,maxAllowed) VALUES(?,?,?,?,?,?,?,?,?,?,?)")
                          ->execute(array($_SESSION["user_id"],$_POST["name"],$_POST["lat"],$_POST["lon"],$userDateTime,$_POST["address"],$_POST["description"],$_POST["category"],$status,$_POST["minRequired"],$_POST["maxAllowed"]));
        }
        catch (PDOException $e) {
            if ($e->getCode() == 1062) {
            // Take some action if there is a key constraint violation, i.e. duplicate name. This should not happen
            render("message.php", ["message" => "Problem assigning event id"]);
            } 
            else {
                throw $e;
            }
        }

        //record event id in temp variable
        $event_id = $pdo->lastInsertId();

        //add user and event id to attendance table
        try {
            $create2 = $pdo->prepare("INSERT INTO attendance(user_id,event_id) VALUES(?,?)")
                              ->execute(array($_SESSION["user_id"],$event_id));
        }
        catch(PDOException $f) {
            throw $f;
        }

        //success!
        render("message.php", ["message" => "Event created!", "id" => $event_id]);
    }

}


?>
