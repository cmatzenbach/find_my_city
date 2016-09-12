
<br><br><br><br><br><br><br>

<div class="modal-dialog modal-sm" style="color:initial">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="x close" data-dismiss="modal">
    <span aria-hidden="true">&nbsp;</span>
    <span class="sr-only done">Got it 2!</span></button>
    <h4 class="modal-title">Hey There... <small></small></h4></div>
        <div class="modal-body"><?= $message ?></div>
        <?php 
            if ($data) { 
                echo '<div class=\'modal-body\'>';
                foreach ($data as $key => $value) {
                    if ($key != "chris-log") {
                        echo $key . ': ' . $value . '<br />';
                    }
                }
                echo '</div>';
            }
        ?>
        <div class="modal-footer">
        <button class="x btn btn-info" data-dismiss="modal" type="button" id="okDoneBro">Ok, Great!</button>
        </div>
    </div></div>
    <script type="text/javascript">
     jQuery("#okDoneBro").click( function(){
         window.location.replace("https://findmy.city");

     });
</script>
<style>
body {
    background:#990099;
}
</style>