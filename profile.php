<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Profiles</title>
    <link rel="stylesheet" href="pro.css">
</head>
<body>
    <header>
        <h1>Customer Profiles</h1>
        <a href="logout.php">Logout</a>
        <a href="homepage.php">Back to home page</a>
    </header>
    <main>
        <?php
        include 'check_logn.php';
        include 'db_conn.php';

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_address'])) {
            // Handle the new address submission
            $new_address = $_POST['new_address'];
          

            $cid = $_SESSION['cid'];

           
                $insertSql = "INSERT INTO address (cid, address) VALUES (:cid, :address)";
                $insertStmt = $db->prepare($insertSql);
                $insertStmt->bindParam(':cid', $cid);
                $insertStmt->bindParam(':address', $new_address);
                $insertStmt->execute();
                echo "<p>Address added successfully!</p>";
          
            
            
        }

        try {
            $sql = "SELECT cid, cname, cusername, cemail, cphone FROM customers WHERE cid = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$_SESSION['cid']]);

            if ($stmt->rowCount() > 0) {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<h2>Customer: " . $row["cname"] . "</h2>";
                    echo "<p>Username: " . $row["cusername"] . "</p>";
                    echo "<p>Email: " . $row["cemail"] . "</p>";
                    echo "<p>Phone: " . $row["cphone"] . "</p>";

                    // Display addresses
                    $cid = $row["cid"];
                    $addressSql = "SELECT * FROM address WHERE cid = :cid";
                    $addressStmt = $db->prepare($addressSql);
                    $addressStmt->bindParam(':cid', $cid);
                    $addressStmt->execute();

                    echo "<h3>Addresses:</h3>";
                    if ($addressStmt->rowCount() > 0) {
                        echo "<ul>";
                        while ($addressRow = $addressStmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<li>" . $addressRow['address'] . "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>No addresses found.</p>";
                    }

                    // Address form
                    echo '<h3>Add New Address</h3>';
                    echo '<form method="POST" action="profile.php">';
                    echo '<input type="text" name="new_address" placeholder="Enter new address" required>';
                    echo '<button type="submit">Add Address</button>';
                    echo '</form>';

                    // Fetch and display order history for each customer
                    $orderSql = "SELECT o.oid, o.totalprice, o.status, o.`date & time`, a.address 
                                 FROM orders o 
                                 LEFT JOIN address a ON o.addid = a.addid 
                                 WHERE o.cid = :cid";
                    $orderStmt = $db->prepare($orderSql);
                    $orderStmt->bindParam(':cid', $cid);
                    $orderStmt->execute();

                    if ($orderStmt->rowCount() > 0) {
                        echo "<h3>Order History:</h3>";
                        echo "<table>";
                        echo "<tr><th>Order ID</th><th>Total Price</th><th>Status</th><th>Date/Time</th><th>Address</th></tr>";
                        while ($orderRow = $orderStmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $orderRow["oid"] . "</td>";
                            echo "<td>" . $orderRow["totalprice"] . "</td>";
                            echo "<td>" . $orderRow["status"] . "</td>";
                            echo "<td>" . $orderRow['date & time'] . "</td>";
                            echo "<td>" . $orderRow['address'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "<p>No order history found.</p>";
                    }
                }
            } else {
                echo "<p>No customers found.</p>";
            }
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage());
            die("Oops! Something went wrong. Please try again later.");
        }
        ?>
    </main>
</body>
</html>
