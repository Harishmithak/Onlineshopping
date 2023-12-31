<?php    
include("../common/nav.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>        
    .card-body:hover {
      background-color: lightgray; 
  }
  
  .quantity-input{

    width:50px;
  }
  
  
  </style>
</head>
<body>
    <div class="container">
        <h1>Product List</h1>
        <?php
        class Product {
            private $conn;

            public function __construct($host, $username, $password, $database) {
                $this->conn = new mysqli($host, $username, $password, $database);
                if ($this->conn->connect_error) {
                    die("Connection failed: " . $this->conn->connect_error);
                }
            }
            public function getAllProducts() {
                $sql = "SELECT * FROM Product";
                $result = $this->conn->query($sql);
                $products = [];

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $products[] = $row;
                    }
                }
                return $products;
            }
            public function displayProducts() {
                $products = $this->getAllProducts();
                if (count($products) > 0) {
                    echo "<div class='row'>";
                    foreach ($products as $product) {
                        echo "<div class='col-md-4 mb-4'>
                                <div class='card'>
                                  
                                    <div class='card-body'>

                                    <form method='post' action='cart_handler.php'>
                                    <img src='{$product['Image']}' class='card-img-top' alt='{$product['ProductName']}'>
                                    <h5 class='card-title'>{$product['ProductName']}</h5>
                                    <p class='card-text'>{$product['Description']}</p>
                                    <p class='card-text'>Product Type: {$product['ProductType']}</p>
                                    <p class='card-text'>Price: {$product['Price']}</p>
                                    <input type='number' class='quantity-input' name='quantity' value='1' min='1'><br><br>
                                    <input type='hidden' name='ProductName' value='{$product['ProductName']}'>
                                    <input type='hidden' name='ProductType' value='{$product['ProductType']}'>
                                    <input type='hidden' name='Description' value='{$product['Description']}'>
                                    <input type='hidden' name='Price' value='{$product['Price']}'>
                                    <input type='hidden' name='Image' value='{$product['Image']}'>
                                    <button type='submit' class='btn btn-primary'>Add to cart</button>
                                </form>
                                
                                
                                    </div>
                                </div>
                            </div>";
                    }
                    echo "</div>";
                } else {
                    echo "No products found.";
                }
            }
        }
        $productManager = new Product('localhost:3307','root', "CG-vak123", "mydb");
        $productManager->displayProducts();
        ?>
    </div>
</body>
</html>

