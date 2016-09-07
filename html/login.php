<?php 

require_once("../private/helpers.php");
require("../private/sql.php");

// if user reached page via GET
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    render("register_form.php");
}

// if user reached page via POST
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $pdo->prepare("SELECT * FROM user WHERE email = ?");
    $login->execute(array($_POST["username"])); 
}

?>