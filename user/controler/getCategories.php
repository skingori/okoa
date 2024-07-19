<?php
require_once('../connection/db.php');

// | category_name             | varchar(100)                              | NO   |     | NULL              |                   |
// | category_estimated_amount | decimal(10,2)                             | NO   |     | NULL              |                   |
// | category_occurence        | enum('daily','weekly','monthly','yearly') | NO   |     | NULL              |                   |
// | categories_status         | enum('active','inactive')                 | NO   |     | NULL              |                   |
// | reminder_date 

// get * categories from the database - no user_id needed
$categoriesQuery = "
    SELECT c.id, c.category_name, c.category_estimated_amount, c.category_occurence, c.category_status, c.reminder_date
    FROM categories AS c;
";

if ($categories = $con->query($categoriesQuery)->fetchAll(PDO::FETCH_ASSOC)) {
    return $categories;
} else {
    return [];
}



