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
        $adress = "localhost";
        $user = "root";
        $pass = "root";
        $nameDB  = "watchstore";
        
        $conn = mysql_connect($adress, $user, $pass) or die("Cannot connect to SQL"); // connection to DB
        mysql_select_db($nameDB, $conn) or die("No such database!");

        $idRowName = $_POST['row'];
        $idToDelete = $_POST['id'];
        $table = $_POST['table'];
        $query = "DELETE FROM $table WHERE $idRowName = $idToDelete;";
        //echo $query;
        $result = mysql_query($query) or die("Element not found");
        //echo $result;


        header("location:manageDB.php"); 
    }
?>