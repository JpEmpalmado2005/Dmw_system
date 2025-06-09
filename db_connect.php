<?php
@session_start();

$host = 'localhost';
$dbname = 'dmw';
$user = 'root'; 
$pass = '';     

$conn = new mysqli($host, $user, $pass, $dbname);

if($conn->connect_error) {
    die("could not connect". $conn->connect_error);
}

?>