<!-- Google Maps Javascript API -->
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyD9P8DYB0zXsO4NfnnqrX8zeofdyK5OegA'></script>

<!-- https://github.com/Logicify/jquery-locationpicker-plugin/ -->
<script src="/js/locationpicker.jquery.min.js"></script>


<div id="containz">
    <h1>Edit Event Details</h1>
    <h4>NOTE: You are not allowed to edit an event's location or time after it has been created.</h4>
    <div style="color:red"> 
    <?php 
    if(!empty($errorStack))
    {
        print("<strong>Please correct the following errors:</strong><br>");
        echo $errorStack;
    }
    ?>
    </div>
    <form action='edit_event_details.php?map=pkr&e_id=<?= $eventData["id"] ?>' method="POST">

    <input type="hidden" value='<?= $eventData["id"] ?>' name="id" />

    <div class="form-horizontal" style="width: 80%; margin: 0 auto;">
      <div class="form-group">
        <label for="eventName">Event Name</label>
        <input type="text" class="form-control" id="eventName" name="name" aria-describedby="eventNameHelp" value='<?= $eventData["name"] ?>' required="">
        <small id="eventNameHelp" class="form-text text-muted">Choose something catchy &amp; fun!</small>
      </div>

     <div class="form-group">
        <label for="carrier">Select Event Category</label>
      <select class="form-control" id="category" name="category" required="" aria-describedby="categoryHelp">
            <option value=''>-- Select One --</option>
            <option value='basketball'>Basketball</option>
            <option value='beach'>Beach</option>
            <option value='baseball'>Baseball</option>
            <option value='cycling'>Cycling</option>
            <option value='basketball'>Bowling</option>
            <option value='cultural'>Cultural</option>
            <option value='football'>Football</option>
            <option value='frisbee'>Frisbee</option>
            <option value='jobs'>Job Fair</option>
            <option value='musicplay'>Music (playing instruments)</option>
            <option value='musiclisten'>Music (appreciation/concerts)</option>
            <option value='party'>Party</option>
            <option value='picnic'>Picnic</option>
            <option value='political'>Political</option>
            <option value='random'>Random</option>
            <option value='religious'>Religious</option>  
            <option value='study'>Study Group</option>
            <option value='tabletop'>Tabletop Games</option>
            <option value='technology'>Technology</option>
            <option value='tennis'>Tennis</option>
            <option value='volleyball'>Volleyball</option>
            <option value='weightlifting'>Weight Lifting</option>
            <option value='yoga'>Yoga</option>
            <option value='other'>Other</option>
          </select>
          <small id="categoryHelp" class="form-text text-muted">Please select a category for this event. The category you choose will determine which icon your event will use on the map.</small>
      </div>
<script>
      $( document ).ready(function() {
    $("#category").val('<?= $eventData["category"] ?>');    
});
</script>

      <div class="form-group">
        <label for="eventDescription">Description</label>
        <textarea class="form-control" rows="3" id="eventDescription" name="description" aria-describedby="descriptionHelp" required=""><?= $eventData["description"] ?></textarea>
        <small id="descriptionHelp" class="form-text text-muted">Describe your event thoroughly so that people can determine if they would like to attend.</small>
      </div>
    <div class="form-group">
        <label for="minNum">Minimum # of Attendees</label>
        <input class="form-control" type="number" min="1" step="1" id="minNum" name="minRequired" required="" value='<?= $eventData["minRequired"] ?>' aria-describedby="minHelp">
        <small id="minHelp" class="form-text text-muted">Enter the minimum number of attendees that your event needs in order to occur. Enter 1 if you're (This is typically used for team sports)</small>
    </div>
    <div class="form-group">
        <label for="minNum">Maximum # of Attendees</label>
        <input class="form-control" type="number" min="1" step="1" id="minNum" required="" name="maxAllowed" value='<?= $eventData["maxAllowed"] ?>' aria-describedby="maxHelp">
        <small id="maxHelp" class="form-text text-muted">Enter the maximum number of people you wish to attend your event.</small>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>

    </div>

<style>
body {
    background:#990099;
    overflow:scroll !important;
}
</style>
