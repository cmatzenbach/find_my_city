<div id="containz">
<h1><?= $displayName ?>'s Event Dashboard</h1>

<?php

        if(count($userAttendingEvents) > 0){

            print('<h3>Events You\'re Attending</h3><ul class="dashboard">');
        
            foreach($userAttendingEvents as $userAttendingEvent){

                print('<li onClick="eventInfoModal(');
                echo $userAttendingEvent["event_id"];
                print(')"><a href="#">');
                echo $userAttendingEvent["name"];
                print("</a>");

            }
            print("</ul>");
        }


         if(count($userOwnedEvents) > 0) {

            print('<h3>Events You\'ve Created</h3><ul class="dashboard">');

        
            foreach($userOwnedEvents as $userOwnedEvent){

                print('<li onClick="eventManageModal(');
                echo $userOwnedEvent["id"];
                print(')"><a href="#">');
                echo $userOwnedEvent["name"];
                print("</a>");

            }

            print("</ul>");

        }
?>
      


</div>

<style>
body {
    background:#990099;
    overflow:scroll !important;
}
</style>