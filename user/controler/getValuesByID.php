<?php
require_once('../connection/db.php');
$userId = $con->query("SELECT id FROM users WHERE email = '$_SESSION[email]'")->fetchColumn();

// Get all the expeses from the database using the ID from url parameter

if(isset($_GET['expenseID'])){
    $expenseID = $_GET['expenseID'];
    $expensesQuery = "
        SELECT e.id, e.expense_name, e.expense_amount, e.expense_created_at,
            e.expense_category_name, b.budget_amount, e.expense_description
        FROM expenses AS e
        JOIN budget AS b ON e.expense_budget_id = b.id
        WHERE e.expense_user_id = $userId AND e.id = $expenseID;
    ";
    $expenses = $con->query($expensesQuery)->fetchAll(PDO::FETCH_ASSOC);
    foreach ($expenses as $expense) {
        $expenseName = $expense['expense_name'] ?? '';
        $expenseAmount = $expense['expense_amount'] ?? '';
        $expenseCategoryName = $expense['expense_category_name'] ?? '';
        $budgetAmount = $expense['budget_amount'] ?? '';
        $expenseDescription = $expense['expense_description'] ?? '';
    }
} else {
    $expenses = [];
}

// Get all Budgets from the database using the ID from url parameter

if(isset($_GET['budgetID'])){
    $budgetID = $_GET['budgetID'];
    $budgetsQuery = "
        SELECT b.id, b.budget_name, b.budget_amount, b.budget_occurence, b.budget_status, b.budget_reminder_status, b.budget_expire_date, b.budget_description
        FROM budget AS b
        WHERE b.budget_user_id = $userId AND b.id = $budgetID;
    ";
    $budgetEditResponse = $con->query($budgetsQuery)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($budgetEditResponse as $budget) {
        $budgetName = $budget['budget_name'] ?? '';
        $budgetAmount = $budget['budget_amount'] ?? '';
        $budgetOccurence = $budget['budget_occurence'] ?? '';
        $budgetStatus = $budget['budget_status'];
        $budgetReminderStatus = $budget['budget_reminder_status'];
        $budgetExpireDate = $budget['budget_expire_date'] ?? '';
        $budgetDescription = $budget['budget_description'] ?? '';
    }
} else {
    $budgetEditResponse = [];
}

// Get all Categories from the database using the ID from url parameter

if(isset($_GET['categoryID'])){
    $categoryID = $_GET['categoryID'];
    $categoriesQuery = "
        SELECT c.id, c.category_name, c.category_estimated_amount, c.category_occurence, c.category_status, c.reminder_date, c.category_description
        FROM categories AS c
        WHERE c.category_user_id = $userId AND c.id = $categoryID;
    ";
    $categoriesEdit = $con->query($categoriesQuery)->fetchAll(PDO::FETCH_ASSOC);
    foreach ($categoriesEdit as $category) {
        $categoryName = $category['category_name'] ?? '';
        $categoryEstimatedAmount = $category['category_estimated_amount'] ?? '';
        $categoryOccurence = $category['category_occurence'] ?? '';
        $categoryStatus = $category['category_status'];
        $categoryDescription = $category['category_description'] ?? '';
        $reminderDate = $category['reminder_date'] ?? '';
    }
} else {
    $categoriesEdit = [];
}

// Get all Users from the database using the ID from url parameter

if(isset($_GET['userID'])){
    $userID = $_GET['userID'];
    $usersQuery = "
        SELECT u.id, u.first_name, u.last_name, u.email, u.phone, u.address, u.city, u.state, u.zip, u.country, u.created_at
        FROM users AS u
        WHERE u.id = $userID;
    ";
    $users = $con->query($usersQuery)->fetchAll(PDO::FETCH_ASSOC);
} else {
    $users = [];
}

// Get all Transactions from the database using the ID from url parameter

if(isset($_GET['transactionID'])){
    $transactionID = $_GET['transactionID'];
    $transactionsQuery = "
        SELECT t.id, t.transaction_name, t.transaction_amount, t.transaction_date, t.transaction_type, t.transaction_description
        FROM transactions AS t
        WHERE t.transaction_user_id = $userId AND t.id = $transactionID;
    ";
    $transactions = $con->query($transactionsQuery)->fetchAll(PDO::FETCH_ASSOC);
} else {
    $transactions = [];
}

// Get all Reminders from the database using the ID from url parameter

if(isset($_GET['reminderID'])){
    $reminderID = $_GET['reminderID'];
    $remindersQuery = "
        SELECT r.id, r.reminder_name, r.reminder_date, r.reminder_description
        FROM reminders AS r
        WHERE r.reminder_user_id = $userId AND r.id = $reminderID;
    ";
    $reminders = $con->query($remindersQuery)->fetchAll(PDO::FETCH_ASSOC);
} else {
    $reminders = [];
}

// Get all Goals from the database using the ID from url parameter

if(isset($_GET['goalID'])){
    $goalID = $_GET['goalID'];
    $goalsQuery = "
        SELECT g.id, g.goal_name, g.goal_amount, g.goal_date, g.goal_description
        FROM goals AS g
        WHERE g.goal_user_id = $userId AND g.id = $goalID;
    ";
    $goals = $con->query($goalsQuery)->fetchAll(PDO::FETCH_ASSOC);
} else {
    $goals = [];
}

