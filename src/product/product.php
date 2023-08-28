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
    
        <td><button class="btn btn-primary edit-product-btn" data-toggle="modal" data-target="#editProductModal" data-product-id="<?= $productRow['ProductCode'] ?>">Edit</button></td>
            <td><button class="btn btn-danger delete-product-btn" data-product-id="<?= $productRow['ProductCode'] ?>">Delete</button></td>
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


