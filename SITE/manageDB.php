<!DOCTYPE html>
<?php 
  
    session_start(); 
      
    if( !isset($_SESSION['user']) ) 
        $_SESSION['user'] = 'NO'; 
  
    if ( ($_SESSION['user']) != 'YES' ) 
    { 
        header("location:loginPage.php"); 
    } 
    else
    { 
      
?> 
<html>
  <head>
    <style type="text/css">
           form, form div { display: inline; }
    </style>
    <title>CMS</title>
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
              <li><a href="watches.php">Watches</a></li>
              <li class="active"><a href="#">Query Database</a></li>
              <li><a href="insertPage.php">Insert Data</a></li>
            </ul>
            <form class="navbar-form navbar-right" action="logout.php">
              <button type="submit" class="btn btn-danger"><strong>Log out</strong></button>
            </form>
          </div><!-- /.navbar-collapse -->
        </nav>


        <!-- TITLE -->
        <div class = "row">
          </br>
          <h1 class = "text-center">Watches Store <small><i>Database</i></small></h1>
          </br>
          </br>
        </div>

      </br>
        
        <!-- SQL QUERY -->
        <div class = "row">
          <div class = "col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <form method = "post">
              <div class = "col-lg-5 col-lg-offset-3 col-md-5 col-md-offset-3 col-sm-5 col-sm-offset-2 col-xs-8">
                <textarea name = "query" class = "form-control" rows = "5" placeholder = "<?php echo $_POST['query'] == "" ? 'Write SQL query here..' : $_POST['query']?>"></textarea>
              </div>
              <div class = "col-lg-2 col-md-2 col-sm-3 col-xs-3">
                <input type="submit" class="btn btn-danger btn-block" value="Execute!"/>
                </br>
                <!-- <button class="btn btn-success btn-block">Insert</button> -->
                <!-- <button type="button" class="btn btn-success btn-block" onclick="window.location.href='insert.php'">Insert!</button> -->
              </div>
            </form>
          </div>
        </div>

      </br>

        <?php  
          if(isset($_POST['query'])) //takes value from query input form
          {
            $adress = "localhost";
            $user = "root";
            $pass = "root";
            $nameDB  = "watchstore";
            
            $conn = mysql_connect($adress, $user, $pass) or die("Cannot connect to SQL"); // connection to DB
            mysql_select_db($nameDB, $conn) or die("No such database!");

            $query = $_POST['query']; // take query from the input form
            $result = mysql_query($query);

        ?>

    <?php
      if(mysql_num_fields($result) > 0)
      {
      ?>
      <!-- TABLE VALUES HERE -->         
      <div class = "row">
        <div class = "col-lg-12 col-lg-offset-0 col-md-10 col-md-offset-1 col-xs-10 col-xs-offset-1">
          <h4><strong>Requested information: <?php echo mysql_num_rows($result);?> results</strong></h4>
          <hr>
              <div class = "table-responsive">
                <table class = "table table-striped cf">
                  <thead>
                    <tr>
                      <th><strong>TOOLS</strong></th>
                      <?php
                      $i = 0;
                      while($i < mysql_num_fields($result))
                      {
                        $col = mysql_fetch_field($result, $i);
                        ?>
                          <th>
                            <?php
                          echo strtoupper($col->name);
                            ?>
                          </th>
                        <?php
                        $i++;
                       } 
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($row = mysql_fetch_array($result))
                    {
                    ?>
                    <tr>
                        <?php
                        $i = 0;
                        while($i <= mysql_num_fields($result))
                        {
                          if($i == 0)
                          {
                            echo "<td style='width:70px'>                                  
                                    <form method='post' action='edit.php'>
                                      <div>
                                        <input class='hidden' name='id' value='", $row[0],"'>
                                        <input class='hidden' name='table' value='", mysql_field_table($result, 0),"'>
                                        <input class='hidden' name='row' value='", mysql_field_name($result, 0),"'>
                                        <button type='submit' class='btn btn-warning btn-xs'><span class='glyphicon glyphicon-edit'></span></button>
                                      </div>
                                    </form>
                                    <form method='post' action='remove.php'>
                                      <div>
                                        <input class='hidden' name='id' value='", $row[0],"'>
                                        <input class='hidden' name='table' value='", mysql_field_table($result, 0),"'>
                                        <input class='hidden' name='row' value='", mysql_field_name($result, 0),"'>
                                        <button type='submit' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span></button>
                                      </div>
                                    </form>
                                  </td>";
                          }                          
                          else
                          {
                            echo "<td>", ucfirst($row[$i-1]), "</td>";
                          }     
                          $i++;
                        } 
                        ?>
                    </tr>
                    <?php
                    } 
                    ?>     
                  </tbody>    
                </table>
              </div>

          <?php
            mysql_free_result($result); 
            }
          ?>    
          </div>
        </div>
        <?php
        }
        ?>

      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src = "js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src = "js/bootstrap.js"></script>

    <!-- redirect to edit or delete -->
    <script type="text/javascript">
    </script>
  </body>
</html>
<?php 
    } 
?> 