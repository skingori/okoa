<?php
require_once('../connection/db.php');

// | id                        | int                                       | NO   | PRI | NULL              | auto_increment    |
// | category_user_id          | int                                       | NO   |     | NULL              |                   |
// | category_name             | varchar(100)                              | NO   |     | NULL              |                   |
// | category_estimated_amount | decimal(10,2)                             | NO   |     | NULL              |                   |
// | category_occurence        | enum('daily','weekly','monthly','yearly') | NO   |     | NULL              |                   |
// | category_status           | enum('active','inactive')                 | NO   |     | NULL              |                   |
// | reminder_date             | date                                      | YES  |     | NULL              |                   |
// | category_description      | text                                      | YES  |     | NULL              |                   |
// | created_at                | timestamp                                 | YES  |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED |
// | updated_at                | timestamp                                 | YES  |     | CURRENT_TIMESTAMP | DEFAULT_GENERATED |


$userId = $con->query("SELECT id FROM users WHERE email = '$_SESSION[email]'")->fetchColumn();

if ($userId) {
    $categoriesQuery = "
        SELECT c.id, c.category_name, c.category_estimated_amount, c.category_occurence, c.category_status, c.reminder_date, c.category_description
        FROM categories AS c
        WHERE c.category_user_id = $userId;
    ";
    $categories = $con->query($categoriesQuery)->fetchAll(PDO::FETCH_ASSOC);
} else {
    $categories = [];
}
