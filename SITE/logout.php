<?php 
session_start(); 
session_destroy(); 
session_unset(); 
 // end session for the user 
   
header("location:home.php"); // go back to home page 
?>