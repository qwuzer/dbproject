<html>

<head>
  <title>課程資料庫管理系統</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../style/search.css">
</head>
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
?>

<body>
<div class="box">

    <div class="background">
      <!-- this div is for background -->
    </div>

    <div class="this_class_is_for_nav_bar">
      <nav class="navbar">
        <a href="logout.php" target="_self" class="logout_pos"> LOG OUT </a>
          <p class="courseman_page_title">新增課程</p>
        <a href="backend.php" target="_self" class="return_indexpage_pos">回到管理者首頁</a>
      </nav>
    </div>

   <div class="man_main_box"> 
  <h1 align="center">新增課程</h1>
  <form action="coursecreate.php" method="post">
    <table width="500" border="1" bgcolor="#cccccc" align="center">
      <tr>
        <th>serial_no</th>
        <td bgcolor="#FFFFFF"><input type="text" name="serial_no" /></td>
      </tr>
      <tr>
        <th>course_code</th>
        <td bgcolor="#FFFFFF"><input type="text" name="course_code" /></td>
      </tr>
      <tr>
        <th>dept_name</th>
        <td>
          <select name="search_dept" id="search_dept">
            <option value=""></option>

            <?php

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
        <!--<td bgcolor="#FFFFFF"><input type="text" name="dept_name"/></td>-->
      </tr>
      <tr>
        <th>course_level</th>
        <td bgcolor="#FFFFFF"><input type="text" name="course_level" /></td>
      </tr>
      <tr>
        <th>title</th>
        <td bgcolor="#FFFFFF"><input type="text" name="title" /></td>
      </tr>
      <tr>
        <th>credits</th>
        <td bgcolor="#FFFFFF"><input type="text" name="credits" /></td>
      </tr>
      <tr>
        <th>RSG</th>
        <td bgcolor="#FFFFFF"><input type="text" name="RSG" /></td>
      </tr>
      <tr>
        <th>fullhalf</th>
        <td bgcolor="#FFFFFF"><input type="text" name="fullhalf" /></td>
      </tr>
      <tr>
        <th>EMI</th>
        <td bgcolor="#FFFFFF"><input type="text" name="EMI" /></td>
      </tr>
      <tr>
        <th>instructor</th>
        <td bgcolor="#FFFFFF"><input type="text" name="instructor" /></td>
      </tr>
      <tr>
        <th>time_location</th>
        <td bgcolor="#FFFFFF"><input type="text" name="time_location" /></td>
      </tr>




      <tr>
        <th colspan="2"><input type="submit" value="add!" /></th>

      </tr>
    </table>
  </form>

   </div>
</div>
</body>

</html>