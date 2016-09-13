<div id="containz">

<h1>Forgot Password</h1>
<h3>We've all been there</h3>

    <form id="forgot-password-form" data-parsley-validate="" action="forgot_password.php" method="POST">

      <div class="form-group">
        <label for="last">Last name</label>
        <input type="text" class="form-control" id="last" name="last" placeholder="Last name">
      </div>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"  placeholder="Email Address" required="">
      </div>
    
      <button type="submit" id="submitPassRecovery" class="btn btn-primary">Next</button>
    </form>

</div>

<style>
body {
    background:#990099;
    overflow:scroll !important;
}
</style>
