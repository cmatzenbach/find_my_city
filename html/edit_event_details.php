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
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $reqFields = array('id','name','description','minRequired','maxAllowed');

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
        if($reqError){
            render("edit_event_details_form.php", ["errorStack" => $reqErrorList]);
            exit;
        }

        //query database to verify owner of event   
        $idcheck = $pdo->prepare("SELECT * FROM event WHERE id = ?");
        $idcheck->execute(array($_GET["e_id"]));
        $eventInfo = $idcheck->fetch(PDO::FETCH_ASSOC);
        if($eventInfo["user_id"] !== $_SESSION["user_id"]){
             render("message.php", ["message" => "HEY YOU CANT UPDATE AN EVENT THAT DOESN'T BELONG TO YOU. And even if you could, that would kinda be a dick move, don't ya think?"]);
             exit;
        }

        if($_POST["minRequired"] >= $_POST["maxAllowed"]){
            render("message.php", ["message" => "The minimum number of required attendees must be less than or equal to the maximum allowed."]);
            exit;
        }

        //update values
        $update1 = $pdo->prepare("UPDATE event SET name = ?, description = ?, category = ?, minRequired = ?, maxAllowed = ? WHERE id = ?");
        $update1->execute(array($_POST["name"],$_POST["description"],$_POST["category"],$_POST["minRequired"],$_POST["maxAllowed"],$_POST["id"]));
    
        
        //query the database to determine the new number of attendees
        $pull2 = $pdo->prepare("SELECT * FROM attendance WHERE event_id = ?");
        $pull2->execute(array($_GET["e_id"]));
        $eventAttendance = $pull2->fetchAll(PDO::FETCH_ASSOC);
        $eventCount = count($eventAttendance);
        
        //if the number of attendees is between min required and max allowed set status active
        if($eventCount >= $eventInfo["minRequired"] && $eventCount < $eventInfo["maxAllowed"])
        {
            $q5 =  $pdo->prepare("UPDATE event SET status='active' WHERE id=?");
                $q5->execute(array($_GET["e_id"]));

        //else if event has less than minimum required set status pending
        }elseif($eventCount < $eventInfo["minRequired"])
        {
                $q6 =  $pdo->prepare("UPDATE event SET status='pending' WHERE id=?");
                $q6->execute(array($_GET["e_id"]));

        //else if event has greater than or equal to the than max allowed set status full
        }elseif($eventCount >= $eventInfo["maxAllowed"])
        {
                $q7 =  $pdo->prepare("UPDATE event SET status='full' WHERE id=?");
                $q7->execute(array($_GET["e_id"]));
        }

        $message = '<strong>SUCCESS!</strong><br/>Your event, "' . $_POST["name"] . '" has been updated.';

        render("message.php", ["message" => $message]);
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
