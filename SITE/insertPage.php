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
		              <li><a href="manageDB.php">Query Database</a></li>
		              <li class="active"><a href="#">Insert Data</a></li>
		            </ul>
		            <form class="navbar-form navbar-right" action="logout.php">
		              <button type="submit" class="btn btn-danger"><strong>Log out</strong></button>
		            </form>
		          </div><!-- /.navbar-collapse -->
		        </nav>


		        <!-- TITLE -->
		        <br>
		        <div class = "row">
		          	<h1 class = "text-center">Watches Store <small><i>Database</i></small></h1>
		        </div>
		        <br>
		        <br>
				<?php
				// database connection
		        $adress = "localhost";
	            $user = "root";
	            $pass = "root";
	            $nameDB  = "watchstore";
	            
	            $conn = mysql_connect($adress, $user, $pass) or die("Cannot connect to SQL"); // connection to DB
	            mysql_select_db($nameDB, $conn) or die("No such database!");

	            $sql = "SHOW TABLES FROM $nameDB";
				$result = mysql_query($sql);

				if (!$result){
        			header("location:error.php");
				}?>
				<!-- select table dropdown -->
		        <form method="post">
		            <div class = "col-lg-5 col-lg-offset-3 col-md-5 col-md-offset-3 col-sm-5 col-sm-offset-3 col-xs-8 col-xs-offset-1">
				        <select id="table" name="table" class="form-control input-md">
							<option selected >Select table</option>
							<?php
							while ($row = mysql_fetch_row($result)) {
							    echo "<option value='", $row[0], "'>",  ucfirst($row[0]), "</option>";
							}?>
						</select>
		            </div>
		            <div class = "col-lg-2 col-md-2 col-sm-3 col-xs-3">
						<button type="submit" class="btn btn-default">Get form</button> 
					</div>
				</form>
				<br>
				<?php
				mysql_free_result($result);
		        
				if(isset($_POST['table']) && $_POST['table'] != "Select table")
				{
					$table = $_POST['table'];
					$query = array(
		              // select brand
		              "brand" => "SELECT brand_id, brand_name AS Brand FROM brand",
		              // select category
		              "category" => "SELECT category_id, category_name AS Category FROM category",
		              // select customers
		              "customers" => "SELECT customer_id, first_name AS FirstName, last_name AS LastName, birthday, email, country, city, address FROM customers",
		              // select order_details
		              "order_detail" => "SELECT * FROM order_detail",
		              // select orders
		              "orders" => "SELECT * FROM orders",
		              // select watches
		              "watches" => "SELECT * FROM watches"
              		);

              		//for getting max id from table
					$result = mysql_query($query[$table]);
					if(!$result)
        				header("location:error.php");
					$idRow = mysql_field_name($result, 0);
					$temp = "SELECT MAX(". $idRow. ") FROM $table";
					$res = mysql_query($temp);
					$maxId = mysql_fetch_array($res);

					//maxId[0] is the maximum id in table $table

					$i = 0;
					?>
					<!-- display insert form -->
					<form method="post" action="insert.php">
						<br><br>
						<div class = "col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0" style="border-radius:4px; background-color:#dfdfdf;">
							<h2 class="text-center">Required data:</h2>
							<?php
							echo "<input class='hidden' name='table' value='", $table, "'/>";
		                	while($col = mysql_fetch_field($result, $i))
		                	{
		                		if($i == 0)
		                		{

		                			echo "<input class='hidden' name='id' value='", $maxId[0] + 1, "'/><br>";		                			
		                		}
		                		else
									echo "<input class='form-control' name='", $col->name ,"' placeholder='", ucfirst($col->name), "'/><br>";
		                		$i++;
		                	}
		                	?>
						<button type="submit" class="btn btn-success btn-block">Insert data</button> 
						<br>
	                	</div>
                	</form>
                	<?php
				}
		        ?>
	      		</br>
				</br>
			</div>
		</div>
	</body>
</html>

<?php
}
?>