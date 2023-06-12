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
        <table width="700" border="1" bgcolor="#cccccc" align="center">
            <tr>
                <th>search by coursename</th>
                <td bgcolor="grey"><input type="text" name="search_course"  /></td>
            </tr>
            <tr>
                <th>search by instructor name</th>
                <td bgcolor="grey"><input type="text" name="search_name"  /></td>
            </tr>
            
            <tr>
            <th><label for="search_dept">Select Department:</label></th>
                <td bgcolor="grey">
                    <select name="search_dept"  id = "search_dept">
                        <option value=""></option>
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
                </td>
            </tr>

            <tr>
                <th>EMI</th>
                <td bgcolor="#FFFFFF"><input  type="radio" name="search_emi" value='是'>
                    yes
                    <input  type="radio" name="search_emi" value='0' >
                    no</td>
            </tr>

            <th><label for="search_day">Select Day:</label></th>
                <td bgcolor="grey">
                    <select name="search_day"  id = "search_day">
                        <option value= "" ></option>
                        <option value="一">一</option>
                        <option value="二">二</option>
                        <option value="三">三</option>
                        <option value="四">四</option>
                        <option value="五">五</option>
                    </select>  
                </td>
                <th><label for="search_time1">Select time1:</label></th>
                <td bgcolor="grey">
                    <select name="search_time1" id="search_time1">
                        <option value=""></option>
                        <?php
                        for ($i = 1; $i <= 9; $i++) {
                            echo "<option value=\"$i\">$i</option>";
                        }
                        ?>
                    </select>
                </td>
                <th><label for="search_time2">Select time2:</label></th>
                <td bgcolor="grey">
                    <select name="search_time2" id="search_time1">
                        <option value=""></option>
                        <?php
                        for ($i = 1; $i <= 9; $i++) {
                            echo "<option value=\"$i\">$i</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
           

        </table>
        <input type="submit" value="search">
    </form>  

</body>
</html>