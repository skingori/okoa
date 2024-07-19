<!-- Get all the expeses from the database -->

<?php
    require_once('../connection/db.php');
    $userId = $con->query("SELECT id FROM users WHERE email = '$_SESSION[email]'")->fetchColumn();
    if ($userId) {
        $expensesQuery = "
        SELECT e.id, e.expense_name, e.expense_amount, e.expense_created_at,
            e.expense_category_name, b.budget_amount
        FROM expenses AS e
        JOIN budget AS b ON e.expense_budget_id = b.id
        WHERE e.expense_user_id = $userId;
    ";
    $expenses = $con->query($expensesQuery)->fetchAll(PDO::FETCH_ASSOC);
        }
    else {
        $expenses = [];
    }
?>