<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyD9P8DYB0zXsO4NfnnqrX8zeofdyK5OegA'></script>
<script src="/js/locationpicker.jquery.min.js"></script>

<div id="containz">
<h1>hey it's a div</h1>
    <div class="form-horizontal" style="width: 550px; margin: 0 auto;">
        <div class="form-group">
            <label class="col-sm-2 control-label">Location:</label>

            <div class="col-sm-10">
                <input type="text" class="form-control" id="us3-address" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Radius:</label>

            <div class="col-sm-5">
                <input type="hidden" class="form-control" id="us3-radius" value="0" />
            </div>
        </div>
        <div id="us3" style="width: 550px; height: 400px;"></div>
        <div class="clearfix">&nbsp;</div>
        <div class="m-t-small">
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
        <script>
            $('#us3').locationpicker({
                location: {
                    latitude: 46.15242437752303,
                    longitude: 2.7470703125
                },
                radius: 300,
                inputBinding: {
                    latitudeInput: $('#us3-lat'),
                    longitudeInput: $('#us3-lon'),
                    radiusInput: 0,
                    locationNameInput: $('#us3-address')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    // Uncomment line below to show alert on each Location Changed event
                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });
        </script>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>    <br>
    <br>
    <br>
    <br>
    <br>    <br>
    <br>
    <br>
    <br>
    <br>
<style>
body {
    background:#990099;
    overflow:visible !important;
}
</style>