<?php

$servername = "140.122.184.125:3307";
$username = "team14";
$password = "kQVYoJa7S0NIXlCN";
$dbname = "team14";

//Connecting to and selecting a MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo $_POST['name'];

if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $userName = $_POST['name'];
    $email = $_POST['email'];
    $passwd = $_POST['password'];

    // check duplicated username
    $check_sql = "SELECT * FROM user WHERE name='$email'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "註冊失敗，此電子郵件已註冊過帳號";
        // Back to homepage

        echo "<br><input type='button' onclick='history.go(-2)' value='返回主頁'></input>";
        exit();
    }

    //echo $userName, $email, $passwd;
    $insert_sql = "INSERT INTO user(name, email, password) VALUE ('$userName', '$email', '$passwd')";

    if ($conn->query($insert_sql) === TRUE) {
        echo "註冊成功!!";
        // Back to homepage
        echo "<br><input type='button' onclick='history.go(-2)' value='返回主頁'></input>";
    } else {
        echo $conn->error;
        echo "<h2 align='center'<font color='antiquew
        ith'>註冊失敗!!</font></h2>";
        echo "<br><input type='button' onclick='history.go(-2)' value='返回主頁'></input>";
    }
} else {
    echo "資料不完全";
}
?>