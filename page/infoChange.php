<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改個人資料</title>
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
                <p class="backend_page_title">修改個人資料</p>

                <a href='logout.php' target='_self' class='logout_pos'>LOG OUT</a>
            </nav>
        </div>

        <!-- Align? -->
        <div class="main_box">
            <br>
            <h2>個人資料</h2>
            <br>
            <?php

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

            // ******** update your personal settings ******** 
            $sql = "SELECT serial_no, title, instructor from course"; // set up your sql query
            $result = $conn->query($sql); // Send SQL Query
            ?>
            <tr>
                <th>name</th>
                <td bgcolor="#FFFFFF"><input type="text" name="name" value="<?php echo $id; ?>" readonly /></td>
            </tr>
        </div>
        <br>
    </div>

    </div>
</body>

</html>