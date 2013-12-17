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
              <li class="active"><a href="#">Home</a></li>
              <li><a href="watches.php">Watches</a></li>
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


      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="images/1st.png">
            <div class="carousel-caption">
            </div>
          </div>
          <div class="item">
            <img src="images/2nd.png">
            <div class="carousel-caption">
            </div>
          </div>
          <div class="item">
            <img src="images/3rd.png">
            <div class="carousel-caption">
            </div>
          </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
      </div>

        
      <footer>
        <hr>
        <p>&copy Alex Bondor</p>
      </footer>


      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src = "js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src = "js/bootstrap.js"></script>
  </body>
</html>