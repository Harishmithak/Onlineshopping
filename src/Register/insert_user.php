<?php
$servername = "localhost:3307";
$username = "root";
$password = "CG-vak123";
$dbname = "mydb";



$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];
$usertype = $_POST['usertype'];

$sql = "INSERT INTO User (Username, Password, UserType) VALUES ('$username', '$password', '$usertype')";

if (mysqli_query($conn, $sql)) {
    echo "Registration successful!";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
