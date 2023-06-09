<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>This is search page</h1>

    <form action="dosearch.php" method="post">	
        <table width="500" border="1" bgcolor="#cccccc" align="center">
            <tr>
                <th>search</th>
                <td bgcolor="grey"><input type="text" name="search_course"  /></td>
            </tr>
            <tr>
                <th colspan="2"><input type="submit" value="新增"/></th>  
               
            </tr>
        </table>
    </form>  

    <form action="dosearch.php" method="post">	
        <table width="500" border="1" bgcolor="#cccccc" align="center">
            <tr>
                <th>search by instructor name</th>
                <td bgcolor="grey"><input type="text" name="search_name"  /></td>
            </tr>
            <tr>
                <th colspan="2"><input type="submit" value="搜尋"/></th>  
            </tr>
        </table>
    </form>  
    
    <form action="dosearch.php" method="post">
        <label for="search_course">Select Department:</label>
        <select name="search_course"  id = "search_course">
            
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

            $sql = "SELECT dept_name FROM department";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $deptName = $row['dept_name'];
                    echo "<option value='$deptName'>$deptName</option>";
                }
            } else {
                echo "<option value=''>No departments found</option>";
            }

        ?>
        </select>
        <input type="submit" value="search_course">
    </form>

</body>
</html>