<?php

include("../common/connect.php");

if (isset($_GET["productId"])) {
    $productId = $_GET["productId"];
    $query = "SELECT * FROM Product WHERE ProductCode = $productId";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $productData = $result->fetch_assoc();
        $conn->close();
        echo json_encode($productData);
        exit();
    }
}
?>

