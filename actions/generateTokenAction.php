<?php

require('../connection/db.php');
include('sessionAction.php');
sessionDestory();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $check_ = $con->query("SELECT * FROM users WHERE email = '$email'");
    $userID = $con->query("SELECT id FROM users WHERE email = '$email'")->fetchColumn();
    if ($check_->rowCount() > 0) {
        $token = md5($email . time());
        echo $token;
        $insert = $con->query("INSERT INTO reset_password (user_id, token, token_status) VALUES ('$userID', '$token', 'active')");
        if ($insert) {
            $link = "<a href='http://localhost:8080/okoa/confirm.php?token=$token'>Reset Password</a>";
            $to = $email;
            $subject = "Reset Password";
            $message = "Click the link below to reset your password: http://localhost/confirm.php?token=$token";
            $headers = "From: okoaadmin@okoa.co.ke" . "
            \r\n" .
                "CC:
            \r\n";
            mail($to, $subject, $message, $headers);
            // log email content to file
            $file = fopen("email.txt", "w");
            fwrite($file, $message);
            fclose($file);
            createIssetSession("Reset link sent to email \n". $link , "success");
            header('Location: ../reset.php');
        } else {
            createIssetSession("An error occurred. Please try again", "error");
            header('Location: ../reset.php');
        }
    } else {
        createIssetSession("Account does not exist, create account!", "error");
        header('Location: ../register.php');
    }
}
?>