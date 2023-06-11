
<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
    <link rel="stylesheet" type="text/css" href="/webalizer/dbproject/style/search.css">
</head>
<body>

<?php
echo "<h1> search results</h1>";

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

if (isset($_POST['search_course']) || isset($_POST['search_name']) || isset($_POST['search_dept']) 
    || isset($_POST['search_day']) || isset($_POST['search_time1']) || isset($_POST['search_time2']) ) {
    
    $sql = "SELECT serial_no, title, instructor FROM course WHERE 1";

    // Check each search variable and append the corresponding conditions to the SQL query
    if (isset($_POST['search_course'])) {
        $searchCourse = $_POST['search_course'];
        $sql .= " AND title LIKE '%$searchCourse%'";
    }

    if (isset($_POST['search_name'])) {
        $searchName = $_POST['search_name'];
        $sql .= " AND instructor LIKE '%$searchName%'";
    }

    if ( isset($_POST['search_dept'])) {
        $searchDept = $_POST['search_dept'];
        $sql .= " AND dept_name =  '$searchDept'";

    }

    // if( isset($_POST['search_day']) )
    // {
    //     $searchDay = $_POST['search_day'];
    //     $sql .= " AND (course.serial_no IN (SELECT course_serial_no FROM time_slot WHERE time_slot.day1 = '一' OR time_slot.day2 = '一'))";
    // }

    // if( isset($_POST['search_time1']) )
    // {
    //     $searchTime1 = $_POST['search_time1'];
    //     $sql .= " AND (course.serial_no IN (SELECT course_serial_no FROM time_slot WHERE time_slot.start_time1 = '$searchTime1' OR time_slot.start_time2 = '$searchTime1'))";
    // }

    // if( isset($_POST['search_time2']) )
    // {
    //     $searchTime2 = $_POST['search_time2'];
    //     $sql .= " AND (course.serial_no IN (SELECT course_serial_no FROM time_slot WHERE time_slot.end_time1 = '$searchTime2' OR time_slot.end_time2 = '$searchTime2'))";
    // }


    echo $sql;

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

            // Display course ratings
            $postsql = "SELECT easiness , loading , usefulness FROM post";
            $postresult = $conn->query($postsql);
            
            if( $postresult->num_rows > 0){  //get average ratings of post
                $total_easiness = 0;
                $total_loading = 0;
                $total_usefulness = 0;
                while($postrow = mysqli_fetch_array($postresult, MYSQLI_ASSOC))
                {
                    $easiness = $postrow['easiness'];
                    $loading = $postrow['loading'];
                    $usefulness = $postrow['usefulness'];
                    $total_easiness += $easiness;
                    $total_loading += $loading;
                    $total_usefulness += $usefulness;
                }
                $avg_easiness = $total_easiness / $postresult->num_rows;
                $avg_loading = $total_loading / $postresult->num_rows;
                $avg_usefulness = $total_usefulness / $postresult->num_rows;
                echo "<p> Easiness: ".$avg_easiness." Loading: ".$avg_loading." Usefulness: ".$avg_usefulness."</p>";
            }
            else{
                echo "<p>Easiness: --  Loading: --   Usefulness: --</p>";
            }


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
 else {
    echo "資料不完全";
}


if( isset($_POST['search_day']) || isset($_POST['search_day1']) || isset($_POST['search_day2'])){

}
				
?>