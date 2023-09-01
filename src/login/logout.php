<?php
include("../common/connect.php");
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $logout_time = date('Y-m-d H:i:s');

    $sql_update = "UPDATE UserLog SET logout_time = ? WHERE username = ?";
    $stmt_update = $conn->prepare($sql_update);

    if (!$stmt_update) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt_update->bind_param("ss", $logout_time, $username);
    if (!$stmt_update->execute()) {
        die("Update failed: " . $stmt_update->error);
    }
    $stmt_update->close();
}

session_destroy();
header('Location: ../login/loggedin.html');
?>

