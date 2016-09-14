
<div id="containz">
    <h1>Email Attendees</h1>
    <h3>Say something nice to the people attending <?= $eventInfo["name"] ?></h3>

<p>The subject of your message will be: FindMy.City | Message regarding <?= $eventInfo["name"]; ?></p>

    <form action='email_attendees.php?e_id=<?= $eventInfo["id"] ?>' method="POST">
    <div class="form-horizontal" style="width: 80%; margin: 0 auto;">

      <div class="form-group">
        <label for="message">Message</label>
        <textarea class="form-control" rows="10" id="eventDescription" name="message" aria-describedby="messageHelp" required="" placeholder="Say something nice.."></textarea>
        <small id="messageHelp" class="form-text text-muted">WARNING: If anyone complains about the message you send, you will be banned from this site FOR LIFE!</small>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Send</button>
    </div>
    </form>


</div>
<style>
body {
    background:#990099;
    overflow:scroll !important;
}
</style>
