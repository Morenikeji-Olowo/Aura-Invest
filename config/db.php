<?php 
$username = 'root';
$password = '';
$database = 'aiproject';
$host = 'localhost';

$conn = new mysqli($host, $username, $password, $database);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}


header('Content-Type: application/json'); 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');



?>