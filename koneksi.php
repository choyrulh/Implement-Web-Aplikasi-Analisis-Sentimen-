<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "dataset";

$conn = mysqli_connect($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>
