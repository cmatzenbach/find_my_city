<div class="modal-body">

<style>
.modal-header { display: none;}
</style>
    <h1 style="margin-top:0px;"><?php echo $data["name"]; ?>  <img src="https://findmy.city/img/<?php echo $data["category"]; ?>.png"></h1>
    <?php 
    if(isset($_SESSION["user_id"]))
    {
        if($owner["id"] == $_SESSION["user_id"]) 
        {
            print('<span style="float:right"><button type="submit" id="editEventButton" class="btn btn-primary">Edit Event</button></span>');
        }

        if($data["status"] != "full")
        {
            print('<a href="https://findmy.city/rsvp.php?mode=Y&e_id=' . $data["id"] . '"><button type="submit" class="btn btn-primary">RSVP YES</button></a> <button type="submit" id="rsvpNo" class="btn btn-primary" onClick="RSVP(N)">RSVP NO</button>');
        }else{
            print('<h4>Sorry, this event cannot accept additional attendees!</h4>');
        }
    }else{
        print('<p><a href="javascript:;" class="navRegister">Login</a> to confirm attendance at the event. The event organizer may not accept unregistered guests.</p>');
    } ?>

    <script>
    /* Registration/login Popup */
$(".navRegister").click(function() {

	var options = {
			url: "renderstration.php",
			title:'Login/Register',
			size: 'xl',
			subtitle: 'Login is required to add new events, attend an event, etc.'
		};
	eModal.ajax(options);

});
</script>
  <div class="row">
    <div class="col-sm-4">
      <h3>What?</h3>
      <p><?= $data["description"] ?></p>

    </div>
    <div class="col-sm-4">
        <h3>When?</h3>
        <p><?php
            $thetime = strtotime($data["eventTime"]);
            $thetimeclean = date("m/d/y g:i A", $thetime);
            echo $thetimeclean;            
            ?></p>
    </div>
    <div class="col-sm-4">
        <h3>Where?</h3>
        <p><?= $data["address"]; ?></p>
    </div>
  </div>

  <div class="row">
  
    <div class="col-sm-4">
        <h3>Attending</h3>
        <p><strong><?= $attendeeCount ?> people have RSVP'd Yes:</strong>
        <ul>
        <?php 
        if($attendeeCount <= 50)
        {
            foreach($attendees as $attendee){
                print("<li>". $attendee . "</li>");
            }
        }else{
            print("</ul><p>There are over 50 attendees!You probably don't need to know their usernames, that would look terrible on the page!</p>");
        }?>
        </ul>
    </div>
    <div class="col-sm-4">
        <h3>Min/Max</h3>
        <p><?= $data["minRequired"] ?> / <?= $data["maxAllowed"] ?>
        <p><strong>Status:</strong></p>
        <p><?= $data["status"] ?></p>
    </div>
    <div class="col-sm-4">
      <h3>Posted By:</h3>
      <p><?= $owner["displayName"] ?></p>

    </div>


</div>

<script>
$("#editEventButton").click(function() {
	var options = {
			url: 'https://findmy.city/event_edit.php?e_id=<?= $data["id"] ?>',
			title:'Edit Event',
			size: 'xl',
			subtitle: ''
		};
	eModal.ajax(options);
});

function RSVP(yesorno) {
		newurl = 'https://findmy.city/rsvp.php?<?= $data["id"]?>&mode=' + yesorno;	
    	window.location.href = newurl;
}
</script>


<style>
body {
    background:#990099;
    overflow:scroll !important;
}
</style>
