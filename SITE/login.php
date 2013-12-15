<?php 
 
   session_start(); 
   set_time_limit(0); 
   error_reporting(E_ALL); 
 
   $adress="localhost"; 
   $user="root"; 
   $password="root"; 
   $DBname="phplogin"; 
     
   $connect=mysql_connect($adress, $user, $password) or die("Cannot connect"); 
   mysql_select_db($DBname, $connect); 
 
   ob_start(); 
 
   $user=$_POST['username']; // get username from form 
   $password=$_POST['password']; // get password from form 
     
   $user=htmlentities($user); 
   $password=htmlentities($password); 
     
   $querry="SELECT * FROM users WHERE username = '$user' AND password = '$password' "; 
   $result = mysql_query($querry); 
     
   if(mysql_num_rows($result) == 1) // if user exists in databasse 
   { 
       $_SESSION['user'] = 'YES'; 
       header("location:manageDB.php"); // proceed to admin.page 
   } 
   else
   {    
       header("location:loginPage.php"); // if not, return to login page 
   } 
     
?>