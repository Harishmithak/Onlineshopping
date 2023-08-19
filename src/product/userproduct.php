<?php
include("../common/nav.php");

include("../common/connect.php");

$productQuery = "SELECT * FROM Product";
$productResult = $conn->query($productQuery);

$userQuery = "SELECT * FROM User";
$userResult = $conn->query($userQuery);

?>


<html>
<head>
    <title>Product and User Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

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

        .card {
            margin: 20px;
            width: 18rem;
            display: inline-block;
        }

        img.card-img-top {
            max-height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Product Details</h2>
        <div class="row">
            <?php while ($productRow = $productResult->fetch_assoc()): ?>
                <div class="card">
                    <img class="card-img-top"  src="<?= $productRow['Image'] ?>" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?= $productRow['ProductName'] ?></h5>
                        <p class="card-text"><?= $productRow['Description'] ?></p>
                        <p class="card-text">Price: <?= $productRow['Price'] ?></p>
 
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>

</html>
