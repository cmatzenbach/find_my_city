<?php 

include("../private/helpers.php");
require_once("../private/sql.php");

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
    $query = $pdo->prepare('SELECT email FROM user WHERE email = :email');
    $query->bindParam(':email', $email);
    $query->execute();
    $userExists = $query->fetch(PDO::FETCH_ASSOC);
    $conn = null;

    if ($userExists["email"])
    {
        // Create a unique salt. This will never leave PHP unencrypted.
        $salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

        // Create the unique user password reset key
        $password = hash('sha512', $salt.$userExists["email"]);

        // Create a url which we will direct them to reset their password
        $pwrurl = "https://findmy.city/reset_password.php?q=".$password;

        // Mail them their key
        $mailbody = "Dear user,\n\nIf this e-mail does not apply to you please ignore it. It appears that you have requested a password reset at our website findmy.city\n\nTo reset your password, please click the link below. If you cannot click it, please paste it into your web browser's address bar.\n\n" . $pwrurl . "\n\nThanks,\nYour Friendly Developers";
        mail($userExists["email"], "findmy.city - Password Reset", $mailbody);
        echo "Your password recovery key has been sent to your e-mail address.";
    }
    else
        echo "No user with that e-mail address exists.";
} 

?>