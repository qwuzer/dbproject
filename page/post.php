<?php
//******** update your personal settings ******** 
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

if (isset($_POST['content']) && isset($_POST['easiness']) && isset($_POST['loading']) && isset($_POST['usefulness'])) {
	$content = $_POST['content'];
	$easiness = $_POST['easiness'];
	$loading = $_POST['loading'];
	$usefulness = $_POST['usefulness'];

	$user = $_SESSION['user'];

	
	$insert_sql = "insert into post(content, easiness, loading, usefulness,user_id) values('$content', '$easiness', '$loading', '$usefulness','$user')";	// TODO
	
	if ($conn->query($insert_sql) === TRUE) {
		echo "新增成功!!<br> <a href='index.php'>返回主頁</a>";
	} else {
		echo "<h2 align='center'><font color='antiquewith'>新增失敗!!</font></h2>";
	}

}else{
	echo "資料不完全";
}
				
?>

