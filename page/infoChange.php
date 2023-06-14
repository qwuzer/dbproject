<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改個人資料</title>
    <link rel="stylesheet" href="../style/pro.css"> <!-- css check -->
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
            <h2>個人資料</h2>
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
            $id = $_GET['id'];
            $sql = "SELECT name, email FROM user WHERE user_id='$id'"; // set up your sql query
            $result = $conn->query($sql); // Send SQL Query
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            ?>
            <form action="doInfoChange.php?id=<?php echo $_GET['id']; ?>" method="post">
                <table width="500" border="1" bgcolor="#cccccc" align="center">
                    <tr>
                        <th>name</th>
                        <td bgcolor="#FFFFFF"><input type="text" name="name" value="<?php echo $row['name']; ?>" />
                        </td>
                    </tr>
                    <tr>
                        <th>email</th>
                        <td bgcolor="#FFFFFF"><input type="text" name="email" value="<?php echo $row['email']; ?>" />
                        </td>
                    </tr>
                    <th colspan="2"><input type="submit" value="更新" /></th>
                    </tr>
                </table>
            </form>
            <?php
            if (isset($_SESSION['msg'])) {
                echo "<br><p><font color='#FF0000'>{$_SESSION['msg']}</font></p>";
                unset($_SESSION['msg']);
            }
            //session_unset();
            ?>
        </div>
        <br>
    </div>

    </div>
</body>

</html>