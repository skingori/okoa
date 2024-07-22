<?php

// get all categories from the database
require_once('../connection/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $userID = $con->query("SELECT id FROM users WHERE email = '$_SESSION[email]'")->fetchColumn();
    $categoryName = $_POST['category_name'];
    $categoryEstimatedAmount = $_POST['category_estimated_amount'];
    $categoryOccurence = $_POST['category_occurence'];
    $categoryStatus = $_POST['category_status'];
    $categoryDescription = $_POST['category_description'];
    $reminderDate = $_POST['reminder_date'];


    $insert = $con->query("INSERT INTO categories(category_user_id, category_name, category_estimated_amount, category_occurence, category_status, category_description, reminder_date) VALUES ('$userID', '$categoryName', '$categoryEstimatedAmount', '$categoryOccurence', '$categoryStatus', '$categoryDescription', '$reminderDate')");
    if ($insert) {
        $_SESSION['message'] = "Category added successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "An error occurred. Please try again";
        $_SESSION['message_type'] = "error";
    }

} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit'])) {
    $editID = $_GET['categoryID'];
    $categoryName = $_POST['category_name'];
    $categoryEstimatedAmount = $_POST['category_estimated_amount'];
    $categoryOccurence = $_POST['category_occurence'];
    $categoryStatus = $_POST['category_status'];
    $categoryDescription = $_POST['category_description'];
    $reminderDate = $_POST['reminder_date'];

    $update = $con->query("UPDATE categories SET category_name = '$categoryName', category_estimated_amount = '$categoryEstimatedAmount', category_occurence = '$categoryOccurence', category_status = '$categoryStatus', category_description = '$categoryDescription', reminder_date = '$reminderDate' WHERE id = '$editID'");

    if ($update) {
        $_SESSION['message'] = "Category updated successfully";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "An error occurred. Please try again";
        $_SESSION['message_type'] = "error";
    }
}

?>