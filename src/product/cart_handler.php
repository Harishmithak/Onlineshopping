<?php

session_start();
include("../common/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["ProductName"];
    $productType = $_POST["ProductType"];
    $description = $_POST["Description"];
    $quantity = $_POST["quantity"];
    $price = $_POST["Price"];
    $image = $_POST["Image"];
    if (isset($_SESSION["username"])) {
        $username = $_SESSION["username"];
        $sql = "INSERT INTO Cart (ProductName, ProductType, Description, quantity, Price, Image, username)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiiss", $productName, $productType, $description, $quantity, $price, $image, $username);
        if ($stmt->execute()) {
            echo "Product added to cart successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "User is not logged in. Please log in to add products to the cart.";
    }
    $conn->close();
}
?>
