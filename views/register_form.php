<form id="newUserRegForm">
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email Address">
    <small id="emailHelp" class="form-text text-muted">We will protect your email address as if it were our own.</small>
  </div>
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Create a Username">
    <small id="usernameHelp" class="form-text text-muted">Your username will be displayed to the public.</small>
  </div>
  <div class="form-group">
    <label for="first">First name</label>
    <input type="text" class="form-control" id="first" placeholder="First name">
  </div>
  <div class="form-group">
    <label for="last">Last name</label>
    <input type="text" class="form-control" id="last" placeholder="Last name">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="confirmpassword">Re-Enter Password</label>
    <input type="password" class="form-control" id="confirmpassword" placeholder="Type Password Again">
  </div>

  <div class="form-group">
    <label for="mobile">Mobile Phone</label>
    <input type="tel" class="form-control" id="mobile" aria-describedby="mobileHelp" placeholder="Mobile Phone">
    <small id="mobileHelp" class="form-text text-muted">Enter your mobile number. (Optional)</small>
  </div>

<div class="form-group">
    <label for="carrier">Select Wireless Carrier</label>
  <select multiple class="form-control" id="carrier" aria-describedby="carrierHelp">
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

  <button type="submit" class="btn btn-primary">Create Account</button>
</form>