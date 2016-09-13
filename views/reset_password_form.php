<div id="containz">

<h1>Reset Password</h1>
<h3>You're almost there</h3>

    <form id="reset-password-form" data-parsley-validate="" action="reset_password.php" method="POST">

      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"  placeholder="Email Address" required="">
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" pattern="^([a-zA-Z0-9@*#]{8,30})$">
        <small id="passwordHelp" class="form-text text-muted">Password must be between 8 and 30 characters. Please re-type below to confirm</small>
      </div>

      <div class="form-group">
        <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password" pattern="^([a-zA-Z0-9@*#]{8,30})$">
      </div>

      <?php 
      echo '<input type="hidden" name="q" value="';
      if (isset($_GET["q"])) {
          echo $_GET["q"];
      }
      echo '" />';
      ?>
    
      <button type="submit" id="resetPassword" class="btn btn-primary">Reset Password</button>
    </form>

</div>

<style>
body {
    background:#990099;
    overflow:scroll !important;
}
</style>
