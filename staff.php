<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff page</title>
    <link rel="stylesheet"  href="staffnew.css">

<body>
    <header>
        <p>HAYYAK</p>
        <img id="img2" src="Images/lo.png" alt="subermarket logo">        
        <a href="staff_Acinfo.php"> <img id="img1" src="Images/icon.svg" alt="login page"></a>        
    </header>

<body>


<h1>WELCOME TO THE STAFF PAGE</h1>



<ul>
    <li ><a href="staff_UpdateStatus.php">Update the order status</a></li>
    <li ><a href="staff_UpdateInv.php">Update Inventory</a></li>
    <li ><a href="staff_AddCat.php">Add Category</a></li>
    <li ><a href="staff_AddItem.php">Add Item</a></li>
</ul>


<div class="Orders">

<h2>All Orders</h2>
<?php
try {
    include 'db_conn.php';

    $sql = "SELECT * FROM orders";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr>";
    echo "<th>Order ID</th>";
    echo "<th>Customer ID</th>";
    echo "<th>Address ID</th>";
    echo "<th>Total Price</th>";
    echo "<th>Status</th>";
    echo "<th>Date/Time</th>";
    echo "</tr>";

    foreach ($orders as $order) {
        echo "<tr>";
        echo "<td>{$order['oid']}</td>";
        echo "<td>{$order['cid']}</td>";
        echo "<td>{$order['addid']}</td>";
        echo "<td>{$order['totalprice']}</td>";
        echo "<td>{$order['status']}</td>";
        echo "<td>{$order['date & time']}</td>";
        echo "</tr>";
    }

    echo "</table>";

    $db = null; // Closing the connection
} catch (PDOException $e) {
    echo "<script>showAlert('Connection failed: ' . {$e->getMessage()} )</script>";
}
?>
</div>


</body>
</html> 
