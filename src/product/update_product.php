<?php

include("../common/connect.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["productId"];
    $ProductName = $_POST["ProductName"];
    $ProductType = $_POST["ProductType"];
    $Description = $_POST["Description"];
    $Quantity = $_POST["Quantity"];
    $Price = $_POST["Price"];
    $Image = $_POST["Image"];

  
    $updateQuery = "UPDATE Product SET ProductName='$ProductName', ProductType='$ProductType', Description='$Description', Quantity='$Quantity', Price='$Price', Image='$Image' WHERE ProductCode='$productId'";
    if ($conn->query($updateQuery) === TRUE) {

        header("Location: product.php");
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>
