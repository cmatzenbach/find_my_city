<?php 

session_start();

require_once("../private/helpers.php");
require_once("../private/sql.php");
require_once("../private/spice.php");

// if user reached page via GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    render("register_form.php");
}

// if user reached page via POST
else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /**
      * First we'll make sure all required fields were filled out 
    **/
    $reqFields = array('email', 'displayName', 'first', 'last', 'password');

    // Error to flag any empty req fields
    $reqError = false;
    // String to store error details
    $reqErrorList;
    foreach ($reqFields as $a) { 
        if(!isset($_POST[$a]) || empty($_POST[$a])) {
            // Add to error string, telling each req field that was left blank
            $reqErrorList .= $a . ' is a required field<br />';
            $reqError = true;
        }
    }

    // PAUSE - need to prepare query for second check
    $userCheck = $pdo->prepare("SELECT * FROM user WHERE displayName = ?");
    $userCheck->execute(array($_POST["displayName"]));    
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

        // secure the password
        $password = hash('sha512', $salt.$_POST["password"]);

        try {
            $create = $pdo->prepare("INSERT INTO user(email,password,displayName,first,last,carrier,mobile) VALUES(?,?,?,?,?,?,?)")
                          ->execute(array($_POST["email"], $password, $_POST["displayName"], $_POST["first"], $_POST["last"], $_POST["carrier"], $_POST["mobile"]));
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

        $_SESSION["user_id"] = $pdo->lastInsertId();
        render("message.php", ["message" => "Account created!", "id" => $_SESSION["user_id"]]);
    }

}


?>
