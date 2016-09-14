<?php 

include("../private/helpers.php");
require_once("../private/sql.php");
require_once("../private/spice.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    render("forgot_password_form.php");
}

else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST["email"];
    }
    else {
        echo "Email is not valid";
        exit;
    }

    // Check to see if a user exists with this e-mail
    $query = $pdo->prepare('SELECT * FROM user WHERE email = :email');
    $query->bindParam(':email', $email);
    $query->execute();
    $userExists = $query->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if ($userExists["email"] && $_POST["last"] == $userExists["last"])
    {   
        // Create the unique user password reset key
        $password = hash('sha512', $salt.$userExists["email"]);

        // Create a url which we will direct them to reset their password
        $pwrurl = "https://findmy.city/reset_password.php?q=".$password;

        // Mail them their key
        $mailbody = "Dear " . $userExists['first'] . ",\n\nYou are receiving this email because you requested to reset your password for findmy.city.  To reset your password, please click the link below. If you cannot click the link, please paste it into your web browser's address bar.\n\n" . $pwrurl . "\n\nThanks,\nYour Friendly Developers";
        mail($userExists["email"], "findmy.city - Password Reset", $mailbody);
        render("message.php", ["message" => "Your password recovery key has been sent to your e-mail address."]);
    }
    else if ($_POST["last"] != $userExists["last"]) {
        render("message.php", ["message" => "No user exists with that e-mail address."]);
    }
    
    else {
        render("message.php", ["message" => "No user exists with that e-mail address."]);
    }
} 

?>