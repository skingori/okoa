<?php
require_once('../connection/db.php');

if (isset($_POST['getDate'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $expenseAmountAndMonth = $con->query("
        SELECT SUM(expense_amount) AS amount, MONTH(expense_created_at) AS month
        FROM expenses
        WHERE expense_created_at BETWEEN '$start_date' AND '$end_date'
        GROUP BY month
    ")->fetchAll(PDO::FETCH_ASSOC);

    $monthsInName = [
        '1' => 'January',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December'
    ];

    $chartLabels = '';
    $expensesTotalAmount = '';

    foreach ($expenseAmountAndMonth as $key => $value) {
        $chartLabels .= "'" . $monthsInName[$value['month']] . "',";
        $expensesTotalAmount .= $value['amount'] . ",";
    }
    $chartLabels = rtrim($chartLabels, ',');
    $expensesTotalAmount = rtrim($expensesTotalAmount, ',');
} 
else {
    $chartLabels = "'January','February','March','April','May','June','July','August','September','October','November','December'";
    $expensesTotalAmount = '0,0,0,0,0,0,0,0,0,0,0,0';
} 
?>

