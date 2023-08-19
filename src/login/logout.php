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


<?php
include("../common/connect.php");
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];

    $logout_time = date('Y-m-d H:i:s');
    $sql_insert = "INSERT INTO UserLog ( logout_time) VALUES (?) WHERE id= $id ";
    $stmt_insert = $conn->prepare($sql_insert);

    if (!$stmt_insert) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt_insert->bind_param("s", $logout_time);
    if (!$stmt_insert->execute()) {
        die("Insert failed: " . $stmt_insert->error);
    }
    $stmt_insert->close();
}

session_destroy();
?>

