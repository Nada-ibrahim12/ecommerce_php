<?php
$host = 'localhost';
$username = 'root';  
$password = '2512';    
$dbname = 'ecommerce';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}
