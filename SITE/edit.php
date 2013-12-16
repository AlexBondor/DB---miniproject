<?php
session_start(); 
  
if( !isset($_SESSION['user']) ) 
    $_SESSION['user'] = 'NO'; 

if ( ($_SESSION['user']) != 'YES' ) // if no session -> redirect to loginPage
{ 
    header("location:loginPage.php"); 
} 
else
{
	if(isset($_POST['update'])) // if update button pressed -> update row
	{
		$adress = "localhost";
        $user = "root";
        $pass = "root";
        $nameDB  = "watchstore";
        
        $conn = mysql_connect($adress, $user, $pass) or die("Cannot connect to SQL"); // connection to DB
        mysql_select_db($nameDB, $conn) or die("No such database!");

		$idRowName = $_POST['row'];
        $idToEdit = $_POST['id'];
        $table = $_POST['table'];
        $query = "SELECT * FROM $table WHERE $idRowName = $idToEdit";
        $result = mysql_query($query) or die("Couldn't execute query!");
 		
        //compute data to insert
		$i = 0;
		while($row = mysql_fetch_array($result))
		{        
			$temp = mysql_field_name($result, $i);
			//echo $temp;
			$data = $temp . "='" . $_POST[$temp] . "'";
			$i++;
			$count =  mysql_num_fields($result);
			while($i < $count)
			{
				//$col = mysql_fetch_field($result, $i);
				$temp = mysql_field_name($result, $i);
				//echo $row[$i];
				$data = $data . ", " . $temp . "='". $_POST[$temp] . "'";
				$i++;
	    	}
		}

		//echo $data;
    	
    	$sql = "UPDATE $table SET " . $data . " WHERE $idRowName='$idToEdit'" ;
    	//echo $sql;
    	$res = mysql_query($sql) or die("Error broh");

    	//echo $res;

		//echo $idRowName,$idToEdit,$table;
		header("location:manageDB.php"); 
	}
	else // display form
	{
    	$adress = "localhost";
        $user = "root";
        $pass = "root";
        $nameDB  = "watchstore";
        
        $conn = mysql_connect($adress, $user, $pass) or die("Cannot connect to SQL"); // connection to DB
        mysql_select_db($nameDB, $conn) or die("No such database!");

        $idRowName = $_POST['row'];
        $idToEdit = $_POST['id'];
        $table = $_POST['table'];
        $query = "SELECT * FROM $table WHERE $idRowName = $idToEdit";

        $result = mysql_query($query);
		?>
		<html>
			<head>
			 	<title>CMS</title>
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<!-- Bootstrap -->
				<link href="css/bootstrap.min.css" rel="stylesheet">
			</head>
			<body>
			
				<!-- display insert form -->
				<br><br>
				<div class = "col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0" style="border-radius:4px; background-color:#dfdfdf;">
					<form method="post" action="<?php $_PHP_SELF ?>">
						<h2 class="text-center">Required data:</h2>
							<?php
							$i = 0;
							// echo "<input class='hidden' name='table' value='", $table, "'/>";
			            	while($row = mysql_fetch_array($result))
			            	{
			            		$count =  mysql_num_fields($result);
			            		while($i < $count)
			            		{
				            		if($i == 0)
				            		{
				            			echo "<input class='hidden' name='", mysql_field_name($result, $i),"' value='", $row[$i], "'/><br>";		                			
				            		}
				            		else
				            		{
										echo mysql_field_name($result, $i), "<input class='form-control' name='", mysql_field_name($result, $i),"' value='", $row[$i], "'/><br>";
									}
				            		$i++;
				            	}
			            	}
			            	?>
			            	<input class="hidden" name="row" value="<?php echo $idRowName;?>"/>
			            	<input class="hidden" name="id" value="<?php echo $idToEdit;?>"/>
			            	<input class="hidden" name="table" value="<?php echo $table;?>"/>
						<button name='update' type="submit" class="btn btn-success btn-block">Update data</button> 
			    	</form>
			    	<form action="manageDB.php">
			    		<button type="submit" class="btn btn-info btn-block">Back to Query</button> 
			    	</form>
	        	</div>
		    </body>
	    </html>
        <?php
    }
    //header("location:manageDB.php"); 
	//echo "Edit id ", $_POST['id'], " from table ", $_POST['table'];
}
?>