<?php
require "./dbconnect.php";
$db = get_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST["x"], false);
    $insertType = $obj->type;
    if ($insertType == "favorite") {
        $user_id = $_COOKIE["user_id"];
        $part_id = $obj->part_id;
        $table_part_name = $obj->category;
        $query = "INSERT INTO favorite(user_id, part_id, table_part_name) VALUES('$user_id', '$part_id','$table_part_name')";
        $statement = $db->prepare($query);
        $statement->execute();
    } else if ($insertType == "user") {
        $email = $obj->email;
        $username = $obj->username;
        $password = $obj->password;
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO user_app(username, email, user_password) VALUES('$username', '$email','$hashed_password')";
        $statement = $db->prepare($query);
        $statement->execute();
        $query = "SELECT id from user_app WHERE email = '$email'";
        $statement = $db->prepare($query);
        $statement->execute();
        $dbdata = array();
        // Go through each result
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            setcookie("user_id", $row["id"]);
        }
    }
}
