<?php

// +------------------------+-------------------------------------------+------+-----+-------------------+-------------------+
// | Field                  | Type                                      | Null | Key | Default           | Extra             |
// +------------------------+-------------------------------------------+------+-----+-------------------+-------------------+
// | id                     | int                                       | NO   | PRI | NULL              | auto_increment    |
// | budget_user_id         | int                                       | NO   | MUL | NULL              |                   |
// | budget_name            | varchar(100)                              | NO   |     | NULL              |                   |
// | budget_amount          | decimal(10,2)                             | NO   |     | NULL              |                   |
// | budget_occurence       | enum('daily','weekly','monthly','yearly') | NO   |     | NULL              |                   |
// | budget_status          | enum('active','inactive')                 | NO   |     | NULL              |                   |
// | budget_reminder_status | enum('active','inactive')                 | NO   |     | NULL              |                   |
// | budget_expire_date     | date                                      | YES  |     | NULL              |                   |
// | budget_description     | text                                      | YES  |     | NULL              |                   |
// | budget_created_at      | timestamp                                 | YES  |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
// +------------------------+-------------------------------------------+------+-----+-------------------+-------------------+

require_once('../connection/db.php');
session_start();

// if($_SERVER["REQUEST_METHOD"] == "POST") {
//     $userId = $con->query("SELECT id FROM users WHERE email = '$_SESSION[email]'")->fetchColumn();
//     if ($userId) {
//         $budget_user_id = $userId;
//         $budgetName = $_POST['budget_name'];
//         $budgetAmount = $_POST['budget_amount'];
//         $budgetOccurence = $_POST['budget_occurence'];
//         $budgetStatus = $_POST['budget_status'];
//         $budgetReminderStatus = $_POST['budget_reminder_status'];
//         $budgetExpireDate = $_POST['budget_expire_date'];
//         $budgetDescription = $_POST['budget_description'];

//         $insert = $con->query("INSERT INTO budget (budget_user_id, budget_name, budget_amount, budget_occurence, budget_status, budget_reminder_status, budget_expire_date, budget_description) VALUES ('$budget_user_id', '$budgetName', '$budgetAmount', '$budgetOccurence', '$budgetStatus', '$budgetReminderStatus', '$budgetExpireDate', '$budgetDescription')");

//         if ($insert) {
//             $_SESSION['message'] = "Budget added successfully";
//             $_SESSION['message_type'] = "success";
//             header('Location: ../user/addBudget.php');
//         } else {
//             $_SESSION['message'] = "An error occurred. Please try again";
//             $_SESSION['message_type'] = "error";
//             header('Location: ../user/addBudget.php');
//         }
//     }
// }
?>