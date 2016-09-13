<div class="modal-body">

<style>
.modal-header { display: none;}
</style>
    <h1 style="margin-top:0px;">Edit"<?= $eventData["name"] ?>"</h1>
   
<div class="row">
    <div class="col-sm-4">
        <a href='https://findmy.city/edit_event_details.php?e_id=<?php echo $eventData["id"]; ?>'><button class="btn btn-primary">Edit Event Details</button></a>
    </div>
    <div class="col-sm-4">
        Edit Event Location
     </div>
    <div class="col-sm-4">
        Cancel Event
    </div>
</div>


<style>
body {
    background:#990099;
    overflow:scroll !important;
}
</style>
