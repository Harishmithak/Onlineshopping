<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>

        body {
            font-family: Arial, sans-serif;
        }

        .navbar {
            margin-bottom: 20px;
        }

        .navbar-brand {
            font-size: 24px;
        }

        .navbar-nav .nav-item {
            margin-right: 10px;
        }

        .navbar-text {
            font-size: 18px;
        }

        .welcome-message {
            font-size: 18px;
            color: yellow;
            margin-right: 120px;
        }

        .logout-link {
            font-size: 18px;
            color: #E91E63;
            margin-right: 120px;
  
 
        }

 
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  
        <a class="navbar-brand" href="#">ShopClues</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="../product/home.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../product/userproduct.php">products</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../login/loggedin.html">login</a>
            </li>
           

          </ul>
        </div>
        <?php
    session_start();
    if (isset($_SESSION['username'])) {
        echo '<div class="welcome-message m-0">Welcome, ' . $_SESSION['username'] . '</div>';
    }

    if (isset($_COOKIE['stored_username']) && isset($_COOKIE['stored_email'])) {
        $storedUsername = $_COOKIE['stored_username'];
      
        echo '<script>alert("We\'re glad to see you again: ' . $_COOKIE['stored_username'] . '")</script>';

    } 
    ?>
        <li class="nav-item">
            <a class="logout-link m-0" href="../login/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
      </nav>
    
     </body>
</html>
