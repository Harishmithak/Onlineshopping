<?php
// session_start();
include("../common/nav.php");

include("../common/connect.php");
$productQuery = "SELECT * FROM Product";
$productResult = $conn->query($productQuery);

$userQuery = "SELECT * FROM UserLog";
$userResult = $conn->query($userQuery);

?>

<html>
<head>
    <title>Product and User Details</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        h2 {
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin-left:150px;
            margin-top: 10px;
            background-color: white;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }

     #prod{
        text-align:center;
     }
     #use{
        text-align:center;
     }
     .current-user-row {
        background-color: lightblue; 
        color: black; 
    }

    </style>
<script>
function editProduct(productId) {
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           var response = JSON.parse(this.responseText);
            
          
            document.getElementById('editProductId').value = response.ProductCode;
            document.getElementById('editProductName').value = response.ProductName;
            document.getElementById('editProductType').value = response.ProductType;
            document.getElementById('editDescription').value = response.Description;
            document.getElementById('editQuantity').value = response.Quantity;
            document.getElementById('editPrice').value = response.Price;
            document.getElementById('editImage').value = response.Image;
            
           
            $('#editProductModal').modal('show');
        }
    };
    
    xmlhttp.open("GET", "edit_product.php?productId=" + productId, true);
    xmlhttp.send();
}

// function deleteProduct(productId) {
//     if (confirm('Are you sure you want to delete this product?')) {
//         var xmlhttp = new XMLHttpRequest();
        
//         xmlhttp.onreadystatechange = function() {
//             if (this.readyState == 4 && this.status == 200) {
            
//                 document.getElementById('productRow_' + productId).remove();
//             }
//         };
//         xmlhttp.open("POST", "delete_product.php", true);
//         xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//         xmlhttp.send("productId=" + productId);
//     }
// }
function deleteProduct(productId){
    if (confirm('Are you sure you want to delete this product?')) {
        var xmlhttp = new XMLHttpRequest();
    
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
             console.log(this.responseText);
          }
        };
        xmlhttp.open('GET','delete_product.php?productId='+productId,true);
        xmlhttp.send();
    }
    }

</script>
</head>
<body>


<div class="container">
    <h2 id="prod">Product Details</h2>
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addProductModal">
        Add New Product
    </button>

    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <label>Product Name: <input type="text" name="ProductName"></label><br>
                        <label>Product type: <input type="text" name="ProductType"></label><br>
                        <label>Product description: <input type="text" name="Description"></label><br>
                        <label>Product quantity: <input type="text" name="Quantity"></label><br>
                        <label>Product price: <input type="text" name="Price"></label><br>
                        <label>Product image: <input type="text" name="Image"></label><br>
                        <input type="submit" value="Add Product">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <table>
        <tr>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Product Type</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Image</th>
            <th>Edit</th>
        <th>Delete</th>
        </tr>
        <?php while ($productRow = $productResult->fetch_assoc()): ?>
            <tr>
                <td><?= $productRow['ProductCode'] ?></td>
                <td><?= $productRow['ProductName'] ?></td>
                <td><?= $productRow['ProductType'] ?></td>
                <td><?= $productRow['Description'] ?></td>
                <td><?= $productRow['Quantity'] ?></td>
                <td><?= $productRow['Price'] ?></td>
                <td><img src="<?= $productRow['Image'] ?>" width="50" height="50" alt="Product Image"></td>
    
                <td><button class="btn btn-primary edit-product-btn" onclick="editProduct(<?= $productRow['ProductCode'] ?>)">Edit</button></td>

        <td><button class="btn btn-danger delete-product-btn" onclick="deleteProduct(<?= $productRow['ProductCode'] ?>)">Delete</button></td>

            </tr>
        <?php endwhile; ?>
    </table>

    <h2 id='use'>User Log Details</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>email</th>
            <th>login_time</th>
            <th>usertype</th>
            <th>logout_time</th>
        </tr>
        <?php while ($userRow = $userResult->fetch_assoc()): ?>
            <tr <?php if (empty($userRow['logout_time'])) echo 'class="current-user-row"'; ?>>
            <!-- <tr> -->
                <td><?= $userRow['id'] ?></td>
                <td><?= $userRow['username'] ?></td>
                <td><?= $userRow['email'] ?></td>
                <td><?= $userRow['login_time'] ?></td>
                <td><?= $userRow['usertype'] ?></td>
                <td><?= $userRow['logout_time'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- Within the <body> section of your HTML -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="update_product.php">
                    <input type="hidden" name="productId" id="editProductId"> <!-- Store the product ID for updating -->
                    <label>Product Name: <input type="text" name="ProductName" id="editProductName" ></label><br>
                    <label>Product type: <input type="text" name="ProductType" id="editProductType"></label><br>
                    <label>Product description: <input type="text" name="Description" id="editDescription"></label><br>
                    <label>Product quantity: <input type="text" name="Quantity" id="editQuantity"></label><br>
                    <label>Product price: <input type="text" name="Price" id="editPrice"></label><br>
                    <label>Product image: <input type="text" name="Image" id="editImage"></label><br>
                    <input type="submit" value="Update Product">
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

 <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ProductName = $_POST["ProductName"];
    $ProductType = $_POST["ProductType"];
    $Description = $_POST["Description"];
    $Quantity = $_POST["Quantity"];
    $Price= $_POST["Price"];
    $Image= $_POST["Image"];

    $insertQuery = "INSERT INTO Product (ProductName,ProductType,Description,Quantity ,Price,Image) 
                    VALUES ( '$ProductName', ' $ProductType','$Description ',' $Quantity ',' $Price','$Image')";
    if ($conn->query($insertQuery) === TRUE) {

        exit();
    } else {
        echo "Error adding product: " . $conn->error;
    }
}
?> 


