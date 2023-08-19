<?php
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost:3307";    
$username = "root";
$password = "CG-vak123";
$dbname = "mydb";

    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } ?>