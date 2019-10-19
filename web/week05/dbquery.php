<?php
require "./dbconnect.php";
$db = get_db();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_GET["x"], false);
    $query = "SELECT * from processor";
    $statement = $db->prepare($query);
    $statement->execute();

    $dbdata = array();
    // Go through each result
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $dbdata[] = $row;
    }
    echo json_encode($dbdata);
} else if ($_SERVER["REQUEST_METHOD"] == "POST") { }
