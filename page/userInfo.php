<?php

session_start();
include "conn.php";

// set up char set
if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ******** update your personal settings ******** 

$id = $_GET["id"];

$userInfo_sql = "SELECT * FROM user WHERE user_id='$id'"; // set up your sql query
$result = $conn->query($userInfo_sql); // Send SQL Query

if ($result->num_rows > 0) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    echo " user_id: " . $row["user_id"] .
        " user_name: " . $row["name"] .
        " email: " . $row["email"] .
        " num_of_posts: " . $row["num_of_posts"];
} else {
    echo "Invalid request";
}

session_unset();

?>