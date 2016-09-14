<?php 

include("../private/helpers.php");
require_once("../private/sql.php");
require_once("../private/spice.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    render("reset_password_form.php");
}

else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather the post data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["password2"];
    $hash = $_POST["q"];

    // Generate the reset key
    $resetkey = hash('sha512', $salt.$email);

    // Does the new reset key match the old one?
    if ($resetkey == $hash)
    {
        if ($password == $confirmpassword)
        {
            //has and secure the password
            $password = hash('sha512', $salt.$password);

            // Update the user's password
                $query = $pdo->prepare('UPDATE user SET password = :password WHERE email = :email');
                $query->bindParam(':password', $password);
                $query->bindParam(':email', $email);
                $query->execute();
                $conn = null;
            render("message.php", ["message" => "Your password has been successfully reset."]);
        }
        else
            render("message.php", ["message" => "Your passwords do not match."]);
    }
    else
        render("message.php", ["message" => "Your password reset key is invalid."]);

}

?>