<!DOCTYPE html>
<html>
  <head>
    <title>Watches Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
              <li><a href="manageDB.php">Manage Database</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </nav>

        <?php
        if(isset($_POST['searchQuery']) && $_POST['searchQuery'] != "")
        {
          $search = true;
          $searchquery = preg_replace('#[^a-z A-Z0-9$]#i', '', $_POST['searchQuery']);
          $sqlCommand = "SELECT brand_name, name, gender, amount, price FROM watches JOIN brand ON watches.brand_id=brand.brand_id WHERE brand_name LIKE '%$searchquery%' OR name LIKE '%$searchquery%' OR gender LIKE '%$searchquery%' OR price LIKE '%$searchquery%'";
        }
        else
        {
          $sqlCommand = "SELECT brand_name, name, gender, amount, price FROM watches JOIN brand ON watches.brand_id=brand.brand_id";
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
              3 => "SELECT DISTINCT gender AS Gender FROM watches",
              );

            ?>
            <!-- display filter menu -->
            <form method="post">
              <div class="col-lg-4 col-md-4 col-sm-5 col-xs-4">
                <?php
                $i = 0;
                $j = 0;
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
                          <input type = "checkbox" id = "<?php echo $j; ?>" value = "ham" />
                          <?php
                            $j++;
                            echo ucfirst($row[0]);
                          ?>
                        </div>
                      </ul>
                    <?php
                    }
                  $i++;
                 } 
                ?>
              </div>
            </form>

            <!-- display watches list -->
            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-8">
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
                          <img class="img-rounded" src="images/default.png" alt="no image">
                        </div>
                        <br>
                        <div class="col-lg-10 col-md-9 col-sm-8 xol-xs-7">
                          <div class="pull-left">
                            <h4 class="list-group-item-heading"><?php $j++; echo ucfirst($row["name"]); ?></h4>
                            <h5 class="list-group-item-heading"><?php echo ucfirst($row["brand_name"]), ", ", ucfirst($row["gender"]); ?></h5>
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
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src = "js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src = "js/bootstrap.js"></script>
  </body>
</html>