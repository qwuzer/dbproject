
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
    || isset($_POST['search_day']) || isset($_POST['search_time1']) || isset($_POST['search_time2']) || isset($_POST['search_emi'] )) {
    
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
        if( $searchDept != "") {
            $sql .= " AND dept_name =  '$searchDept'";
        } else {
            $sql .= " AND dept_name LIKE '%'";
        }
    }

    if( isset($_POST['search_day']) )
    {
        $searchDay = $_POST['search_day'];
        if( $searchDay != "") {
            $sql .= " AND (course.serial_no IN (SELECT course_serial_no FROM time_slot WHERE time_slot.day1 = '$searchDay' OR time_slot.day2 = '$searchDay'))";
        } else {
            $sql .= " AND (course.serial_no IN (SELECT course_serial_no FROM time_slot WHERE time_slot.day1 LIKE '%' OR time_slot.day2 LIKE '%'))";
        }
    }

    if( isset($_POST['search_time1']) )
    {
        $searchTime1 = $_POST['search_time1'];
        if( $searchTime1 != ""){
            $sql .= " AND (course.serial_no IN (SELECT course_serial_no FROM time_slot WHERE time_slot.start_time1 = '$searchTime1' OR time_slot.start_time2 = '$searchTime1'))";
        } else {
            $sql .= " AND (course.serial_no IN (SELECT course_serial_no FROM time_slot WHERE time_slot.start_time1 LIKE '%' OR time_slot.start_time2 LIKE '%'))";
        }
        //$sql .= " AND (course.serial_no IN (SELECT course_serial_no FROM time_slot WHERE time_slot.start_time1 = '$searchTime1' OR time_slot.start_time2 = '$searchTime1'))";
    }

    if( isset($_POST['search_time2']) )
    {
        $searchTime2 = $_POST['search_time2'];
        if( $searchTime2 != ""){
            $sql .= " AND (course.serial_no IN (SELECT course_serial_no FROM time_slot WHERE time_slot.end_time1 = '$searchTime2' OR time_slot.end_time2 = '$searchTime2'))";
        } else {
            $sql .= " AND (course.serial_no IN (SELECT course_serial_no FROM time_slot WHERE time_slot.end_time1 LIKE '%' OR time_slot.end_time2 LIKE '%'))";
        }
    }

    if( isset($_POST['search_emi']) )
    {
        $searchEmi = $_POST['search_emi'];
       // echo $searchEmi;
        if( $searchEmi == "" ){
            $sql .= " AND EMI = '$searchEmi'";
        } else {
            $sql .= " AND EMI != N'是'";
        }
    }

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
            
            $instr = $row['instructor'];
            $sql_inst_dept = "SELECT department_name FROM instructor WHERE i_name = '$instr' LIMIT 1";
            $result_inst_dept = $conn->query($sql_inst_dept);

            if ($result_inst_dept->num_rows > 0) {
                $dept_name = $result_inst_dept->fetch_assoc()['department_name'];
            } else {
                $dept_name = "";
            }

            //Display the course details in a block
            echo "  
            <div class= 'course-block'>
                <a href='course_detail.php?serial_no=".$row['serial_no']."'>
                    <h3>Serial No: " .$row['serial_no']."</h3>
                </a>
                <p>Title: ".$row['title']."</p>
                <p class = 'instructor' data-tooltip= '  ".$dept_name."'>Instructor: ".$row['instructor']."</p>
            </div>";

            // Display course ratings
            $postsql = "SELECT easiness , loading , usefulness FROM post where serial_no = ".$row['serial_no']."";
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