<!-- Google Maps Javascript API -->
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyD9P8DYB0zXsO4NfnnqrX8zeofdyK5OegA'></script>

<!-- https://github.com/Logicify/jquery-locationpicker-plugin/ -->
<script src="/js/locationpicker.jquery.min.js"></script>



<link rel="stylesheet" href="/css/jquery.periodpicker.min.css">
<link rel="stylesheet" href="/css/jquery.timepicker.min.css">
<script src="/js/jquery.periodpicker.full.min.js"></script>
<script src="/js/jquery.timepicker.min.js"></script>


<div id="containz">
    <h1>Create a new event!</h1>
    <h3>We'll put it on the map for everyone to see.</h3>
    <div style="color:red"> 
    <?php 
    if(!empty($errorStack))
    {
        print("<strong>Please correct the following errors:</strong><br>");
        echo $errorStack;
    }

    ?>
    </div>
    <form action="new_event.php?map=pkr" method="POST">
    <div class="form-horizontal" style="width: 80%; margin: 0 auto;">
      <div class="form-group">
        <label for="eventName">Event Name</label>
        <input type="text" class="form-control" id="eventName" name="name" aria-describedby="eventNameHelp"   placeholder="Event Name" required="">
        <small id="eventNameHelp" class="form-text text-muted">Choose something catchy &amp; fun!</small>
      </div>

      <div class="form-group">
        <label for="addressx">Event Location</label>
        <input type="text" class="form-control" id="addressx" name="address" aria-describedby="addressHelp"   placeholder="Event Address" required="">
        <small id="addressHelp" class="form-text text-muted">Please be sure to double check that the location shown in the map below is accurate.</small>
      </div>



        <div class="form-group hidden">

            <div class="col-sm-5">
                <input type="text" class="form-control" id="us3-radius" />
            </div>
        </div>
        <div id="eventPkrMap" style="width: 100%; height: 400px; margin: 0 auto;"></div>
        <div class="clearfix">&nbsp;</div>
        <div class="m-t-small hidden">
            <label class="p-r-small col-sm-1 control-label">Lat.:</label>

            <div class="col-sm-3">
                <input type="text" class="form-control" style="width: 110px" name="lat" id="us3-lat" />
            </div>
            <label class="p-r-small col-sm-2 control-label">Long.:</label>

            <div class="col-sm-3">
                <input type="text" class="form-control" style="width: 110px" name="lon" id="us3-lon" />
            </div>
        </div>

      <div class="clearfix"></div>

      <div class="form-group">
        <label for="daterr">Event Start Date</label>
      	<input id="daterr" type="text" aria=describedby="daterrHelp" class="form-control" name="day" required="" pattern="^(((19|2\d)\d{2}\/(((0?[13578]|1[02])\/31)|((0?[1,3-9]|1[0-2])\/(29|30))))|((((19|2\d)(0[48]|[2468][048]|[13579][26])|(2[048]00)))\/0?2\/29)|((19|2\d)\d{2})\/((0?[1-9])|(1[0-2]))\/(0?[1-9]|1\d|2[0-8]))$"/>
        <small id="daterrHelp" class="form-text text-muted">YYYY/MM/D (Year, Month, Day -- Logical progression from biggest to smallest size! Call us crazy, but we like this format!) </small>
      </div>

      <div class="form-group">
        <label for="sTime">Event Start Time</label>
      	<input id="sTime" class="form-control" value="16:20:00" name="hour" type="text" required=""/>
      </div>

        <div class="form-group">
        <label for="carrier">Select Event Type</label>
      <select class="form-control" id="category" name="category" required="" aria-describedby="categoryHelp">
            <option value=''>-- Select One --</option>
            <option value='basketball'>Basketball</option>
            <option value='beach'>Beach</option>
            <option value='baseball'>Baseball</option>
            <option value='bicycling'>Bicycling</option
            <option value='basketball'>Bowling</option>
            <option value='cultural'>Cultural</option>
            <option value='football'>Football</option>
            <option value='football'>Frisbee</option>
            <option value='jobs'>Job Fair</option>
            <option value='musicplay'>Music (playing instruments)</option>
            <option value='musiclisten'>Music (appreciation/concerts)</option>
            <option value='party'>Party</option>
            <option value='picnic'>Picnic</option>
            <option value='political'>Political</option>
            <option value='random'>Random</opt0ion>
            <option value='religious'>Religious</option>  
            <option value='study'>Study Group</option>
            <option value='tabletop'>Tabletop Games</option>
            <option value='technology'>Technology</option>
            <option value='tennis'>Tennis</option>
            <option value='tennis'>Volleyball</option>
            <option value='weightlifting'>Weight Lifting</option>
            <option value='yoga'>Yoga</option>
            <option value='other'>Other</option>
          </select>
          <small id="categoryHelp" class="form-text text-muted">Please select a category for this event. </small>
      </div>

      <div class="form-group">
        <label for="eventDescription">Description</label>
        <textarea class="form-control" rows="3" id="eventDescription" name="description" aria-describedby="descriptionHelp" required="" placeholder="A great event.."></textarea>
        <small id="descriptionHelp" class="form-text text-muted">Describe your event thoroughly so that people can determine if they would like to attend.</small>
      </div>
    <div class="form-group">
        <label for="minNum">Minimum # of Attendees</label>
        <input class="form-control" type="number" min="0" step="1" id="minNum" name="minRequired" required="" aria-describedby="minHelp">
        <small id="minHelp" class="form-text text-muted">If your event requires that a minimum number of people to attend, enter the number here. Zero = No Minimum.</small>
    </div>
    <div class="form-group">
        <label for="minNum">Maximum # of Attendees</label>
        <input class="form-control" type="number" min="0" step="1" id="minNum" required+"" name="maxAllowed" aria-describedby="maxHelp">
        <small id="maxHelp" class="form-text text-muted">Enter the maximum number of attendees. Zero = No Limit.</small>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>


<script>
            $('#eventPkrMap').locationpicker({
                location: {
                    latitude: 25.754326,
                    longitude:-79.729973
                },
                radius: 0,
                inputBinding: {
                    latitudeInput: $('#us3-lat'),
                    longitudeInput: $('#us3-lon'),
                    radiusInput: $('#us3-radius'),
                    locationNameInput: $('#addressx')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    // Uncomment line below to show alert on each Location Changed event
                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });

            
    jQuery('#daterr').periodpicker({
        norange:true,
        cells: [1,1],
        hideOnBlur: true,
        likeXDSoftDateTimePicker: true
    });
    

</script>
    </div>

<!-- begin time picker stuff -->
	<meta name="viewport" content="width=device-width,user-scalable=no" />
	<link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/jquery.timepicker.min.css">
	<script src="js/moment.min.js"></script>
	<script src="js/jquery.mousewheel.min.js"></script>
	<script src="build/jquery.timepicker.min.js"></script>
	<script>
	$('#sTime').TimePickerAlone({
		hours: true,
		minutes: true,
		seconds: false,
		ampm: true
	});
	window.onerror = function (m){
	alert(m)
	}

	</script>
<!-- end time picker stuff -->

<style>
body {
    background:#990099;
    overflow:scroll !important;
}
</style>
