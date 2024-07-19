<!-- Use PDO to create an sql connection -->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "okoa";

try {
    $con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // print "Connected successfully";
} catch (PDOException $e) {
    print "Connection failed: " . $e->getMessage();
    exit();
}