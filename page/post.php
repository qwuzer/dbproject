<?php
include "conn.php";

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$id = $_GET['id'];
$serial_no = $_GET['serial_no'];

if (isset($postid)&&isset($serial_no)&&isset($id)&&isset($_POST['content']) && isset($_POST['easiness']) && isset($_POST['loading']) && isset($_POST['usefulness'])) {
	$content = $_POST['content'];
	$easiness = $_POST['easiness'];
	$loading = $_POST['loading'];
	$usefulness = $_POST['usefulness'];
	$postid=time();

	
	$insert_sql = "insert into post(post_id, content, easiness, loading, usefulness, serial_no, user_id) values('$postid', '$content', '$easiness', '$loading', '$usefulness', '$serial_no', '$id')";	// TODO
	
	if ($conn->query($insert_sql) === TRUE) {
		echo "新增成功!!<br> <a href='index.php'>返回主頁</a>";
	} else {
		echo "<h2 align='center'><font color='antiquewith'>新增失敗!!</font></h2>";
	}

}else{
	echo "資料不完全";
}
				
?>

