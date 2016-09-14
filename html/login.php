<?php 

session_start();

require_once("../private/helpers.php");
require_once("../private/sql.php");
require_once("../private/spice.php");

// secure the password
$password = hash('sha512', $salt.$_POST["password"]);

$login = $pdo->prepare("SELECT * FROM user WHERE email = ? AND password = ?");
$login->execute(array($_POST["email"], $password)); 

// get first column of resulting row, in this case id - if not blank, login successful
$status = $login->fetch(PDO::FETCH_ASSOC);

if ($status) {
    $_SESSION["user_id"] = $status["id"];
    render("message.php", ["message" => "Welcome back! You are now logged in."]);
} 
else {
    render("message.php", ["message" => "Your username or password is incorrect. Please try again"]);
}


?>