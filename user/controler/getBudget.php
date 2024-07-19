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

// Get budget from the database

$userId = $con->query("SELECT id FROM users WHERE email = '$_SESSION[email]'")->fetchColumn();

if ($userId) {
    $budgetsQuery = "
        SELECT b.id, b.budget_name, b.budget_amount, b.budget_occurence, b.budget_status, b.budget_reminder_status, b.budget_expire_date, b.budget_description
        FROM budget AS b
        WHERE b.budget_user_id = $userId;
    ";
    $budgets = $con->query($budgetsQuery)->fetchAll(PDO::FETCH_ASSOC);
} else {
    $budgets = [];
}