<?php
session_start();

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

$email = $_POST['email'];
$passwd = $_POST['password'];


if ($email && $passwd) {
    $sql = "SELECT * FROM user WHERE email='$email' AND password = '$passwd'";

    $result = $conn->query($sql);

    if ($result->num_rows) {

        $_SESSION['login'] = TRUE;
        

		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        $_SESSION['user'] = $row['user_id']; 
        //echo $_SESSION['user'];

        // Check roles
        if ($email === 'test@test') {
            header('Location: backend.php');
            //header('Location: coursemanage.php');
        } else {
            //header('Location: user.php');
            //echo $_SESSION['login'];
            header('Location: ../index.php');
        }

    } else {
        $_SESSION['login'] = FALSE;
        //echo "<h2 align='center'<font color='antiquewith'>登入失敗，請確認電子郵件及密碼!!</font></h2>";
        $_SESSION['msg'] = '登入失敗，請確認電子郵件及密碼!!';
        //header('Location: login.html');
    }
} else {
    $_SESSION['msg'] = '請輸入電子郵件及密碼!!';
    //header('Location: login.html');
}

if (isset($_SESSION['msg']))
{
    echo "<p class='danger'> {$_SESSION['msg']} </p>";
}

//session_unset();
?>
