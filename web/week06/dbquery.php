<?php
require "./dbconnect.php";
$db = get_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST["x"], false);
    $queryType = $obj->type;
    if ($queryType == "favorite") {
        $user_id = $obj->user_id;
        $query = "SELECT * from favorite WHERE user_id = $user_id";
        $statement = $db->prepare($query);
        $statement->execute();
        $favoriteData = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $favoriteData[] = $row;
        }
        $dbdata = array();
        // Loop through favoriteData and make queries to get users favorites
        foreach ($favoriteData as $favorite) {
            $table_part_name = $favorite['table_part_name'];
            $part_id = $favorite['part_id'];
            $query = "SELECT * from $table_part_name WHERE id = $part_id";
            $statement = $db->prepare($query);
            $statement->execute();
            // while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            //     $dbdata[] = $row;
            // }
            echo $query;
        }
        //echo json_encode($dbdata);
    } else {
        $tableName = $obj->type;
        $query = "SELECT * from " . $tableName;
        $statement = $db->prepare($query);
        $statement->execute();

        $dbdata = array();
        // Go through each result
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $dbdata[] = $row;
        }
        echo json_encode($dbdata);
    }
}
