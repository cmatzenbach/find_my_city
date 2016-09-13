<div class="modal-body">

<form action="index.php" method="POST">

    <div class="form-group">
        <label for="category">Filter By Event Category</label>
        <select class="form-control" id="category" name="category" aria-describedby="categoryHelp">
            <option value=''>-- Display All --</option>
            <option value='basketball'>Basketball</option>
            <option value='beach'>Beach</option>
            <option value='baseball'>Baseball</option>
            <option value='basketball'>Bowling</option>
            <option value='cultural'>Cultural</option>
            <option value='cycling'>Cycling</option>
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
          <small id="categoryHelp" class="form-text text-muted">Please select a category to filter by.</small>
      </div>

      <div class="form-group">
        <label for="status">Filter By Event Status</label>
        <select class="form-control" id="status" name="status" aria-describedby="categoryHelp">
            <option value=''>-- Display All --</option>
            <option value='pending'>Pending</option>
            <option value='active'>Active</option>
            <option value='full'>Full</option>
        </select>
        <small id="categoryHelp" class="form-text text-muted">Please select a category to filter by.</small>
     </div>

     <input type="hidden" name="mode" id="mode" value="updateFilters" />

     <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    <div id="filter-load"></div>
</form>

</div>
<style>.modal-footer { display:none }</style>
<script>
    function prepopulateFilters() {
      if ($("#filter-load").is(":visible")) {
 
          // Get variables that will pre-populate filter selections
          <?php 
          print("var filterCategory = \"" . $_SESSION["category"] . "\";");
          print("var filterStatus = \"" . $_SESSION["status"] . "\";");
          ?>

          if (filterCategory) {
            var categoryNode = document.getElementById('category');
            var opts = categoryNode.options;
            for (var opt, j = 0; opt = opts[j]; j++) {
                if (opt.value == filterCategory) {
                    categoryNode.selectedIndex = j;
                    break;
                }
            }
          }
          if (filterStatus) {
            var statusNode = document.getElementById('status');
            var opts2 = statusNode.options;
            for (var opt2, h = 0; opt2 = opts2[h]; h++) {
                if (opt2.value == filterStatus) {
                    statusNode.selectedIndex = h;
                    break;
                }
            }
          }
      }
    else {
        setTimeout(prepopulateFilters, 50); //wait 50 ms, then try again
    }
    }

    jQuery(document).ready(function() {
        prepopulateFilters();
    });
</script>