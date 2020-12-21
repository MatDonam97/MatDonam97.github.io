<?php
class MyClass {
 private $host = "localhost"; 
 private $user = "root";
 private $password = "";
 private $database = "test";
 private $con;
 function __construct() {
 $this->con =  $this->connectDB();
 }
 function connectDB() {
 $con = mysqli_connect($this->host,$this->user,$this->password,$this>database);
 return $con;
 }
 function getData($query) { 
 $result = mysqli_query($this->conn, $query);
 while($row=mysqli_fetch_assoc($result)) { $resultset[] = $row;
 }
  if(!empty($resultset)) return $resultset;
 }
}
?>