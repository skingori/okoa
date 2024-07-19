<?php
require_once('../connection/db.php');

// retrieve the enum values for category_occurence AND category_status INFORMATION_SCHEMA.COLUMNS

$enumQuery = "
    SELECT COLUMN_TYPE
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_NAME = 'categories'
    AND COLUMN_NAME = 'category_occurence'
    OR COLUMN_NAME = 'category_status';
";

$enums = $con->query($enumQuery)->fetchAll(PDO::FETCH_ASSOC);

// extract the enum values from the query result

$occurenceEnum = explode(",", str_replace("'", "", substr($enums[0]['COLUMN_TYPE'], 5, -1)));
$statusEnum = explode(",", str_replace("'", "", substr($enums[1]['COLUMN_TYPE'], 5, -1)));

// return the enum values as a JSON object
