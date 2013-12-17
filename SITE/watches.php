<!DOCTYPE html>
<html>
  <head>
    <title>Watches Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src='js/jquery-1.8.3.min.js'></script>
    <script src='js/jquery.elevatezoom.js'></script>
  </head>
  <body>

    <!-- BODY -->
    <div class = "row">
      <div class = "col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
        
        </br>
        <!-- NAVBAR HERE -->
        <nav class="navbar navbar-inverse" role="navigation">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="home.php">Home</a></li>
              <li class="active"><a href="#">Watches</a></li>
              <?php 
                session_start(); 
        
                if( !isset($_SESSION['user']) ) 
                    $_SESSION['user'] = 'NO'; 
              
                if ( ($_SESSION['user']) != 'NO' ) 
                { 
                    
                  echo "
                      <li><a href='manageDB.php''>Query Database</a></li>
                      <li><a href='insertPage.php'>Insert Data</a></li>";
                  echo
                      "</ul>
                      <form class='navbar-form navbar-right' action='logout.php'>
                        <button type='submit' class='btn btn-danger'><strong>Log out</strong></button>
                      </form>";
                }
                else //print sign in button
                  echo
                      "</ul>
                      <form class='navbar-form navbar-right' action='loginPage.php'>
                        <button type='submit' class='btn btn-success'><strong>Sign in</strong></button>
                      </form>";?>
          </div><!-- /.navbar-collapse -->
        </nav>

        <?php
        if(isset($_POST['searchQuery']) && $_POST['searchQuery'] != "")
        {
          $search = true;
          $searchquery = preg_replace('#[^a-z A-Z0-9$]#i', '', $_POST['searchQuery']);
          // select for search
          $sqlCommand = "SELECT watch_id, brand_name, category_name, name, gender, amount, price FROM watches JOIN brand ON watches.brand_id=brand.brand_id JOIN category ON watches.category_id=category.category_id WHERE brand_name LIKE '%$searchquery%' OR category_name LIKE '%$searchquery%' OR name LIKE '%$searchquery%' OR gender LIKE '%$searchquery%' OR price LIKE '%$searchquery%'";
        }
        else
        {
          if($_POST['filter'] == 'applyFilter')
          {
            $adress = "localhost";
            $user = "root";
            $pass = "root";
            $nameDB  = "watchstore";
            
            $conn = mysql_connect($adress, $user, $pass) or die("Cannot connect to SQL"); // connection to DB
            mysql_select_db($nameDB, $conn) or die("No such database!");

            $query = array(
            // select brand
            1 => "SELECT brand_name FROM brand",
            // select category
            2 => "SELECT category_name FROM category",
            // select sex
            3 => "SELECT DISTINCT gender FROM watches"
            );

            $i=0;
            $cols = array(); // brand_name or category_name or gender
            $string = array(0 => "(",
                            1 => "(",
                            2 => "("); // 'Adidas','Casual'....
            $brand = false;
            $category = false;
            $gender = false;
            while($i < 3)
            {
              $result = mysql_query($query[$i+1]);
              $col = mysql_fetch_field($result, 0);
              while($row = mysql_fetch_array($result))
              {
                $item = $_POST[$row[0]];
                if($item != "")
                {
                  if(!$brand && $col->name == "brand_name")
                  {
                    $cols[$i] .= $col->name; 
                    $brand = true;
                  }
                  if(!$category && $col->name == "category_name")
                  {
                    $cols[$i] .= $col->name;
                    $category = true;
                  }
                  if(!$gender && $col->name == "gender")
                  {
                    $cols[$i] .= $col->name;
                    $gender = true;
                  }
                  $string[$i] .= "'" . $row[0] . "',";
                }
              }
              $i++;
            }
            $i=0;
            while($i<3) // finish string array
            {
              if($string[$i] != "(")
              {
                $string[$i] = substr($string[$i], 0, -1); //cut last char
                $string[$i] .= ")"; //concat ")" to string                 
              }
              else
                $string[$i] = ""; //empty string
              $i++;            
            }

            $data = "WHERE ";
            $i=0;
            while($i<3) //compute $data
            {
              if($cols[$i] != "")
              {
                $data .= $cols[$i] . " IN " . $string[$i] . " AND ";                
              }
              $i++;            
            }
            $min = $_POST['min'] == "min" ? 0 : $_POST['min'];
            $max = $_POST['max'] == "max" ? 50000 : $_POST['max'];
            if($data != "WHERE ")
            {
              $data = substr($data, 0, -5);// cut the final " AND "
              //echo $min, " ", $max;
              $data .= " AND price BETWEEN $min AND $max";
              //echo $data;
              $sqlCommand = "SELECT watch_id, brand_name, category_name, name, gender, amount, price FROM watches JOIN brand ON watches.brand_id=brand.brand_id JOIN category ON watches.category_id=category.category_id $data"; 
            }
            else
            {
              $data .= "price BETWEEN $min AND $max";
              $sqlCommand = "SELECT watch_id, brand_name, category_name, name, gender, amount, price FROM watches JOIN brand ON watches.brand_id=brand.brand_id JOIN category ON watches.category_id=category.category_id $data"; 
            }
              
          
          }
            else // select for displaying all
            $sqlCommand = "SELECT watch_id, brand_name, category_name, name, gender, amount, price FROM watches JOIN brand ON watches.brand_id=brand.brand_id JOIN category ON watches.category_id=category.category_id";
        }
        ?>

        <!-- SEARCH BAR -->
        <div class="row">
          <form method="post">
            <div class = "col-lg-5 col-lg-offset-3 col-md-5 col-md-offset-3 col-sm-5 col-sm-offset-3 col-xs-8 col-xs-offset-1">
              <input name = "searchQuery" class = "form-control" placeholder = "Search" />
            </div>
            <div class = "col-lg-2 col-md-2 col-sm-3 col-xs-3">
              <button type="submit" class="btn btn-danger">
                <span class="glyphicon glyphicon-search" />
              </button>
            </div>
          </form>
        </div>

        <!-- FILTER SECTION -->
        <br><br>
        <?php
            $adress = "localhost";
            $user = "root";
            $pass = "root";
            $nameDB  = "watchstore";
            
            $conn = mysql_connect($adress, $user, $pass) or die("Cannot connect to SQL"); // connection to DB
            mysql_select_db($nameDB, $conn) or die("No such database!");

            $query = array(
              // select brand
              1 => "SELECT brand_name AS Brand FROM brand",
              // select category
              2 => "SELECT category_name AS Category FROM category",
              // select sex
              3 => "SELECT DISTINCT gender AS Gender FROM watches"
              );
            ?>
            

          <!-- display filter menu -->
          <div class="col-lg-4 col-md-4 col-sm-5 col-xs-4">
            <form method="post">
                <?php
                $i = 0;
                while($i < 3)
                {
                  $result = mysql_query($query[$i+1]);
                  $col = mysql_fetch_field($result, 0);
                  ?>
                    <div>
                      <?php
                    echo "<strong>", $col->name, "</strong>";
                      ?>
                    </div>
                    <?php
                    while($row = mysql_fetch_array($result))
                    {
                    ?>
                      <ul>
                        <div>
                          <input type="checkbox" name="<?php echo ucfirst($row[0]); ?>" <?php echo $_POST[$row[0]] != "" ? "checked" : ""?>/>
                          <?php
                            echo ucfirst($row[0]);
                          ?>
                        </div>
                      </ul>
                    <?php
                    }
                  $i++;
                 } 
                ?>
              <div>
                <strong>Price</strong>
              </div>
              <br>
              <div>
                <input type="text" name="min" style="width:70px" value="<?php echo $_POST['min'] == "" ? min : $_POST['min']?>" /> -
                <input type="text" name="max" style="width:70px" value="<?php echo $_POST['max'] == "" ? max : $_POST['max']?>" />
              </div>
              <br>
              <br>
              <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">
                <button name="filter" value="applyFilter" type="submit" class="btn btn-sm btn-success btn-block"><strong>Apply filter</strong></button>
              </div>
            </form>
          </div>
            
            
            <!-- display watches list -->
            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-8">
              <?php 
                $result = mysql_query($sqlCommand);
                echo "<h6>", mysql_num_rows($result), " results</h6>";
              ?>
              <div class="list-group">
              <?php
                $j = 0;
                $result = mysql_query($sqlCommand);
                $count = mysql_num_rows($result);
                if($count > 0)
                {
                  while($row = mysql_fetch_array($result))
                  {
                  ?>
                    <div class="list-group-item">
                      <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-5">
                          <!-- <img class="img-rounded" src='images/small/1.png' data-zoom-image='images/large/1.png' style="width:auto; height:100px;"/> -->
                          <?php echo "<img class='img-rounded' src='images/small/", $row["watch_id"], ".png' data-zoom-image='images/large/", $row["watch_id"], ".png' style='width:auto; height:80px;'>"; ?>
                        </div>
                        <br>
                        <div class="col-lg-10 col-md-9 col-sm-8 xol-xs-7">
                          <div class="pull-left">
                            <h4 class="list-group-item-heading"><?php $j++; echo ucfirst($row["name"]); ?></h4>
                            <h5 class="list-group-item-heading"><?php echo ucfirst($row["brand_name"]), ", ", ucfirst($row["category_name"]), ", ", ucfirst($row["gender"]); ?></h5>
                          </div>
                          <div class="pull-right">
                            <h4 class="list-group-item-heading" style="color: #3c763d;"><?php $j++; echo ucfirst($row["price"]), "$"; ?></h4>
                            <h5 class="list-group-item-heading"><?php echo "Pcs: ", ucfirst($row["amount"]); ?></h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php
                  }
                }
                else
                {
                  echo "Sorry. No results found.";
                }
                ?>
                
              </div>
            </div>
            

        <!-- FOOTER -->
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <footer>
            <hr>
            <p class="pull-left">&copy Alex Bondor</p>
            <p class="pull-right"><a href="#">Back to top</a></p>
          </footer>
        </div>
      </div>
    </div>
    <script>
      $(".img-rounded").elevateZoom({zoomWindowPosition: 10, zoomWindowOffetx: 10});
    </script>
  </body>
</html>