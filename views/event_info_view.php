<div class="modal-body">

<style>
.modal-header { display: none;}
</style>
    <h1 style="margin-top:0px;"><?php echo $data["name"]; ?></h1>
    <?php if($data["user_id"] == $_SESSION["user_id"]) {
        print('<span style="float:right"><button type="submit" id="editEventButton" class="btn btn-primary">Edit Event</button></span>');
    }
    
    if(isset($_SESSION["user_id"]))
    {
        print('<button type="submit" id="rsvpNo" class="btn btn-primary">RSVP YES</button> <button type="submit" id="rsvpYes" class="btn btn-primary">RSVP NO</button>');

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
      <p><strong>Category:</strong> <img src="https://findmy.city/img/<?php echo $data["category"]; ?>.png"></p>
      <p><strong>Posted By:</strong> <?= $owner["displayName"] ?></p>

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
</script>

<style>
body {
    background:#990099;
    overflow:scroll !important;
}
</style>
