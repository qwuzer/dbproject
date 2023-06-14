<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>後台管理</title>
    <link rel="stylesheet" href="../style/backend.css"> <!-- css check -->
</head>

<?php
session_start();
include "conn.php";

// set up char set
if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<body>
    <div class="box">

        <div class="background">
        </div>

        <div>
            <nav class="navbar">
                <p class="backend_page_title">後台管理</p>
                
                <a href='logout.php' target='_self' class='logout_pos'>LOG OUT</a>
            </nav>
        </div>

        <!-- Align? -->
        <div class="main_box">
            <br><br>
            <h2>後台管理</h2>
            <br>
            <div class="row">
                <div class="man">
                    <a href="coursemanage.php" target="_self" class="course_man"> 課程管理</a>
                </div>
                <div class="man">
                    <a href="postmanage.php" target="_self" class="post_man"> 留言管理</a>
                </div>
            </div>
            <br>
        </div>

    </div>
</body>

</html>