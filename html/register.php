<?php 

require_once("../private/helpers.php");
require("../private/sql.php");

// if user reached page via GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    print_r("GETTIN");
    render("register_form.php");
}

// if user reached page via POST
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r("POSTIN");

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
    $userResult = $userCheck->execute(array($_POST["username"]));
    // RESUME

    if ($error) { 
        render("error.php", ["error" => $reqErrorList]);
    }

    /**
      * Next check if username already exists (using query executed above)
    **/
    else if ($userResult === 1) {
        render("error.php", ["error" => "Username already exists"]);
    }

    /**
      * If all good, go ahead and make account
    **/
    else {

        print_r("ALL GOOD");

        /*$test->execute(array($id));
        $data = $test->fetchAll(PDO::FETCH_ASSOC);

        print_r($data);*/
    }

}


?>