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
            echo "<table border='1'>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Product Type</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>";

            foreach ($products as $product) {
                echo "<tr>
                        <td>{$product['ProductCode']}</td>
                        <td>{$product['ProductName']}</td>
                        <td>{$product['ProductType']}</td>
                        <td>{$product['Description']}</td>
                        <td>{$product['Quantity']}</td>
                        <td>{$product['Price']}</td>
                        <td><img src='{$product['Image']}' alt='{$product['ProductName']}' width='100'></td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "No products found.";
        }
    }

    public function __destruct() {
        $this->conn->close();
    }
}

$host = "localhost:3307";
$username = "root";
$password = "CG-vak123";
$database = "mydb";

$productManager = new Product($host, $username, $password, $database);
$productManager->displayProducts();
?>
