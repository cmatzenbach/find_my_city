<?php 

require_once("../private/helpers.php");
require_once("../private/sql.php");
require_once("../private/spice.php");

$user = $pdo->prepare("SELECT * FROM user WHERE id = ?");
$user->execute(array($_SESSION["user_id"])); 
// get first column of resulting row, in this case id - if not blank, login successful
$userData = $user->fetch();

// if user reached page via GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if ($userData) {
         render("edit_profile_form.php", ["userData" => $userData]);
    } 
    else {
        render("message.php", ["message" => "Profile error. Please make sure you are logged in and try again"]);
    }
   
}

// if user reached page via POST
else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["password"])) {
        // get hashed password
        $password = hash('sha512', $salt.$_POST["password"]);
        if ($password != $userData["password"]) {
            // If it's being changed, make sure it's not blank and make sure it matches password confirm
            if ($_POST["password"] == $_POST["password2"] && $_POST["password"] != '') {
                $change = $pdo->prepare("UPDATE user SET password = ? WHERE id = ?")->execute(array($password, $_SESSION["user_id"]));
                render("message.php", ["message" => "Password changed!"]);
            }
            // If password doesn't match
            else if ($_POST["password"] != $_POST["password2"]) {
                render("message.php", ["message" => "Password does not match. Please try again."]);
            }
            // Only thing left should be if it is blank (empty string)
            else {
                render("message.php", ["message" => "Don't be lazy! Your password can't be blank. Please try again."]);
            }
        }
        // userdata.password (current password) == $post.password, meaning they submitted the same pw again
        else {
            render("message.php", ["message" => "Password was the same as your previous password. No changes made."]);
        }
    }
    // $post.password is not set somehow
    else {
        render("message.php", ["message" => "An error occurred. Please go back and try again, or <a href=\'mailto:cmatzenbach@gmail.com\'>contact</a> the devs for help."]);
    }

}


?>
