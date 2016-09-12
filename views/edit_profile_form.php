<!-- Google Maps Javascript API -->
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyD9P8DYB0zXsO4NfnnqrX8zeofdyK5OegA'></script>

<!-- https://github.com/Logicify/jquery-locationpicker-plugin/ -->
<script src="/js/locationpicker.jquery.min.js"></script>

<!-- Carriers object for matching db data to id of <option> -->
<script src="/js/carriers.js"></script>

<div id="containz">
<h1>Edit Profile</h1>
<h3>Because we all change...</h3>
    <form id="newUserRegForm" data-parsley-validate="" action="edit_profile.php" method="POST">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"  placeholder="Email Address" value="<?= $userData['email'] ?>">
        <small id="emailHelp" class="form-text text-muted">We will protect your email address as if it were our own.</small>
      </div>
      <div class="form-group">
        <label for="displayName">Username</label>
        <input type="text" class="form-control" id="displayName" name="displayName" aria-describedby="usernameHelp"   placeholder="Change Username" value="<?= $userData['displayName'] ?>">
        <small id="usernameHelp" class="form-text text-muted"></small>
      </div>
      <div class="form-group">
        <label for="first">First name</label>
        <input type="text" class="form-control" id="first" name="first"  placeholder="First name" value="<?= $userData['first'] ?>">
      </div>
      <div class="form-group">
        <label for="last">Last name</label>
        <input type="text" class="form-control" id="last" name="last" placeholder="Last name" value="<?= $userData['last'] ?>">
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
            <option value='sms_carriers__us__alltel' id='alltel'>Alltel</option>
            <option value='sms_carriers__us__alaska_communications' id='alaska_communications'>Alaska Communications</option>
            <option value='sms_carriers__us__assurance_wireless' id='assurance_wireless'>Assurance Wireless</option>
            <option value='sms_carriers__us__at_and_t' id='at_and_t'>AT&T Wireless</option>
            <option value='sms_carriers__us__bluegrass' id='bluegrass'>Bluegrass Cellular</option>
            <option value='sms_carriers__us__bluesky' id='bluesky'>Bluesky Communications</option>
            <option value='sms_carriers__us__blueskyfrog' id='blueskyfrog'>BlueSkyFrog</option>
            <option value='sms_carriers__us__boostmobile' id='boostmobile'>Boost Mobile</option>
            <option value='sms_carriers__us__cellcom' id='cellcom'>Cellcom</option>
            <option value='sms_carriers__us__cellularsouth' id='cellularsouth'>Cellular South</option>
            <option value='sms_carriers__us__centennial_wireless' id='centennial_wireless'>Centennial Wireless</option>
            <option value='sms_carriers__us__chariton_valley' id='chariton_valley'>Chariton Valley Wireless</option>
            <option value='sms_carriers__us__chat_mobility' id='chat_mobility'>Chat Mobility</option>
            <option value='sms_carriers__us__cincinnati_bell' id='cincinnati_bell'>Cincinnati Bell</option>
            <option value='sms_carriers__us__cingular' id='cingular'>Cingular (Postpaid)</option>
            <option value='sms_carriers__us__cleartalk' id='cleartalk'>Cleartalk Wireless</option>
            <option value='sms_carriers__us__comcast_pcs' id='comcast_pcs'>Comcast PCS</option>
            <option value='sms_carriers__us__cricket' id='cricket'>Cricket</option>
            <option value='sms_carriers__us__cspire' id='cspire'>C Spire Wireless</option>
            <option value='sms_carriers__us__dtc_wireless' id='dtc_wireless'>DTC Wireless</option>
            <option value='sms_carriers__us__element' id='element'>Element Mobile</option>
            <option value='sms_carriers__us__esendex' id='esendex'>Esendex</option>
            <option value='sms_carriers__us__general_comm' id='general_comm'>General Communications Inc.</option>
            <option value='sms_carriers__us__golden_state' id='golden_state'>Golden State Cellular</option>
            <option value='sms_carriers__us__google_voice' id='google_voice'>Google Voice</option>
            <option value='sms_carriers__us__greatcall' id='greatcall'>GreatCall</option>
            <option value='sms_carriers__us__helio' id='helio'>Helio</option>
            <option value='sms_carriers__us__kajeet' id='kajeet'>Kajeet</option>
            <option value='sms_carriers__us__longlines' id='longlines'>LongLines</option>
            <option value='sms_carriers__us__metro_pcs' id='metro_pcs'>Metro PCS</option>
            <option value='sms_carriers__us__nextech' id='nextech'>Nextech</option>
            <option value='sms_carriers__us__pioneer' id='pioneer'>Pioneer Cellular</option>
            <option value='sms_carriers__us__psc_wireless' id='psc_wireless'>PSC Wireless</option>
            <option value='sms_carriers__us__rogers_wireless' id='rogers_wireless'>Rogers Wireless</option>
            <option value='sms_carriers__us__qwest' id='qwest'>Qwest</option>
            <option value='sms_carriers__us__simple_mobile' id='simple_mobile'>Simple Mobile</option>
            <option value='sms_carriers__us__solavei' id='solavei'>Solavei</option>
            <option value='sms_carriers__us__south_central' id='south_central'>South Central Communications</option>
            <option value='sms_carriers__us__southernlink' id='southernlink'>Southern Link</option>
            <option value='sms_carriers__us__sprint' id='sprint'>Sprint PCS</option>
            <option value='sms_carriers__us__straight_talk' id='straight_talk'>Straight Talk</option>
            <option value='sms_carriers__us__syringa' id='syringa'>Syringa Wireless</option>
            <option value='sms_carriers__us__t_mobile' id='t_mobile'>T-Mobile</option>
            <option value='sms_carriers__us__teleflip' id='teleflip'>Teleflip</option>
            <option value='sms_carriers__us__ting' id='ting'>Ting</option>
            <option value='sms_carriers__us__tracfone' id='tracfone'>Tracfone</option>
            <option value='sms_carriers__us__telus_mobility' id='telus_mobility'>Telus Mobility</option>
            <option value='sms_carriers__us__unicel' id='unicel'>Unicel</option>
            <option value='sms_carriers__us__us_cellular' id='us_cellular'>US Cellular</option>
            <option value='sms_carriers__us__usa_mobility' id='usa_mobility'>USA Mobility</option>
            <option value='sms_carriers__us__verizon_wireless' id='verizon_wireless'>Verizon Wireless</option>
            <option value='sms_carriers__us__viaero' id='viaero'>Viaero</option>
            <option value='sms_carriers__us__virgin_mobile' id='virgin_mobile'>Virgin Mobile</option>
            <option value='sms_carriers__us__voyager_mobile' id='voyager_mobile'>Voyager Mobile</option>
            <option value='sms_carriers__us__west_central' id='west_central'>West Central Wireless</option>
            <option value='sms_carriers__us__xit_comm' id='xit_comm'>XIT Communications</option>
          </select>
          <small id="carrierHelp" class="form-text text-muted">Please select your mobile carrier. (Optional)</small>
      </div>

      <p><strong>Change Password</strong><br />To change your password, please type your new password below, and then confirm in the next field.  Once you submit, your password will be automatically changed.  Passwords are case-sensative and must be between 8 and 30 characters.</p>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern="^([a-zA-Z0-9@*#]{8,30})$">
        <small id="passwordHelp" class="form-text text-muted">Password must be between 8 and 30 characters. Please re-type below to confirm</small>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password" pattern="^([a-zA-Z0-9@*#]{8,30})$">
      </div>
	    <input type="hidden" name="usernameTaken" id="usernameTaken" value="0" />

      <button type="submit" id="submitChangeForm" class="btn btn-primary">Ch-ch-change Me</button>
    </form>

<style>
body {
    background:#990099;
    overflow:scroll !important;
}
</style>

<script>
	// Pre-populate selected carrier
	document.addEventListener('DOMContentLoaded', function() {
    	var selectedCarrier = carriers['<?php echo $userData["carrier"]; ?>']; 
		  document.getElementById(selectedCarrier).selected = true;
	});
	var displayNameNode = $('#displayName');
	displayNameNode.on('input', function(e) {
		if (displayNameNode.val().length) {
			var ajaj = new XMLHttpRequest();
			ajaj.onreadystatechange = function() {
				if(ajaj.readyState == 4 && ajaj.status == 200) {
					if (ajaj.response[0] == undefined) {
						$('#usernameHelp').html("<div class=\'uname_available\'>Username is available!</div>");
						$('#usernameTaken').val('0');
					}
					else if (typeof(ajaj.response[0]) == "object") {
						$('#usernameHelp').html("<div class=\'uname_unavailable\'>Username is not available</div>");
						$('#usernameTaken').val('1');
					}
					else {
						$('#usernameHelp').html("Error");
					}
				}
			};
			var url = "username_query.php?displayName=" + this.value;
			ajaj.responseType = 'json';
			ajaj.open("GET",url,true);
			ajaj.send();
		}
		else { 
			$('#usernameHelp').html("");
		}
	});
</script>