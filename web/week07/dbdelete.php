<?php
require "./dbconnect.php";
$db = get_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST["x"], false);
    $deleteType = $obj->type;
    if ($deleteType == "favorite") {
        $user_id = $_COOKIE["user_id"];
        $favorite_id = $obj->favorite_id;
        $query = "DELETE FROM favorite WHERE id = $favorite_id AND user_id = $user_id";
        $statement = $db->prepare($query);
        $statement->execute();
    }
}
