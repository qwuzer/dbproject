
<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="/style/search.css">
</head>
<body>

<?php
echo "<h1> search results</h1>";

// if (isset($_POST['search'])) {
//     $Search = $_POST['search'];
//     echo $Search . "<br>";
// } else {
//     echo "資料不完全";  
// }


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



if (isset($_POST['search_course'])) {
    $SearchCourse = $_POST['search_course'];

    $sql = "SELECT serial_no, title, instructor FROM course WHERE title LIKE '%$SearchCourse%';";	// Set up your SQL query
    
    $result = $conn->query($sql);	// Send SQL Query

    echo "results:". $result->num_rows . "<br>";
    if ($result->num_rows > 0) {
        $counter = 0; // Initialize a counter to keep track of the number of courses
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // Check if the counter is divisible by 3 to start a new row
            if ($counter % 3 == 0) {
                echo "<div class='row'>"; // Start a new row
            }
            
            // Display the course details in a block
            echo "  
            <div class= 'course-block'>
                <a href='course_detail.php?serial_no=".$row['serial_no']."'>
                    <h3>Serial No: " .$row['serial_no']."</h3>
                </a>
                    <p>Title: ".$row['title']."</p>
                    <p>Instructor: ".$row['instructor']."</p>
            </div>";

            echo "------------------------------------";

            // Increment the counter
            $counter++;
            
            // Check if the counter is divisible by 3 to end the row
            if ($counter % 3 == 0) {
                echo "</div>"; // End the row
            }
        }
        
        // Check if there are any remaining courses to close the last row
        if ($counter % 3 != 0) {
            echo "</div>"; // Close the last row
        }
    } else {
        echo "0 results";
    }
} 
else if (isset($_POST['search_name'])) {
    $SearchName = $_POST['search_name'];

    $sql = "SELECT serial_no, title, instructor FROM course WHERE instructor LIKE '%$SearchName%';";	// Set up your SQL query
    
    $result = $conn->query($sql);	// Send SQL Query

    echo "results:". $result->num_rows . "<br>";
    if ($result->num_rows > 0) {
        $counter = 0; // Initialize a counter to keep track of the number of courses
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // Check if the counter is divisible by 3 to start a new row
            if ($counter % 3 == 0) {
                echo "<div class='row'>"; // Start a new row
            }
            
            // Display the course details in a block
            echo "  
            <div class= 'course-block'>
                <a href='course_detail.php?serial_no=".$row['serial_no']."'>
                    <h3>Serial No: " .$row['serial_no']."</h3>
                </a>
                <p>Title: ".$row['title']."</p>
                    <p>Instructor: ".$row['instructor']."</p>
            </div>";

            echo "------------------------------------";

            // Increment the counter
            $counter++;
            
            // Check if the counter is divisible by 3 to end the row
            if ($counter % 3 == 0) {
                echo "</div>"; // End the row
            }
        }
        
        // Check if there are any remaining courses to close the last row
        if ($counter % 3 != 0) {
            echo "</div>"; // Close the last row
        }
    } else {
        echo "0 results";
    }
} else {
    echo "資料不完全";
}

				
?>