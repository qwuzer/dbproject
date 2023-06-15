<?php
    session_start();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>首頁</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="box">

        <div class="background">
        </div>

        <div >
            <nav class="navbar">
                <?php
                if ($_SESSION['login'])
                {
                    echo "<a href='page/userInfo.php' target='_self' class='signup_pos'> PROFILE </a>";
                    echo "<a href='page/logout.php' target='_self' class='login_pos'> LOG OUT </a>";
                }
                else{
                    echo "<a href='page/signup.php' target='_self' class='signup_pos'> SIGN UP</a>";
                    echo "<a href='page/login.php' target='_self' class='login_pos'> LOG IN</a>";
                }
                ?>
                <a href="page/search.php" target="_self" class="search_pos" id="iii">搜尋更多課程評價🔍</a>
            </nav>
        </div>
        

        <div class="pp">
            <p>最新評價📢📢</p>            
        </div>


        <div class="first_post_div">
            <?php       
                //include "conn.php";        
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
            
                $sql = "SELECT * 
                        FROM post , course , user 
                        where course.serial_no = post.serial_no and 
                              user.user_id = post.user_id 
                        ORDER BY post_time DESC LIMIT 1";
                $result = $conn->query($sql);
                //echo $result->num_rows;


                // Function to get the star rating HTML based on the value
                function getStarRatingHTML($value) {
                    $html = '';
                    $fullStarURL = 'https://i.imgur.com/cIhWZZr.png';
                    $halfStarURL = 'https://i.imgur.com/bZfTr0P.png';
                    $emptyStarURL = 'https://i.imgur.com/3Odw4Rj.png';

                    for ($i = 1; $i <= 5; $i++) {
                        if ($value >= $i) {
                        $starURL = $fullStarURL;
                        } else if ($value >= $i - 0.5) {
                        $starURL = $halfStarURL;
                        } else {
                        $starURL = $emptyStarURL;
                        }

                        $html .= "<img src='$starURL' alt='Star'>";
                    }

                    return $html;
                }

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $user_id = $row['user_id'];
                    $title = $row['course.title'];
                    $post_time = $row['post_time'];
                    $title = $row['title'];
                    $post_id = $row['post_id'];
                    $post_content = $row['content'];
                    $easiness = $row['easiness'];
                    $loading = $row['loading'];
                    $usefulness = $row['usefulness'];
                    $name = $row['name'];

                    $easiness = round($easiness * 2) / 2;
                    $loading = round($loading * 2) / 2;
                    $usefulness = round($usefulness * 2) / 2;

                    
                    echo "
                    <p>
                        <a  class = 'post_title' href='../dbproject/page/course_detail.php?serial_no=".$row['serial_no']."'>
                        <h3>" .$title."</h3>
                        </a>
                    </p>";
                    //echo "<p class= 'post_title'>$title</p>";

                        echo "<div class='under_title'>";
                        echo "<p>發布日期:".$post_time."&nbsp;</p>";
                        echo "<p>發布者:".$name."&nbsp;</p>";
                        echo "</div>";
                        echo    "<div class='rating'>
                                    <p><span>Easiness:</span> " . getStarRatingHTML($easiness) . "</p>
                                    <p><span>Loading:</span> " . getStarRatingHTML($loading) . "</p>
                                    <p><span>Usefulness:</span> " . getStarRatingHTML($usefulness) . "</p>
                                </div>";
                    // echo "<p class='id'>$post_id</p>";
                    echo "<p class='post_article'>$post_content</p>";

                } else {
                    echo "<p class= 'post_title'>No posts found</p>";
                }
            ?>  
        </div>

        <div class="second_post_div">
            <?php       
                //include "conn.php";        
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
            
                $sql = "SELECT * 
                        FROM post , course , user 
                        where course.serial_no = post.serial_no and 
                              user.user_id = post.user_id 
                        ORDER BY post_time DESC LIMIT 1 OFFSET 1";
                $result = $conn->query($sql);
                //echo $result->num_rows;

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $user_id = $row['user_id'];
                    $title = $row['course.title'];
                    $post_time = $row['post_time'];
                    $title = $row['title'];
                    $post_id = $row['post_id'];
                    $post_content = $row['content'];
                    $easiness = $row['easiness'];
                    $loading = $row['loading'];
                    $usefulness = $row['usefulness'];
                    $name = $row['name'];

                    echo "
                    <p> 
                        <a class = 'post_title' href='../dbproject/page/course_detail.php?serial_no=".$row['serial_no']."'>
                        <h3>" .$title."</h3>
                        </a>
                    </p>";
                    //echo "<p class= 'post_title'>$title</p>";

                 

                    echo "<div class='under_title'>";
                    echo "<p>發布日期:".$post_time."&nbsp;</p>";
                    echo "<p>發布者:".$name."&nbsp;</p>";
                    echo "</div>";

                     echo   "<div class='rating'>
                                <p><span>Easiness:</span> " . getStarRatingHTML($easiness) . "</p>
                                <p><span>Loading:</span> " . getStarRatingHTML($loading) . "</p>
                                <p><span>Usefulness:</span> " . getStarRatingHTML($usefulness) . "</p>
                            </div>";
                    
                    // echo "<p class='id'>$post_id</p>";
                    echo "<p class='post_article'>$post_content</p>";

                } else {
                    echo "<p class= 'post_title'>No posts found</p>";
                }
            ?>  
        </div>

    </div>
</body>
</html>