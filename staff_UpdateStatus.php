<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update status</title>
    <link rel="stylesheet" href="staff_UpdateStatuss.css">


    <script>
    function showAlert(message) {
        alert(message);
    }
</script>
</head>
    <header>

        <p>HAYYAK</p>
        <img id="img2" src="Images/lo.png" alt="subermarket logo">        
        <a href="login.php"> <img id="img1" src="Images/icon.svg" alt="login page"></a>        
    </header>
<body>

    <div class="home">          
    <a href="staff.php" > HOME </a>
    </div>

    <h2>Update Order Status</h2>
    <br>
    
    <form method="POST" action="staff_UpdateStatus.php">
        <label for="order_id">Order ID:</label>
        <input type="text" id="order_id" name="order_id" required><br><br>

        <label>Status:</label>
        <input type="radio" id="completed" name="status" value="In process" required>
        <label for="completed">In process</label><br>

        <input type="radio" id="pending" name="status" value="In transit" required>
        <label for="pending">In transit</label><br>
        
        <input type="radio" id="completed" name="status" value="Completed" required>
        <label for="completed">Completed</label><br>

        <input type="radio" id="completed" name="status" value="Cancelled" required>
        <label for="completed">Cancelled</label><br>

        <input type="submit" class="buttons" name="submit" value="Confirm">
    </form>

    <!-- code for updating the status -->
    <?php
    if (isset($_POST['submit'])) {
        // Get the values entered by the user
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        // Database connection
        try {
            include 'db_conn.php';

            // Update the status of the order
            $sql = "UPDATE orders SET status = :status WHERE oid = :order_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':order_id', $order_id);
            $stmt->execute();

            echo "<script>showAlert('Order status updated successfully.')</script>";
        } catch (PDOException $e) {
            echo "<script>showAlert('Connection failed: ' . {$e->getMessage()} )</script>";
        }

        $db = null; // Closing the connection
    }
    ?>
</body>
</html>