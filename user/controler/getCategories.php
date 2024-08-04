<?php
require_once('../connection/db.php');

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
