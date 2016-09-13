<?php 

include("../private/helpers.php");
require_once("../private/sql.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    render("forgot_password_form.php");
}

else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather the post data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["password2"];
    $hash = $_POST["q"];

    // Use the same salt from the forgot_password.php file
    $salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

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
            echo "Your password has been successfully reset.";
        }
        else
            echo "Your password's do not match.";
    }
    else
        echo "Your password reset key is invalid.";

}

?>