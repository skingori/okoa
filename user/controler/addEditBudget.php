<?php
require_once('../connection/db.php');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addBudget'])) {
    $userId = $con->query("SELECT id FROM users WHERE email = '$_SESSION[email]'")->fetchColumn();
    if ($userId) {
        $budget_user_id = $userId;
        $budgetName = $_POST['budget_name'];
        $budgetAmount = $_POST['budget_amount'];
        $budgetOccurence = $_POST['budget_occurence'];
        $budgetStatus = $_POST['budget_status'];
        $budgetReminderStatus = $_POST['budget_reminder_status'];
        $budgetExpireDate = $_POST['budget_expire_date'];
        $budgetCreatedAt = $_POST['budget_created_at'];
        $budgetDescription = $_POST['budget_description'];

        $insert = $con->query("INSERT INTO budget (budget_user_id, budget_name, budget_amount, budget_occurence, budget_status, budget_reminder_status, budget_expire_date, budget_description, budget_created_at) VALUES ('$budget_user_id', '$budgetName', '$budgetAmount', '$budgetOccurence', '$budgetStatus', '$budgetReminderStatus', '$budgetExpireDate', '$budgetDescription', '$budgetCreatedAt')");

        if ($insert) {
            $_SESSION['message'] = "Budget added successfully";
            $_SESSION['message_type'] = "success";

        } else {
            $_SESSION['message'] = "An error occurred. Please try again";
            $_SESSION['message_type'] = "error";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editBudget'])) {
    $editID = $_GET['budgetID'];
    $budgetName = $_POST['budget_name'];
    $budgetAmount = $_POST['budget_amount'];
    $budgetOccurence = $_POST['budget_occurence'];
    $budgetStatus = $_POST['budget_status'];
    $budgetReminderStatus = $_POST['budget_reminder_status'];
    $budgetExpireDate = $_POST['budget_expire_date'];
    $budgetCreatedAt = $_POST['budget_created_at'];
    $budgetDescription = $_POST['budget_description'];


    $update = $con->query("UPDATE budget SET budget_name = '$budgetName', budget_amount = '$budgetAmount', budget_occurence = '$budgetOccurence', budget_status = '$budgetStatus', budget_reminder_status = '$budgetReminderStatus', budget_expire_date = '$budgetExpireDate', budget_description = '$budgetDescription' WHERE id = '$editID'");

    if ($update) {
        $_SESSION['message'] = "Budget updated successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "An error occurred. Please try again";
        $_SESSION['message_type'] = "error";
    }
}