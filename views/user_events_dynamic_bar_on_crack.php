<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Events<span class="caret"></span></a>
    <ul class="dropdown-menu">
        <li id="createNewEvent"><a href="javascript:;">Create a New Event</a></li>

<?php


    if(isset($_GET["mode"])
    {

    if($_GET["mode"] != "reglogin")
    {

    if(!empty($_SESSION["user_id"])) {

        require_once(__DIR__ . "/../private/helpers.php");
        require_once(__DIR__ . "/../private/sql.php"); 
        

        //get all users events
        $navbarPDO1 = $pdo->prepare("SELECT attendance.event_id, event.name FROM attendance INNER JOIN event ON attendance.event_id=event.id WHERE attendance.user_id = ?");
        $navbarPDO1->execute(array($_SESSION["user_id"]));
        $userAttendingEvents = $navbarPDO1->fetchAll(PDO::FETCH_ASSOC);

        if(count($userAttendingEvents) > 0){

            print('<li role="separator" class="divider"></li><li class="dropdown-header">Events I\'m Attending</li>');
        
            foreach($userAttendingEvents as $userAttendingEvent){

                print('<li onClick="eventInfoModal(');
                echo $userAttendingEvent["event_id"];
                print(')"><a href="#">');
                echo $userAttendingEvent["name"];
                print("</a>");

            }

        }

        $navbarPDO2 = $pdo->prepare("SELECT id, name FROM event WHERE user_id = ?");
        $navbarPDO2->execute(array($_SESSION["user_id"]));
        $userOwnedEvents = $navbarPDO2->fetchAll(PDO::FETCH_ASSOC);

        if(count($userOwnedEvents) > 0) {

            print('<li role="separator" class="divider"></li>');
            print('<li class="dropdown-header">Manage My Events</li>');

        
            foreach($userOwnedEvents as $userOwnedEvent){

                print('<li onClick="eventManageModal(');
                echo $userOwnedEvent["id"];
                print(')"><a href="#">');
                echo $userOwnedEvent["name"];
                print("</a>");

            }

        }
  
    }

}

?>

     </ul>
</li>