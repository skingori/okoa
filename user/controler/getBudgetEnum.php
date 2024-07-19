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

// Get budget Enums 

$budgetEnumsQuery = "
    SELECT COLUMN_TYPE
    FROM information_schema.COLUMNS
    WHERE TABLE_NAME = 'budget'
    AND COLUMN_NAME = 'budget_occurence'
    OR COLUMN_NAME = 'budget_status'
    OR COLUMN_NAME = 'budget_reminder_status';
";

// extract the enum values from the query result

$budgetEnums = $con->query($budgetEnumsQuery)->fetchAll(PDO::FETCH_ASSOC);

// extract the enum values from the query result

$budgetOccurence = explode(",", str_replace("'", "", substr($budgetEnums[0]['COLUMN_TYPE'], 5, -1)));
$budgetStatus = explode(",", str_replace("'", "", substr($budgetEnums[1]['COLUMN_TYPE'], 5, -1)));
$budgetReminderStatus = explode(",", str_replace("'", "", substr($budgetEnums[2]['COLUMN_TYPE'], 5, -1)));
