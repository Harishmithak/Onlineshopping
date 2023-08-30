<?php
include("../common/nav.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Website</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>

    .jumbotron {
      background-image: url('https://images.pexels.com/photos/2680270/pexels-photo-2680270.jpeg?auto=compress&cs=tinysrgb&w=600');
      background-size: cover;
      color: white;
      text-align: center;
      padding: 100px 0;
    }
    .product-container {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
    }
    .product-card {
      border: 1px solid #ddd;
      padding: 20px;
      margin: 10px;
      text-align: center;
    }
  </style>
</head>
<body>

<div class="jumbotron">
  <h1>Welcome to Our Shopping Website</h1>
  <p>Discover a wide range of products for all your needs.</p>
  <a class="btn btn-primary" href="new.php">Shop Now</a>
</div>
</body>
</html>
