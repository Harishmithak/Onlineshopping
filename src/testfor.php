
<?php
session_start();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $servername = "localhost:3307";    
// $username = "root";
// $password = "CG-vak123";
// $dbname = "mydb";

//     $conn = new mysqli($servername, $username, $password, $dbname);
include("connect.php");{


    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login_time=date('Y-m-d H:i:s');

    $userType = $_POST["usertype"];



    $selectQuery = "SELECT * FROM User WHERE Username = ? AND Password = ? AND UserType=?";
    $stmt = $conn->prepare($selectQuery);
    $stmt->bind_param("sis", $username, $password,$userType);
    $stmt->execute();
    $result = $stmt->get_result();

if ($result->num_rows > 0) {

    if ($userType === "user") {
        header("Location: userproduct.php");
        exit();
    } elseif ($userType === "admin") {
        header("Location: product.php");
        exit();
    }
} else {
    echo "Login failed. Please check your username, password, and usertype.";
}


    $sql = "INSERT INTO UserLog (username, email,login_time,usertype) VALUES ('$username', '$email','$login_time','$userType')";
    
    if ($conn->query($sql) === TRUE) {

        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['login_time'] = date('Y-m-d H:i:s');
        

        if (!isset($_SESSION['login_count'])) {
            $_SESSION['login_count'] = 1;
        } else {
            $_SESSION['login_count']++;
        }
        setcookie('stored_username', $username, time() + 60, "/");
        setcookie('stored_email', $email, time() + 60, "/");

  
//    echo "login count is  :  " . $_SESSION['login_count'];
    //  header("Location: welcome.php");
    //     exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
    $conn->close();

}

?>

            <!-- <?php
            session_start();
            if (isset($_SESSION['username'])) {
                echo '<li class="nav-item"><span class="navbar-text">Welcome, ' . $_SESSION['username'] . '</span></li>';

             
               
            }
            ?>
               <?php    
    if (isset($_COOKIE['stored_username']) && isset($_COOKIE['stored_email'])) {
      $storedUsername = $_COOKIE['stored_username'];
      $storedEmail = $_COOKIE['stored_email'];
      
      echo "<p>Welcome back, $storedUsername! We're glad to see you again. </p>";
  } else {
      echo "<p>Welcome! Please sign in.</p>";
  }
?> -->

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

<?php
 include("../common/connect.php");
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $id=$_SESSION['id'];
    $sql_select = "SELECT id FROM UserLog WHERE username = ?";
    $stmt_select = $conn->prepare($sql_select);

    if (!$stmt_select) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt_select->bind_param("s", $username);
    $stmt_select->execute();
    $stmt_select->bind_result($id);

    if ($stmt_select->fetch()) {
        $stmt_select->close();

        $logout_time = date('Y-m-d H:i:s');
        $sql_update = "UPDATE UserLog SET logout_time = ? WHERE id = ?";
        
        $stmt_update = $conn->prepare($sql_update);

        if (!$stmt_update) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt_update->bind_param("si", $logout_time, $id);
        $stmt_update->execute();
        $stmt_update->close();
    } else {
        echo "No matching user found.";
    }
}

session_destroy();
?>

<button class='btn btn-primary show-more-btn' data-toggle='collapse' data-target='#description{$product['ProductCode']}' aria-expanded='false'>Show More</button>
                                        <div id='description{$product['ProductCode']}' class='collapse'>
                                            <p class='card-text'>{$product['Description']}</p>
                                        </div>

                                        <script>
$(document).ready(function() {
    $('.show-more-btn').click(function() {
        $(this).toggleClass('active');
        if ($(this).hasClass('active')) {
            $(this).text('Show Less');
        } else {
            $(this).text('Show More');
        }
    });
});
</script>


<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->