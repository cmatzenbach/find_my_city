<<<<<<< HEAD
<?php 

require_once("../private/helpers.php");
require("../private/sql.php");

// if user reached page via GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    render("register_form.php");
}

// if user reached page via POST
else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /**
      * First we'll make sure all required fields were filled out 
    **/
    $reqFields = array('email', 'username', 'first', 'last', 'password');

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
    $userCheck->execute(array($_POST["username"]));    
    // RESUME

    if ($reqError) { 
        render("error.php", ["error" => $reqErrorList]);
    }

    /**
      * Next check if username already exists (using query executed above)
    **/
    else if ($userResult = $userCheck->fetch()) {
        render("error.php", ["error" => "Username already exists"]);
    }

    /**
      * If all good, go ahead and make account
    **/
    else {

        try {
            $create = $pdo->prepare("INSERT INTO user(email,displayName,first,last,carrier,mobile) VALUES(?,?,?,?,?,?)")
                          ->execute(array($_POST["email"], $_POST["username"], $_POST["first"], $_POST["last"], $_POST["carrier"], $_POST["mobile"]));
        }
        catch (PDOException $e) {
            if ($e->getCode() == 1062) {
            // Take some action if there is a key constraint violation, i.e. duplicate name
            render("error.php", ["error" => "Username already exists"]);
            } 
            else {
                throw $e;
            }
        }

        render("success.php", ["success" => "Account created!"]);
    }

}

<<<<<<< HEAD
=======

=======
<?php

//include helper file
include("../private/helpers.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php");
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        print("POST NOT COOL BRO!");
    }
>>>>>>> c6e0c883afd3603ef60056530dfb87a242c18018
>>>>>>> master
?>