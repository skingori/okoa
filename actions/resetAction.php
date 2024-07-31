<?php
// reset password action

require('../connection/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];

    $check_ = $con->query("SELECT * FROM users WHERE email = '$email'");
    if ($check_->rowCount() > 0) {
        if ($password != $repeatPassword) {
            createIssetSession("Passwords do not match", "error");
            header('Location: ../reset.php');
        } else {
            $password_ = md5($password);
            $update = $con->query("UPDATE users SET password = '$password_' WHERE email = '$email'");
            if ($update) {
                createIssetSession("Password reset successful", "success");
                header('Location: ../index.php');
            } else {
                createIssetSession("An error occurred. Please try again", "error");
                header('Location: ../reset.php');
            }
        }
    } else {
        createIssetSession("Account does not exist, create account!", "error");
        header('Location: ../register.php');
    }
}