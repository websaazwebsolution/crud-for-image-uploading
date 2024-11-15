<?php 

$servername = "localhost";  
$username = "root";
$password = "";
$dbname = "bookstoredb";


$conn = new mysqli($servername, $username, $password, $dbname);


if($conn ->connect_error){
    die("connection failed".$mysql ->connect_error);
}

?>