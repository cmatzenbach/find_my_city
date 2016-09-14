<div class="modal-body">

<style>
.modal-header { display: none;}
</style>
    <h1 style="margin-top:0px;">Edit Event</h1>
    <h4><?= $eventData["name"] ?></h4>

    
<script>
var options = {
        message: "Are you SUPER SURE you want to delete the event?",
        title: 'DELETE EVENT',
        size: eModal.size.xl,
        subtitle: 'smaller text header',
        label: "True"   // use the positive label as key
        ...
    };

    function delete()
    {
        var deleteurl = 'https://findmy.city/delete_event.php?eid=<?= $eventData["id"] ?>';
        window.location.href = deleteurl;
    }
    function donothing()
    {
        console.log('doing nothing');
    }
</script>

<div class="row">
    <div class="col-sm-4">
        <a href='https://findmy.city/edit_event_details.php?e_id=<?php echo $eventData["id"]; ?>'><button class="btn btn-primary">Edit Event Details</button></a>
    </div>
    <div class="col-sm-4">
       <button id="emailAttendees" class="btn btn-primary" onClick="eModal.alert('This feature is not available just yet, but it will be ready very soon!!');">Email Attendees</button></a>
    </div>
    <div class="col-sm-4">
        <button id="cancelEvent" class="btn btn-primary" onClick="eModal.confirm(options)  .then(delete, donothing);">Cancel Event</button></a>
    </div>
</div>

<style>
body {
    background:#990099;
    overflow:scroll !important;
}
</style>