<?php 

require_once("../private/helpers.php");
require("../private/sql.php");

// if user reached page via GET
/*if ($_SERVER["REQUEST_METHOD"] == "GET") {
    render("register_form.php");
}

// if user reached page via POST
else if ($_SERVER["REQUEST_METHOD"] == "POST") {*/
    
    $login = $pdo->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
    $login->execute(array($_POST["email"], $_POST["password"])); 
    
    // get first column of resulting row, in this case id - if not blank, login successful
    $status = $login->fetchColumn();
    if ($status) {
        $_SESSION["user_id"] = $status;
        render("message.php", ["message" => "Welcome back!"]);
    } 
    else {
        render("message.php", ["message" => "Your username or password is incorrect. Please try again"]);
    }
//}

?>