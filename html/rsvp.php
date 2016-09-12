<?php 

require_once("../private/helpers.php");
require("../private/sql.php");

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
}

$eventQuery = $pdo->prepare("SELECT * FROM event WHERE id = ?");
$eventQuery->execute(array($_GET["e_id"]));
$eventInfo = $eventQuery->fetchAll(PDO::FETCH_ASSOC);
print("count is:" . count($eventInfo));
print_r($eventInfo);
 
if($_GET["mode"] == "Y")
{

    $q1 = $pdo->prepare("SELECT * FROM attendance WHERE user_id = ? AND event_id = ?");
    $q1->execute(array($_SESSION["user_id"], $_GET["e_id"])); 

    $rows = $q1->fetchAll(PDO::FETCH_ASSOC);

    print_r($rows);
    print("row count is " . count($rows));

    if(count($rows) > 0)
    {
        render("message.php", ["message" => "You were already registered for this event"]);
    }else {

        if(count($eventInfo) > 0 && $eventInfo[0]["status"] != "full")
        {
            print("got to part a");
            try{
                $q3 = $pdo->prepare("INSERT INTO attendance(user_id,event_id) VALUES(?,?)");
                $q3->execute(array($_SESSION["user_id"],$_GET["e_id"]));
            }catch(PDOException $e) {
                print("got to part b");
                throw $e;
            }

                print("got to part c");
            $q4 = $pdo->prepare("SELECT * FROM attendance WHERE id = ?");
            $q4->execute(array($_GET["e_id"]));
            $eventAttendance = $q4->fetchAll(PDO::FETCH_ASSOC);
            $eventCount = count($eventAttendance);
                print("got to part d");
            if($eventCount >= $eventInfo[0]["minRequired"] && $eventCount <= $eventInfo[0]["maxAllowed"])
            {
                                    print("got to part e");
                $q5 =  $pdo->prepare("UPDATE event SET status='active' WHERE id=?")
                    ->execute(array($_GET["e_id"]));
            }elseif($eventCount == $eventInfo[0]["maxAllowed"])
            {
                                    print("got to part f");
                $q6 =  $pdo->prepare("UPDATE event SET status='full' WHERE id=?")
                    ->execute(array($_GET["e_id"]));
            }

            print("got to part g");
            $message = "You are now attending " . $eventInfo[0]["name"];

            render("message.php", ["message" => $message]);

        }else {
            render("message.php", ["message" => "It looks like the event you're trying to RSVP for either doesn't exist or doesn't hava capacity for additional attendees."]);
        }

    }
}else{
    print("error y");
}


?>