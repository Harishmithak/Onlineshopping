<?php        include("../common/nav.php");?>

<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                                    <img src='{$product['Image']}' class='card-img-top' alt='{$product['ProductName']}'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>{$product['ProductName']}</h5>
                                        <p class='card-text'>{$product['Description']}</p>
                                    
                                        <p class='card-text'>Product Type: {$product['ProductType']}</p>
                                        
                                        <p class='card-text'>Price: {$product['Price']}</p>
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

        $host = "localhost:3307";
        $username = "root";
        $password = "CG-vak123";
        $database = "mydb";

        $productManager = new Product($host, $username, $password, $database);
        $productManager->displayProducts();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

