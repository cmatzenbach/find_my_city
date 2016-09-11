<?php 

require_once("../private/helpers.php");
require("../private/sql.php");

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

    // steps:
    // see what has changed
    print_r($userData);
    // if changing username, make sure username doesn't already exist
    // if changing password, need to add in repeat password and confirmation
    // mobile phone pre-populate?

    // PAUSE - need to prepare query for second check
    $userCheck = $pdo->prepare("SELECT * FROM user WHERE displayName = ?");
    $userCheck->execute(array($_POST["username"]));    
    // RESUME

    if ($reqError) { 
        render("message.php", ["message" => $reqErrorList]);
    }

    /**
      * Next check if username already exists (using query executed above)
    **/
    else if ($userResult = $userCheck->fetch()) {
        render("message.php", ["message" => "Username already exists"]);
    }

    /**
      * If all good, go ahead and make account
    **/
    else {

        try {
            $create = $pdo->prepare("INSERT INTO user(email,password,displayName,first,last,carrier,mobile) VALUES(?,?,?,?,?,?,?)")
                          ->execute(array($_POST["email"], $_POST["password"], $_POST["username"], $_POST["first"], $_POST["last"], $_POST["carrier"], $_POST["mobile"]));
        }
        catch (PDOException $e) {
            if ($e->getCode() == 1062) {
            // Take some action if there is a key constraint violation, i.e. duplicate name
            render("message.php", ["message" => "Username already exists"]);
            } 
            else {
                throw $e;
            }
        }

        render("message.php", ["message" => "Account created!"]);
    }

}


?>
