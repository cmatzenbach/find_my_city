<!-- Google Maps Javascript API -->
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyD9P8DYB0zXsO4NfnnqrX8zeofdyK5OegA'></script>

<!-- https://github.com/Logicify/jquery-locationpicker-plugin/ -->
<script src="/js/locationpicker.jquery.min.js"></script>



<link rel="stylesheet" href="/css/jquery.periodpicker.min.css">
<link rel="stylesheet" href="/css/jquery.timepicker.min.css">
<script src="/js/jquery.periodpicker.full.min.js"></script>
<script src="/js/jquery.timepicker.min.js"></script>


<div id="containz">
<?php print_r($userData); ?>
<h1>Edit Profile</h1>
<h3>Because we all change...</h3>
    <form id="newUserRegForm" data-parsley-validate="" action="edit_profile.php" method="POST">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"  placeholder="Email Address" value="<?= $userData['email'] ?>" required="">
        <small id="emailHelp" class="form-text text-muted">We will protect your email address as if it were our own.</small>
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="usernameHelp"   placeholder="Change Username" value="<?= $userData['displayName'] ?>" required="">
        <small id="usernameHelp" class="form-text text-muted">Your username will be displayed to the public.</small>
      </div>
      <div class="form-group">
        <label for="first">First name</label>
        <input type="text" class="form-control" id="first" name="first"  placeholder="First name" value="<?= $userData['first'] ?>" required="">
      </div>
      <div class="form-group">
        <label for="last">Last name</label>
        <input type="text" class="form-control" id="last" name="last" placeholder="Last name" value="<?= $userData['last'] ?>" required="">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern="^([a-zA-Z0-9@*#]{8,30})$" required="">
        <small id="passwordHelp" class="form-text text-muted">Password must be between 8 and 30 characters.</small>
      </div>

      <div class="form-group">
        <label for="mobile">Mobile Phone</label>
        <input type="tel" class="form-control" id="mobile" name="mobile"aria-describedby="mobileHelp" placeholder="Mobile Phone" value="<?= $userData['mobile'] ?>" pattern="^\d{10}$">
        <small id="mobileHelp" class="form-text text-muted">OPTIONAL: Enter your 10 digit mobile number <em>without dashes or spaces</em>.</small>
      </div>

    <div class="form-group">
        <label for="carrier">Select Wireless Carrier</label>
      <select class="form-control" id="carrier" name="carrier" aria-describedby="carrierHelp">
            <option value=''>-- Select One --</option>
            <option value='sms_carriers__us__alltel'>Alltel</option>
            <option value='sms_carriers__us__alaska_communications'>Alaska Communications</option>
            <option value='sms_carriers__us__assurance_wireless'>Assurance Wireless</option>
            <option value='sms_carriers__us__at_and_t'>AT&T Wireless</option>
            <option value='sms_carriers__us__bluegrass'>Bluegrass Cellular</option>
            <option value='sms_carriers__us__bluesky'>Bluesky Communications</option>
            <option value='sms_carriers__us__blueskyfrog'>BlueSkyFrog</option>
            <option value='sms_carriers__us__boostmobile'>Boost Mobile</option>
            <option value='sms_carriers__us__cellcom'>Cellcom</option>
            <option value='sms_carriers__us__cellularsouth'>Cellular South</option>
            <option value='sms_carriers__us__centennial_wireless'>Centennial Wireless</option>
            <option value='sms_carriers__us__chariton_valley'>Chariton Valley Wireless</option>
            <option value='sms_carriers__us__chat_mobility'>Chat Mobility</option>
            <option value='sms_carriers__us__cincinnati_bell'>Cincinnati Bell</option>
            <option value='sms_carriers__us__cingular'>Cingular (Postpaid)</option>
            <option value='sms_carriers__us__cleartalk'>Cleartalk Wireless</option>
            <option value='sms_carriers__us__comcast_pcs'>Comcast PCS</option>
            <option value='sms_carriers__us__cricket'>Cricket</option>
            <option value='sms_carriers__us__cspire'>C Spire Wireless</option>
            <option value='sms_carriers__us__dtc_wireless'>DTC Wireless</option>
            <option value='sms_carriers__us__element'>Element Mobile</option>
            <option value='sms_carriers__us__esendex'>Esendex</option>
            <option value='sms_carriers__us__general_comm'>General Communications Inc.</option>
            <option value='sms_carriers__us__golden_state'>Golden State Cellular</option>
            <option value='sms_carriers__us__google_voice'>Google Voice</option>
            <option value='sms_carriers__us__greatcall'>GreatCall</option>
            <option value='sms_carriers__us__helio'>Helio</option>
            <option value='sms_carriers__us__kajeet'>Kajeet</option>
            <option value='sms_carriers__us__longlines'>LongLines</option>
            <option value='sms_carriers__us__metro_pcs'>Metro PCS</option>
            <option value='sms_carriers__us__nextech'>Nextech</option>
            <option value='sms_carriers__us__pioneer'>Pioneer Cellular</option>
            <option value='sms_carriers__us__psc_wireless'>PSC Wireless</option>
            <option value='sms_carriers__us__rogers_wireless'>Rogers Wireless</option>
            <option value='sms_carriers__us__qwest'>Qwest</option>
            <option value='sms_carriers__us__simple_mobile'>Simple Mobile</option>
            <option value='sms_carriers__us__solavei'>Solavei</option>
            <option value='sms_carriers__us__south_central'>South Central Communications</option>
            <option value='sms_carriers__us__southernlink'>Southern Link</option>
            <option value='sms_carriers__us__sprint'>Sprint PCS</option>
            <option value='sms_carriers__us__straight_talk'>Straight Talk</option>
            <option value='sms_carriers__us__syringa'>Syringa Wireless</option>
            <option value='sms_carriers__us__t_mobile'>T-Mobile</option>
            <option value='sms_carriers__us__teleflip'>Teleflip</option>
            <option value='sms_carriers__us__ting'>Ting</option>
            <option value='sms_carriers__us__tracfone'>Tracfone</option>
            <option value='sms_carriers__us__telus_mobility'>Telus Mobility</option>
            <option value='sms_carriers__us__unicel'>Unicel</option>
            <option value='sms_carriers__us__us_cellular'>US Cellular</option>
            <option value='sms_carriers__us__usa_mobility'>USA Mobility</option>
            <option value='sms_carriers__us__verizon_wireless'>Verizon Wireless</option>
            <option value='sms_carriers__us__viaero'>Viaero</option>
            <option value='sms_carriers__us__virgin_mobile'>Virgin Mobile</option>
            <option value='sms_carriers__us__voyager_mobile'>Voyager Mobile</option>
            <option value='sms_carriers__us__west_central'>West Central Wireless</option>
            <option value='sms_carriers__us__xit_comm'>XIT Communications</option>
          </select>
          <small id="carrierHelp" class="form-text text-muted">Please select your mobile carrier. (Optional)</small>
      </div>

      <button type="submit" class="btn btn-primary">Update Account</button>
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
