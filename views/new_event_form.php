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
    <form action="new_event.php" method="POST">
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
                <input type="text" class="form-control" style="width: 110px" id="us3-lat" />
            </div>
            <label class="p-r-small col-sm-2 control-label">Long.:</label>

            <div class="col-sm-3">
                <input type="text" class="form-control" style="width: 110px" id="us3-lon" />
            </div>
        </div>

      <div class="clearfix"></div>

      <div class="form-group">
        <label for="daterr">Event Start Date</label>
      	<input id="daterr" type="text" class="form-control" required=""/>
      </div>

      <div class="form-group">
        <label for="sTime">Event Start Time</label>
      	<input id="sTime" class="form-control" value="16:20:00" type="text" required=""/>
      </div>

        <div class="form-group">
        <label for="carrier">Select Event Type</label>
      <select class="form-control" id="category" name="category" required="" aria-describedby="categoryHelp">
            <option value=''>-- Select One --</option>
            <option value='academic'>Academic</option>
            <option value='cultural'>Cultural</option>            
            <option value='game'>Game (non-sport)</option>
            <option value='language'>Language/Translation</option>
            <option value='music'>Music</option>
            <option value='party'>Party</option>
            <option value='sport'>Sport</option>
            <option value='technology'>Technology</option>
            <option value='weird'>Weird/Random</option>
          </select>
          <small id="categoryHelp" class="form-text text-muted">Please select a category for this event.</small>
      </div>

      <div class="form-group">
        <label for="eventDescription">Description</label>
        <textarea class="form-control" rows="3" id="eventDescription" name="eventDescription" aria-describedby="descriptionHelp" placeholder="A great event.." required=""></textarea>
        <small id="descriptionHelp" class="form-text text-muted">Describe your event thoroughly so that people can determine if they would like to attend.</small>
      </div>
    <div class="form-group">
        <label for="minNum">Minimum # of Attendees</label>
        <input class="form-control" type="number" value="0" id="minNum" name="min" aria-describedby="minHelp">
        <small id="minHelp" class="form-text text-muted">If your event requires that a minimum number of people to attend, enter the number here. Zero = No Minimum.</small>
    </div>
    <div class="form-group">
        <label for="minNum">Maximum # of Attendees</label>
        <input class="form-control" type="number" value="0" id="minNum" name="max" aria-describedby="maxHelp">
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
