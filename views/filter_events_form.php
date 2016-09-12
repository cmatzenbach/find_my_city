<div class="modal-body">

<form action="index.php" method="POST">

    <div class="form-group">
        <label for="carrier">Filter By Event Type</label>
        <select class="form-control" id="category" name="category" aria-describedby="categoryHelp">
            <option value=''>-- Select One --</option>
            <option value='basketball'>Basketball</option>
            <option value='beach'>Beach</option>
            <option value='baseball'>Baseball</option>
            <option value='bicycling'>Bicycling</option>
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
          <small id="categoryHelp" class="form-text text-muted">Please select a category to filter by.</small>
      </div>

      <div class="form-group">
        <label for="carrier">Filter By Event Status</label>
        <select class="form-control" id="status" name="status" aria-describedby="categoryHelp">
            <option value=''>-- Select One --</option>
            <option value='pending'>Pending</option>
            <option value='pending'>Active</option>
            <option value='pending'>Full</option>
        </select>
        <small id="categoryHelp" class="form-text text-muted">Please select a category to filter by.</small>
     </div>

     <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    
</form>

</div>
<style>.modal-footer { display:none }</style>