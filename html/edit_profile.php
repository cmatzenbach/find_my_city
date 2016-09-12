<?php 

require_once("../private/helpers.php");
require("../private/sql.php");
require("carriers.php");

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

    // make array to keep track of changes and counter to see if changes were made
    $changes = [];
    $nochange = 0;

    foreach ($_POST as $key => $value) {
        // If data in POST is different from data in db
        if ($value != $userData[$key]) {
            // If it's the password being changed, make sure it's not blank and make sure it matches password confirm
            if ($key == "password" && $value == $_POST["password2"] && $value != '') {
                $changes["password"] = $value;
                $nochange++;
            }
            // If password doesn't match
            else if ($key == "password" && $value != $_POST["password2"]) {
                render("message.php", ["message" => "Password does not match. Please try again."]);
            }
            // If password is blank
            else if ($key == "password" && $value == $_POST["password2"] && $value == '') {
                continue;
            }
            // If username and not already taken
            else if ($key == "displayName" && $_POST["usernameTaken"] == 0) {
                $changes["displayName"] = $value;
                $nochange++;
            }
            // If carrier doesn't match then update'
            else if ($key == "carrier" && $carriers[$value] != $userData[$key]) {
                $changes["carrier"] = $carriers[$value];
                $nochange++;
            }
            // If not a special case, and data was changed, save in db
            else if ($key == "mobile" || $key == "first" || $key == "last" || $key == "email") {
                $changes[$key] = $value;
                $nochange++;
            }
            // If none of these apply, do nothing
            else {
                continue;
            }
        }
    }

    if ($nochange == 0) {
        render("message.php", ["message" => "You didn't modify anything!  No changes made.", "data" => $changes]);
    }
    else {
        render("message.php", ["message" => "Account changed! Changes below:", "data" => $changes]);
    }
}




?>
