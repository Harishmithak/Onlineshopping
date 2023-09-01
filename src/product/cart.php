<?php
session_start();
$sessionUsername = $_SESSION['username'];
include("../common/connect.php");
$grandTotal = 0; 
?>
<head>
    <title>Cart Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
<?php
$sql = "SELECT * FROM Cart WHERE username = '$sessionUsername'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Cart ID</th>
                <th>Product Name</th>
                <th>Product Type</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Image</th>
                <th>Total Price</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["cartid"] . "</td>
                <td>" . $row["ProductName"] . "</td>
                <td>" . $row["ProductType"] . "</td>
                <td>" . $row["Description"] . "</td>
                <td>" . $row["quantity"] . "</td>
                <td>₹" . $row["Price"] . "</td>
                <td><img src='" . $row["Image"] . "'></td>
                <td>₹" . ($row["quantity"] * $row["Price"]) . "</td>
            </tr>";
        $grandTotal += ($row["quantity"] * $row["Price"]);
    }
    echo "<tr>
            <td colspan='8' style='text-align: right;'><strong>Grand Total:</strong></td>
            <td>₹" . $grandTotal . "</td>
          </tr>";
    
    echo "</table>";
} else {
    echo "No results found.";
}
$conn->close();
?>
</body>
</html>

