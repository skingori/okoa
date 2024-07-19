<?php
require('../connection/db.php');
include('sessionAction.php');
sessionDestory();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_ = $con->query("SELECT * FROM users WHERE email = '$email'");
    if ($check_->rowCount() > 0) {
        $user = $check_->fetch(PDO::FETCH_ASSOC);
        if ($user['password'] == md5($password)) {
            createIssetSession("Login successful", "success");
            createIssetSession($user['name'], "name");
            createIssetSession($user['email'], "email");
            header('Location: ../user/index.php');
        } else {
            createIssetSession("Incorrect password/username", "error");
            header('Location: ../index.php');
        }
    } else {
        createIssetSession("Account does not exist, create account!", "error");
        header('Location: ../register.php');
    }
}
?>