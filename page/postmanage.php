<html>
<head>
	<title>Normal Comment</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../style/manage.css">
</head>
<style>
	table, th, td {
	border: 1px solid black;
	border-collapse: collapse;
	}
	th, td {
	padding: 5px;
	text-align: left;    
	}
	h1{
		color: darksalmon; 
		font-size: 100px;
	}
</style>
<body>
<div class="box">

    <div class="background">
      <!-- this div is for background -->
    </div>

    <div class="this_class_is_for_nav_bar">
      <nav class="navbar">
        <a href="logout.php" target="_self" class="logout_pos"> LOG OUT </a>
          <p class="courseman_page_title">留言管理</p>
        <a href="backend.php" target="_self" class="return_indexpage_pos">回到管理者首頁</a>
      </nav>
    </div>
	<!--<h1>Normal Comment</h1>-->
	<div class="main_box">
	<table style="width:80%" align="center">
		<tr><th>post_id</th><th>content</th><th colspan="2">Action</th></tr>	

		<!-- hint: 用這段php code 讀取資料庫的資料-->

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
			$sql = "SELECT post_id, content from post";	// set up your sql query
			$result = $conn->query($sql);	// Send SQL Query

			if ($result->num_rows > 0) {	
				while ( $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
					echo "<tr>";
					echo "<td>".$row["post_id"]."</td>";
					echo "<td class='my_endl'>".$row["content"]."</td>";
					//echo "<td>".$row["StuNum"]."</td>";
					//echo "<td><a href=\"update.php?id=".$row["post_id"]."\">修改</td>";
					echo "<td><a href=\"delete.php?id=".$row["post_id"]."\">刪除</td>";
					echo "</tr>";
				}
				} else {
					echo "0 results";
				}

		?>
		
	</table></div>
	<!--<p align="center"><a href="create.html">新增資料</a><p>-->
</div>
</body>
	
</html>


				
		