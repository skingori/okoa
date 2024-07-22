<?php
// require the db connection
session_start();
require_once('../connection/db.php');

// get the id from the url parameter

$userId = $con->query("SELECT id FROM users WHERE email = '$_SESSION[email]'")->fetchColumn();

if (isset($_GET['categoryID'])) {
    $categoryID = $_GET['categoryID'];
    $deleteCategory = $con->query("DELETE FROM categories WHERE id = '$categoryID' AND category_user_id = '$userId'");

    if ($deleteCategory) {
        $_SESSION['message'] = "Category deleted successfully";
        $_SESSION['message_type'] = "success";
        header("Location: categories.php");
    } else {
        $_SESSION['message'] = "An error occurred. Please try again";
        $_SESSION['message_type'] = "error";
        header("Location: categories.php");
    }
}

if (isset($_GET['budgetID'])) {
    $budgetID = $_GET['budgetID'];
    $deleteBudget = $con->query("DELETE FROM budget WHERE id = '$budgetID' AND budget_user_id = '$userId'");

    if ($deleteBudget) {
        $_SESSION['message'] = "Budget deleted successfully";
        $_SESSION['message_type'] = "success";
        header("Location: budget.php");
    } else {
        $_SESSION['message'] = "An error occurred. Please try again";
        $_SESSION['message_type'] = "error";
        header("Location: budget.php");
    }
}

if (isset($_GET['expenseID'])) {
    $expenseID = $_GET['expenseID'];
    $deleteExpense = $con->query("DELETE FROM expenses WHERE id = '$expenseID' AND expense_user_id = '$userId'");

    if ($deleteExpense) {
        $_SESSION['message'] = "Expense deleted successfully";
        $_SESSION['message_type'] = "success";
        header("Location: expenses.php");
    } else {
        $_SESSION['message'] = "An error occurred. Please try again";
        $_SESSION['message_type'] = "error";
        header("Location: expenses.php");
    }
}
?>