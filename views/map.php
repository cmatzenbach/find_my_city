     <div class="panel-body map-panel">
            <!-- fill viewport -->
            <div class="container-fluid">
                <!-- https://developers.google.com/maps/documentation/javascript/tutorial -->
                <div id="map-canvas"></div>
            </div>
    </div>
    
        <script type="text/javascript">
        $("li").click(function(e) {
            e.preventDefault();
            $("li").removeClass("selected");
            $(this).addClass("selected");
        });
        </script>
