<?php error_reporting(0); ?>
<br><br><br>

<?php echo "<form action=\"delete_event.php?e_id=" . $e_id . "\" method=\"POST\">"; ?>
<div class="modal-dialog modal-sm" style="color:initial">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="x close" data-dismiss="modal">
    <span aria-hidden="true">&nbsp;</span>
    <span class="sr-only done">Got it 2!</span></button>
    <h4 class="modal-title">Hey There... <small></small></h4></div>
        <div class="modal-body">Once you delete an event, it cannot be recovered.  You sure about this, Jack?</div>
        <div class="modal-footer">
        <button class="x btn btn-warning" data-dismiss="modal" type="submit">Yes, Delete</button>
        <button class="x btn btn-info" data-dismiss="modal" onclick="location.href='https://findmy.city'" type="button">Nevermind!</button>
        <div class="form-group">
        
    </div>
        </div>
    </div></div>
</form>
<style>
body {
    background:#990099;
}
</style>