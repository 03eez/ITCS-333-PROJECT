<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
    <link rel="stylesheet"  href="pro.css">
</head>
<body>
    
</body>
</html>
<?php
session_start();

if (isset($_POST['sbtn']) && $_POST['sbtn'] == 'Update All') {
    header('Location: cart.php?status=1');
    exit();
} else {
    try {
        require('db_conn.php');

        // Initialize total price
        $totalPriceFormatted = 0;

        // Calculate the total price
        foreach ($_SESSION['cart'] as $pid => $qty) {
            $sql = "SELECT Price FROM products WHERE pid = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$pid]);
            $price = $stmt->fetchColumn();

            if ($price) {
                $totalPriceFormatted += $price * $qty;
            }
        }

        // Insert order details into the orders table
        $db->beginTransaction();
        $datetime = date('Y-m-d H:i:s');
        $sql = "INSERT INTO orders (cid, totalprice, status, `date & time`, addid) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$_SESSION['cid'], $totalPriceFormatted, 'order placed', $datetime, $_POST['address']]);
        $orderId = $db->lastInsertId();
        $db->commit();

        // Output the receipt
        echo "<h1>Receipt</h1>";
        echo "<table>";
        echo "<tr><th>Description</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";

        foreach ($_SESSION['cart'] as $pid => $qty) {
            // Retrieve product details
            $sql = "SELECT * FROM products WHERE pid = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$pid]);

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $productId = $row["pid"];
                $quantity = $_SESSION['cart'][$productId];
                $price = $row["Price"];
                $total = $quantity * $row["Price"];

                // Display receipt
                echo "<tr>";
                echo "<td>" . $row["Description"] . "</td>";
                echo "<td>$" . $price . "</td>";
                echo "<td>" . $quantity . "</td>";
                echo "<td>$" . $total . "</td>";
                echo "</tr>";

                // Update product stock in database
                $newStock = $row['Stock'] - $quantity;
                $updateSql = "UPDATE products SET Stock = ? WHERE pid = ?";
                $updateStmt = $db->prepare($updateSql);
                $updateStmt->execute([$newStock, $pid]);

                // Insert into order_items table
                $insertSql = "INSERT INTO order_items (oid, pid, qty, price) VALUES (?, ?, ?, ?)";
                $insertStmt = $db->prepare($insertSql);
                $insertStmt->execute([$orderId, $pid, $quantity, $price]);
            }
        }
        $TOTALWITHCHARGE= $totalPriceFormatted+ 1.5;
        echo "<tr><td colspan='4' style='text-align: center'>Total Price: " . $totalPriceFormatted . " BD</td></tr>";
        echo "<tr><td colspan='4' style='text-align: center'>Total Price with delivery charges(1.5) : " . $TOTALWITHCHARGE . " BD</td></tr>";


        echo "</table>";
        echo "<h3 style='color:green;text-align:center'>Order Placed Successfully</h3>";
        echo "<p style='text-align:center'><a href='homepage.php'>Back to Home Page</a></p>";

        unset($_SESSION['cart']);

    } catch (PDOException $e) {
        $db->rollBack();
        die($e->getMessage());
    }
}
?>



<!-- $db->beginTransaction();
        $customerId = 3; // Assuming you have the customer ID from session
        $totalPrice = 0; // Initialize total price

        foreach ($_SESSION['cart'] as $pid => $qty) {
            $sql = "SELECT * FROM products WHERE pid = $pid";
            $stmt = $db->query($sql);
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $totalPrice += $row['Price'] * $qty; // Calculate total price
            }
        }

        $status = 'Order Placed';
        $datetime = date('Y-m-d H:i:s'); // Current date/time

        $sql = "INSERT INTO orders (cid, totalprice, status, `date & time`) 
        VALUES (?, ?, ?, ?)";




$stmt = $db->prepare($sql);
$stmt->execute([$customerId, $totalPrice, $status, $datetime]);

        $orderId = $db->lastInsertId(); 

    

        $db->commit();
        unset($_SESSION['cart']);
        echo "<h3 style='color:green;text-align:center'>Order Placed</h3>";
        echo "<h3 style='color:black;text-align:center'><a href='products.php'>View Products</a></h3>";
    } 
}





 