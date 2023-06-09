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

    if ($result->num_rows > 0) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        echo "
        <h2>Course Details</h2>
        <p>Serial No: ".$row['serial_no']."</p>
        <p>Title: ".$row['title']."</p>
        <p>Department: ".$row['dept_name']."</p>";
    } else {
        echo "Course not found";
    }
} else {
    echo "Invalid request";
}
?>