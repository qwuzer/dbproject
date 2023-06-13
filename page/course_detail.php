<!DOCTYPE html>
<html>
<head>
    <title>Course Detail</title>
    <link rel="stylesheet" type="text/css" href="../style/rating.css">
    <script src="../script/post.js"></script>
</head>

<body>
    
<?php
session_start();
include "conn.php";

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
        <h1>Course Details</h1>
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
   
        //echo $_SESSION['login'];
        $login = $_SESSION['login'];
        if(  $login == TRUE ){
            //echo "
            // <a href='post.php?serial_no=".$row['serial_no']."'>
            //     <h3>Post a comment: " .$row['serial_no']."</h3>
            // </a>";
            echo "
            <a href='#' onclick='showCommentWindow(" . $row['serial_no'] . ")'>
                <h3>Post a comment: " . $row['serial_no'] . "</h3>
            </a>";
        }
        else{
            echo "
            <a href='login.html?serial_no=".$row['serial_no']."'>
                <h3>Login in to post!</h3>
            </a>";
        }


        echo "<h1>Posts:</h1>";
        
        $postsql = "SELECT easiness , loading , usefulness FROM post where serial_no = '$serialNo'";
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
            echo " <p> No post yet </p>";
        }


        while($postrow = mysqli_fetch_array($postresult, MYSQLI_ASSOC))
        {
            $easiness = $postrow['easiness'];
            $loading = $postrow['loading'];
            $usefulness = $postrow['usefulness'];
            echo "<p> Easiness: ".$easiness." Loading: ".$loading." Usefulness: ".$usefulness."</p>";
            echo "<p> Comment: ".$postrow['comment']."</p>";
        }

    } else {
        echo "Course not found";
    }
} else {
    echo "Invalid request";
}


?>

</body>
</html>