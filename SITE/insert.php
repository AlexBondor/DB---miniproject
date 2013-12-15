<?php 
    session_start(); 
      
    $adress = "localhost";
    $user = "root";
    $pass = "root";
    $nameDB  = "watchstore";
    
    $conn = mysql_connect($adress, $user, $pass) or die("Cannot connect to SQL"); // connection to DB
    mysql_select_db($nameDB, $conn) or die("No such database!"); 

    if( !isset($_SESSION['user']) ) 
        $_SESSION['user'] = 'NO'; 
  
    if ( ($_SESSION['user']) != 'YES' ) 
    { 
    	header("location:loginPage.php"); 
    } 
    else
    { 
    	echo $_POST['table'];
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
		$result = mysql_query($query[$table]) or die("Query N/A");

		$i=0;
		$data = "";
		// compute insert string here
		while($col = mysql_fetch_field($result, $i))
    	{
    	 	$var = $_POST[$col->name];
    	 	if($var != "")
				$data .= "'" . $var . "',";
    	 	$i++;
    	}

    	$data = substr($data, 0, -1);
    	echo $data;
    	if($data != "")
    		mysql_query("INSERT INTO $table VALUES($data)")or die("Couldn't insert data!");
    	header("location:insertPage.php");  
    }
?> 