<?php
require "./dbconnect.php";
$db = get_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST["x"], false);
    $insertType = $obj->type;
    if ($insertType == "favorite") {
        $user_id = $obj->user_id;
        $part_id = $obj->part_id;
        $table_part_name = $obj->category;
        // $query = `INSERT INTO favorite(user_id, part_id, table_part_name) VALUES('$user_id', '$part_id','$table_part_name'`;
        // $statement = $db->prepare($query);
        // $statement->execute();
    }
    $dbdata = array();
    // Go through each result
    // while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    //     $dbdata[] = $row;
    // }
    echo json_encode($dbdata);
}
