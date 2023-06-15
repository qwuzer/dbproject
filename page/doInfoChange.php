<?php
session_start();
include "conn.php";

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$id = $_SESSION['user'];
$url = $_GET['id'];

$sql = "SELECT * FROM user WHERE id='$url'";
$result = $conn->query($sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

if ($email && $name) {

    $check_sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($check_sql);

    if ($row['name'] == $name) {
        if ($result->num_rows > 0) {
            $_SESSION['msg'] = "此電子郵件已註冊過帳號";
            // Back to homepage
            header("Location: infoChange.php?id=$url");
            exit();
        }
    } else {


        $sql = "UPDATE user set name='$name', email='$email' where user_id='$id'";
        $result = $conn->query($sql);

        if ($conn->query($sql) === TRUE) {
            header('Location: userInfo.php');
        } else {
            $_SESSION['msg'] = "修改失敗";
            echo "<h2 align='center'><font color='antiquewith'>修改失敗!!</font></h2>";
        }
    }

} else {
    $_SESSION['msg'] = '請輸入電子郵件及密碼!!';
    //header('Location: login.html');
}
//session_unset();
?>