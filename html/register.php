<?php 

require_once("../private/helpers.php");
require("../private/sql.php");

// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // else render form
    render("register_form.php");
}

// else if user reached page via POST (as by submitting a form via POST)
else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userCheck = $pdo->prepare("SELECT * FROM user WHERE displayName = ?");

    $reqFields = array('email', 'username', 'first', 'last', 'password');

    $error = false; //No errors yet
    foreach($reqFields AS $a) { //Loop trough each field
    if(!isset($_POST[$a]) || empty($_POST[$a])) {
        echo 'Field '.$a.' misses!<br />'; //Display error with field
        $error = true; //Yup there are errors
    }
    }

    if(!$error) { //Only create queries when no error occurs
    //Create queries....
    }

    if ($userCheck->execute(array($_POST["username"])) === 1) {
        render("error.php", ["error"=>"Username already exists"]);
    }

    else if (!$_POSt["username"] || )

    $test->execute(array($id));
    $data = $test->fetchAll(PDO::FETCH_ASSOC);

    // username and password don't already exist
    // required fields

    print_r($data);
}


?>