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

if (isset($_GET['serial_no'])) {
    $serialNo = $_GET['serial_no'];

    $sql = "SELECT * FROM course WHERE serial_no = '$serialNo';"; // Set up your SQL query
    
    $result = $conn->query($sql); // Send SQL Query


    //serial_no	char(4)	
    // course_code	varchar(10) NULL	
    // dept_name	varchar(100) NULL	
    // course_level	varchar(100) NULL	
    // title	varchar(200) NULL	
    // credits	decimal(2,0) NULL	
    // R/S/G	varchar(10) NULL	
    // full/half	varchar(2) NULL	
    // EMI	varchar(20) NULL	
    // instructor	varchar(100) NULL	
    // time_location	varchar(100) NULL	
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo "
        <h2>Course Details</h2>
        <p>Serial No: ".$row['serial_no']."</p>
        <p>Course Code: ".$row['course_code']."</p>
        <p>Department: ".$row['dept_name']."</p>
        <p>Course Level: ".$row['course_level']."</p>
        <p>Title: ".$row['title']."</p>
        <p>Credits: ".$row['credits']."</p>
        <p>R/S/G: ".$row['R/S/G']."</p>
        <p>Full/Half: ".$row['full/half']."</p>
        <p>EMI: ".$row['EMI']."</p>
        <p>Instructor: ".$row['instructor']."</p>
        <p>Time Location: ".$row['time_location']."</p>";

    } else {
        echo "Course not found";
    }
} else {
    echo "Invalid request";
}
?>