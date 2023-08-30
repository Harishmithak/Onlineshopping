<?php

include("../common/connect.php");
if (isset($_REQUEST["productId"])) {
    $productId = $_REQUEST["productId"];
    $deleteQuery = "DELETE FROM Product WHERE ProductCode = $productId";
    
    if ($conn->query($deleteQuery) === TRUE) {
        
        header("Location: product.php");
        exit();
    } else {
      
        header("Location: product.php?error=delete_error");
        exit();
    }
}
?>


