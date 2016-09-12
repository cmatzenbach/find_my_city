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
            // If username and not already taken
            if ($key == "displayName" && $_POST["usernameTaken"] == 0) {
                $changes["displayName"] = $value;
                $nochange++;
            }
            // If username is already taken and they ignore warning
            else if ($key == "displayName" && $_POST["usernameTaken"] == 1) {
                render("message.php", "Username already taken. Please try again");
            }
            // If carrier doesn't match then update
            else if ($key == "carrier" && $value != $userData[$carrier]) {
                $changes["carrier"] = $value;
                $nochange++;
            }
            // If not a special case, and data was changed, save in db
            else if ($key == "mobile" || $key == "first" || $key == "last" || $key == "email") {
                $changes[$key] = $value;
                $nochange++;
            }
            // If none of these apply, do nothing
            else {}
        }
    }

    // prepare dynamic set values for query
    $set = "";
    foreach($changes as $key => $value) {
        $set .= $key . " = ?, ";
    }
    // remove comma and space from end of last query value
    $set = substr($set, 0, -2);
    
    // prepare dynamic array of changed values for query
    $queryarr = []; $z = 0;
    foreach ($changes as $value) {
        $queryarr[$z] = $value;
        $z++;
    }
    // add id to end of query for WHERE parameter
    $queryarr[$z] = $_SESSION["user_id"];

    if ($nochange == 0) {
        render("message.php", ["message" => "You didn't modify anything!  No changes made.", "data" => $changes]);
    }
    else {
        // finally, let's run our dynamically constructed query
        $query = $pdo->prepare("UPDATE user SET " . $set . " WHERE id = ?");
        $query->execute($queryarr);
        render("message.php", ["message" => "Profile modified!"]);
    }
}




?>
