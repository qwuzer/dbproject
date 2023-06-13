<?php
    session_start();
    //echo $_SESSION['login'];
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
                <a href="page/signup.html" target="_self" class="signup_pos"> SIGN UP</a>
                <a href="page/login.php" target="_self" class="login_pos"> LOG IN</a>
                <a href="page/search.php" target="_self" class="search_pos">搜尋更多課程評價！</a>
            </nav>
        </div>
        

        <div class="pp">
            <p>最新評價📢📢</p>            
        </div>

<!--        
        <form action="/search.html" method="post">	
            <table width="500" border="1" bgcolor="#cccccc" align="center">
                <tr>
                    <th>search</th>
                    <td bgcolor="grey"><input type="text" name="search"  /></td>
                </tr>
                <tr>
                    <th colspan="2"><input type="submit" value="新增"/></th>  
                   
                </tr>
            </table>
        </form>  -->




        <div class="first_post_div">
            <p class="post_title">This is title 1</p>
            <p class="post_article">This is article 1</p>
            <?php
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
                
                $sql = "SELECT * FROM post";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $post_id = $row['post_id'];
                        $post_content = $row['content'];
                        echo "<p class='id'>$post_id</p>";
                        echo "<p class='content'>$post_content</p>";
                    }
                } else {
                    echo "<p class='post_title'>No posts found</p>";
                }

            ?>
        </div>

        <div class="second_post_div">
            <p class="post_title">This is title 2</p>
            <p class="post_article">This ia article 2</p>
        </div>

    </div>
</body>
</html>