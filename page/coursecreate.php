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

if (isset($_POST['serial_no'])&&isset($_POST['course_code']) &&isset($_POST['dept_name']) &&isset($_POST['course_level']) &&isset($_POST['title']) &&isset($_POST['credits']) &&isset($_POST['RSG']) &&isset($_POST['fullhalf']) && isset($_POST['EMI']) && isset($_POST['instructor']) && isset($_POST['time_location'])) {
	$serial_no = $_POST['serial_no'];
    $course_code = $_POST['course_code'];
	$dept_name = $_POST['dept_name'];
	$course_level = $_POST['course_level'];
	$title = $_POST['title'];
	$credits = $_POST['credits'];
	$R = $_POST['RSG'];
	$full = $_POST['fullhalf'];
	$EMI = $_POST['EMI'];
	$instructor = $_POST['instructor'];
	$time_location = $_POST['time_location'];

	
	$insert_sql = "insert into course(serial_no, course_code, dept_name, course_level, title, credits, RSG, fullhalf, EMI, instructor, time_location) values('$serial_no', '$course_code', '$dept_name', '$course_level', '$title', '$credits', '$R', '$full', '$EMI', '$instructor', '$time_location')";	// TODO
	
	if ($conn->query($insert_sql) === TRUE) {
		echo "新增成功!!<br> <a href='coursemanage.php'>返回主頁</a>";
	} else {
		echo $conn->error;
		echo "<h2 align='center'><font color='antiquewith'>新增失敗!!</font></h2>";
	}

}else{
	echo "資料不完全";
}
				
?>

