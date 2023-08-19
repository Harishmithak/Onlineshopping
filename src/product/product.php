<?php
include("../nav.php");
// $servername = "localhost:3307";    
// $username = "root";
// $password = "CG-vak123";
// $dbname = "mydb";

// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
include("../connect.php");


$productQuery = "SELECT * FROM Product";
$productResult = $conn->query($productQuery);

$userQuery = "SELECT * FROM User";
$userResult = $conn->query($userQuery);

?>


<html>
<head>
    <title>Product and User Details</title>
    
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

    </style>


</head>
<body>
    <h2 id ='prod'>Product Details</h2>
    <h2>Add New Product</h2>
    <form method="post" action=" ">
   
    <label>Product Name: <input type="text" name="ProductName"></label><br>
    <label>Product type: <input type="text" name="ProductType"></label><br>
    <label>Product description: <input type="text" name="Description"></label><br>
    <label>Product quantity: <input type="text" name="Quantity"></label><br>
    <label>Product price: <input type="text" name="Price"></label><br>
    <label>Product image: <input type="text" name="Image"></label><br>
  
  
    <input type="submit" value="Add Product">
</form>
    <table>
        <tr>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Product Type</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Image</th>
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
            </tr>
        <?php endwhile; ?>
    </table>

    <h2 id='use'>User Details</h2>
    <table>
        <tr>
            <th>UID</th>
            <th>Username</th>
            <th>Password</th>
            <th>User Type</th>
        </tr>
        <?php while ($userRow = $userResult->fetch_assoc()): ?>
            <tr>
                <td><?= $userRow['UID'] ?></td>
                <td><?= $userRow['Username'] ?></td>
                <td><?= $userRow['Password'] ?></td>
                <td><?= $userRow['UserType'] ?></td>
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


