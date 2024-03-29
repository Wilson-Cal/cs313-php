<?php
require "./dbconnect.php";
$db = get_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json; charset=UTF-8");
    $obj = json_decode($_POST["x"], false);
    $queryType = $obj->type;
    if ($queryType == "favorite") {
        $user_id = $_COOKIE["user_id"];
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
            $favorite_id = $favorite['id'];
            $query = "SELECT * from $table_part_name WHERE id = $part_id";
            $statement = $db->prepare($query);
            $statement->execute();
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $row['favorite_id'] = $favorite_id;
                $row['category'] = $table_part_name;
                $dbdata[] = $row;
            }
        }
        echo json_encode($dbdata);
    } else if ($queryType == "login") {
        $email = $obj->email;
        $password = $obj->password;
        $query = "SELECT * from user_app WHERE email = '$email'";
        $statement = $db->prepare($query);
        $statement->execute();
        $tempPassword = "";
        $tempUserId = "";
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $tempPassword = $row['user_password'];
            $tempUserId = $row['id'];
        }
        $verify = password_verify($password, $tempPassword);
        if ($verify) {
            setcookie("user_id", $tempUserId);
        }
        echo $verify;
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
