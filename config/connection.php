<?php
// used to connect to the database
$host = "eu-cdbr-azure-west-d.cloudapp.net";
$db_name = "qbandb";
$username = "bd22e1627c7160";
$password = "91bad711";

try {
    echo "working";
    $con = new mysqli($host,$username,$password, $db_name);
}
 
// show error
catch(Exception $exception){
    echo "Connection error: " . $exception->getMessage();
}
/*
 $con = new mysqli($host,$username,$password, $db_name);
 //$con = mysqli_connect($host,$username,$password, $db_name);
 // Check connection
 if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  die();
  }
   */
?>