<?php

require_once('../connection/db.php');

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addExpense'])) {
    $userId = $con->query("SELECT id FROM users WHERE email = '$_SESSION[email]'")->fetchColumn();
    if ($userId) {
        $expense_user_id = $userId;
        $expenseName = $_POST['expense_name'];
        $expenseAmount = $_POST['expense_amount'];
        $expenseCategory = $_POST['expense_category'];
        $expenseBudget = $_POST['budget_id'];
        $expenseCreatedAt = $_POST['expense_created_at'];
        $expenseDescription = $_POST['expense_description'];

        $insert = $con->query("INSERT INTO expenses (expense_user_id, expense_name, expense_amount, expense_category_name, expense_budget_id, expense_description, expense_created_at) VALUES ('$expense_user_id', '$expenseName', '$expenseAmount', '$expenseCategory', '$expenseBudget', '$expenseDescription', '$expenseCreatedAt')");

        if ($insert) {
            $_SESSION['message'] = "Expense added successfully";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "An error occurred. Please try again";
            $_SESSION['message_type'] = "error";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editExpense'])) {
    $editID = $_GET['expenseID'];
    $expenseName = $_POST['expense_name'];
    $expenseAmount = $_POST['expense_amount'];
    $expenseCategory = $_POST['expense_category'];
    $expenseBudget = $_POST['budget_id'];
    $expenseDescription = $_POST['expense_description'];

    $update = $con->query("UPDATE expenses SET expense_name = '$expenseName', expense_amount = '$expenseAmount', expense_category_name = '$expenseCategory', expense_budget_id = '$expenseBudget', expense_description = '$expenseDescription' WHERE id = '$editID'");

    if ($update) {
        $_SESSION['message'] = "Expense updated successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "An error occurred. Please try again";
        $_SESSION['message_type'] = "error";
    }
}
?>