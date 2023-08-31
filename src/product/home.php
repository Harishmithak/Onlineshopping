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
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="https://img.freepik.com/free-photo/black-friday-elements-assortment_23-2149074076.jpg?w=2000" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://example.com/image2.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="https://example.com/image3.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


</body>
</html>

