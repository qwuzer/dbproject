<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/search.css">
</head>

<body>
  <div class="box">

    <div class="background">
      <!-- this div is for background -->
    </div>

    <div class="this_class_is_for_nav_bar">
      <nav class="navbar">
          <a href="page/signup.html" target="_self" class="signup_pos"> SIGN UP</a>
          <a href="page/login.html" target="_self" class="login_pos"> LOG IN</a>
          <a href="../index.html" target="_self" class="return_indexpage_pos">回到首頁</a>
      </nav>
    </div>

    <div class="main_display_box">
      <form action="dosearch.php" method="post">	
        <table class="table_box">
              <tr >
                  <th>search by coursename</th>
                  <td><input type="text" name="search_course"  class="boarder_test" /></td>
              </tr>
              <tr>
                  <th>search by instructor name</th>
                  <td bgcolor="grey"><input type="text" name="search_name"  /></td>
              </tr>
              
              <tr>
                <th><label for="search_dept">Select Department:</label></th>
                  <td bgcolor="grey">
                    <select name="search_dept"  id = "search_dept">

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
              <!-- </tr>

              <tr> -->
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
              <!-- </tr>

              <tr> -->
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
    </div>
  
  </div>
  
</body>
</html>