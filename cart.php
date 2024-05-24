<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <link rel="stylesheet"  href="pro.css">
<body>
    
    <header>

        <p>HAYYAK</p>
    
       
    </header>

    



     <main>
      <a href="homepage.php"> <h3>  back to home page</h3> </a> 
     <?php
session_start();

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    try {
        require('db_conn.php');
    } catch (PDOException $ex) {
        die($ex->getMessage());
    }

    if (isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 1:
                echo "<h3 style='color:red;text-align:center'>Cart Updated</h3>";
                break;
            case 2:
                echo "<h3 style='color:red;text-align:center'>Cart Item Removed</h3>";
                break;
        }
    }

    echo "<table align='center' border='2'>";
    echo "<tr><th>Description</th><th>Price</th><th>Picture</th><th>Qty</th><th>Remove?</th></tr>";
    echo "<form method='post' action='update.php'>";

    // Retrieve and display cart items
    foreach ($_SESSION['cart'] as $pid => $qty) {
        try {
            $sql = "SELECT * FROM products where pid = $pid";
            $stmt = $db->query($sql);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }

        if ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $row["Description"] . "</td>";
            echo "<td>" . $row["Price"] . " BD</td>";
            echo "<td><img width='100px' height='100px' src='images/" . $row["Picture"] . "'></td>";
            echo "<td>";
            echo "<select name='qty[]'>";
            for ($i = 1; $i <= $row['Stock']; ++$i) {
                echo "<option ";
                if ($i == $qty) echo "selected ";
                echo ">$i</option>";
            }

            echo "</select>";
            echo "<input type='hidden' name='pid[]' value='$pid' />";
            echo "</td>";
            echo "<td><a href='removeitem.php?pid=$pid'><img id='remove' class='remove-icon' width='60px' height='60px' src='images/remove.png'></a></td>";
            echo "</tr>";
        }
    }

    echo "<tr><th colspan='5'><input name='sbtn' type='submit' value='Update All' /></th></tr>";
    echo "</form>";
    echo "</table>";

    // Check if the customer has addresses
    if (isset($_SESSION['cid'])) {
        $cid = $_SESSION['cid'];
        $addressSql = "SELECT * FROM address WHERE cid = :cid";
        $addressStmt = $db->prepare($addressSql);
        $addressStmt->bindParam(':cid', $cid);
        $addressStmt->execute();

        // Display address selection or prompt to add new address
        if ($addressStmt->rowCount() > 0) {
            echo "<form method='post' action='checkout.php'>";
            echo "<label for='address'>Select Address:</label>";
            echo "<select name='address' id='address'>";
            while ($addressRow = $addressStmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $addressRow['addid'] . "'>" . $addressRow['address'] . "</option>";
            }
            echo "</select>";
            echo "<input type='submit' name='sbtn' value='Checkout' />";
            echo "</form>";
        } else {
            echo "<p>You have no addresses saved. Please <a href='profile.php'>add a new address</a> before proceeding.</p>";
        }
    } else {
        echo "<div class='msg'>";
        die("You need to <a href='login.php'>login first</a>.");
        echo "</div>";
    }

    $db = null;
} else {
    echo "<h1 style='color:red;text-align:center'>The cart is empty!</h1>";
}
?>




</main>



</body>
</html>