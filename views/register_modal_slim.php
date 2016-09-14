 <div class="modal-body">
                <div class="row">
                    <div class="col-md-8" style="border-right: 1px dotted #C2C2C2;padding-right: 30px;">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#Login" data-toggle="tab">Login</a></li>
                            <li><a href="#Registration" data-toggle="tab">Registration</a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="Login">
                            
                                <!-- Begin form -->
                                <form role="form" class="form-horizontal" action="login.php?mode=reglogin" method="POST">
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">
                                        Email Address</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="loginPassword" name="email" placeholder="Email" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="loginPassword" class="col-sm-2 control-label">
                                        Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Password" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Submit</button>
                                        <div id="forgot-password" style="display:inline"><a href="javascript:;">Forgot your password?</a></div>
                                    </div>
                                </div>
                                </form>

                            </div>
                            <div class="tab-pane" id="Registration">
     <!-- REGISTRATION FORM -->                           
    <form id="newUserRegForm" data-parsley-validate="" action="register.php?mode=reglogin" method="POST">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"  placeholder="Email Address" required="">
        <small id="emailHelp" class="form-text text-muted">We will protect your email address as if it were our own.</small>
      </div>
      <div class="form-group">
        <label for="displayName">Username</label>
        <input type="text" class="form-control" id="displayName" name="displayName" aria-describedby="usernameHelp"   placeholder="Create a Username" required="">
        <small id="usernameHelp" class="form-text text-muted">Your username will be displayed to the public.</small>
      </div>
      <div class="form-group">
        <label for="first">First name</label>
        <input type="text" class="form-control" id="first" name="first"  placeholder="First name" required="">
      </div>
      <div class="form-group">
        <label for="last">Last name</label>
        <input type="text" class="form-control" id="last" name="last" placeholder="Last name" required="">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern="^([a-zA-Z0-9@*#]{8,30})$" required="">
        <small id="passwordHelp" class="form-text text-muted">Password must be between 8 and 30 characters.</small>
      </div>

      <div class="form-group">
        <label for="mobile">Mobile Phone</label>
        <input type="tel" class="form-control" id="mobile" name="mobile"aria-describedby="mobileHelp" placeholder="Mobile Phone"  pattern="^\d{10}$">
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
        <p>By clicking submit below you agree to the website terms of use.<br><br>
      <button type="submit" class="btn btn-primary">Create Account</button>
    </form>
    <!-- END REGISTRATION FORM -->
                            </div>
                        </div>
                        <div id="OR" class="hidden-xs">
                            OR</div>
                    </div>
                    <div class="col-md-4">
                        <div class="row text-center sign-with">
                            <div class="col-md-12">
                                <h3>
                                    Sign in with</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="btn-group btn-group-justified">
                                    <a href="#" class="btn btn-primary" onclick="eModal.alert('Login via Facebook is not available just yet. Check back soon!');">Facebook</a> <a href="#" onclick="eModal.alert('Login via Google is not available just yet. Check back soon!');" class="btn btn-danger">
                                        Google</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script>
            /* Forgot Password Form */
$("#forgot-password").click(function() {
	console.log("firing");
		newurl = 'https://findmy.city/forgot_password.php';	
    	window.location.href = newurl;
});
</script>