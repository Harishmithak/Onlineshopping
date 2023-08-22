

<?php
session_start();
include("../common/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $usertype = $_POST['usertype'];

    $query = "SELECT UserType FROM User WHERE Username = ? AND Password = ?";
    
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error in preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $stmt->bind_result($userType);
    $stmt->fetch();
    $stmt->close();

    if ($userType === 'user' || $userType === 'admin') {
        $_SESSION['usertype'] = $usertype;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['login_time'] = date('Y-m-d H:i:s');
        if (!isset($_SESSION['login_count'])) {
            $_SESSION['login_count'] = 1;
        } else {
            $_SESSION['login_count']++;
        }
 
        setcookie('stored_username', $username, time() + 6, "/");
        setcookie('stored_email', $email, time() + 6, "/");
        
  
        
        $login_time = date('Y-m-d H:i:s'); 
        $insert_query = "INSERT INTO UserLog (username, email, login_time, usertype) VALUES (?, ?, ?, ?)";
        
        $insert_stmt = $conn->prepare($insert_query);
        if (!$insert_stmt) {
            die("Error in preparing insert statement: " . $conn->error);
        }
        
        $insert_stmt->bind_param("ssss", $username, $email, $login_time, $usertype);
        $insert_stmt->execute();
        $insert_stmt->close();

        if ($usertype === 'user') {
            header('Location: ../product/new.php');
            exit();
        } elseif ($usertype === 'admin') {
            header('Location: ../product/product.php');
            exit();
        }
    } else {
     
    }
}
?>

