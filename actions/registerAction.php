<?php

require('../connection/db.php');
include('sessionAction.php');
sessionDestory();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['firstName'] . " " . $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];

    $check_ = $con->query("SELECT * FROM users WHERE email = '$email'");
    if ($check_->rowCount() > 0) {
        createIssetSession("Email already taken", "error");
        header('Location: ../register.php');
    } else {
        if ($password != $repeatPassword) {
            createIssetSession("Passwords do not match", "error");
            header('Location: ../register.php');
        } else {
            $password_ = md5($password);
            $insert = $con->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password_')");
            if ($insert) {
                createIssetSession("Account created successfully", "success");
                header('Location: ../index.php');
            } else {
                createIssetSession("An error occurred. Please try again", "error");
                header('Location: ../register.php');
            }
        }
    }
    
}