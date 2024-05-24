<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HAYYAK- Home Page</title>
    <link rel="stylesheet" href="cc.css">
</head>
<body>
    <header>
        <p>HAYYAK</p>
        <img id="img2" src="Images/lo.png" alt="Supermarket logo">
        <a href="profile.php"><img id="img1" src="Images/icon.svg" alt="Login page"></a>
        <a href="cart.php"><img id="basket" src="Images/basket.png" alt="Basket icon"></a>
    </header>

    <?php
    if (isset($_SESSION['activeUser'])) {
        echo "<p class='welcome'>Welcome, " . $_SESSION['activeUser'] . "!</p>";
    }
    ?>

    <div class="cat">
    <a href="homepage.php"><h3>All Categories</h3></a>
    <?php
    include 'db_conn.php';
    // Fetch categories from the database
    $categorySql = "SELECT * FROM category";
    $categoryStmt = $db->query($categorySql);
    // Display categories
    while ($categoryRow = $categoryStmt->fetch(PDO::FETCH_ASSOC)) {
        $categoryId = $categoryRow['catid'];
        $categoryName = $categoryRow['catname'];
        $categoryLink = "homepage.php?c=" . $categoryId;
        echo "<a href='$categoryLink'><h3>$categoryName</h3></a>";
    }
    ?>
    </div>

    <form method="POST" action="homepage.php" class="search-form">
        <input type="text" name="search" placeholder="Search...">
        <input type="submit" value="Search">
    </form>

    <main class="product-grid">
    <?php
    try {
        include 'db_conn.php';

        $sql = "SELECT * FROM products";
        if (isset($_GET['c'])) {
            $cat = $_GET['c'];
            $sql = "SELECT * FROM products WHERE catid = '$cat'";
        }
        if (isset($_POST['search']) && !empty($_POST['search'])) {
            $search = $_POST['search'];
            $sql .= " WHERE Description LIKE '%$search%'";
        }

        $stmt = $db->query($sql);

        if ($stmt->rowCount() > 0) {
            foreach ($stmt as $row) {
                echo "<div class='product-item'>";
                echo "<div class='product-card'>";
                echo "<div class='product-card-front'>";
                echo "<img class='product-img' src='images/" . htmlspecialchars($row["Picture"]) . "' alt='" . htmlspecialchars($row["Description"]) . "'>";
                echo "<p>" . htmlspecialchars($row["Price"]) . " bd</p>";
                if ($row["Stock"] == 0) {
                    echo "<p class='out-of-stock'>Out of Stock</p>";
                } else {
                    echo "<form method='post' action='addtocart.php'>";
                    echo "<input type='hidden' name='pid' value='" . htmlspecialchars($row["pid"]) . "'>";
                    echo "<input type='number' name='qty' value='1' min='1' max='" . htmlspecialchars($row["Stock"]) . "'>";
                    echo "<input type='submit' value='Add to Cart'>";
                    echo "</form>";
                }
                echo "</div>";  // End of front side
                echo "<div class='product-card-back'>";
                echo "<h3>Product Details</h3>";
                echo "<p>" . htmlspecialchars($row["Description"]) . "</p>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found.</p>";
        }
    } catch (PDOException $ex) {
        echo "<p>Error occurred!</p>";
        die($ex->getMessage());
    }
    ?>
</main>


    <footer>
        <div class="myAcc">
        <a href="profile.php" ><h3>My Account</h3> </a>
            <a href="login.php"><h4>Login</h4></a>
            <a href="profile.php" ><h4>Order History</h4> </a>
            
        </div>
        <div class="About">
            <h3>Support</h3>
            <a href="aboutus.php"> <h4>About Us</h4></a>
            <a href="aboutus.php"><h4>Terms & Conditions</h4></a>
            <a href="policy.php"><h4>Privacy Policy</h4></a>
            <a href="aboutus.php"><h4>Price Policy</h4></a>
        </div>
        <div class="contactus">
            <p>Address: Bahrain</p>
            <p>Call us: +973 33513715</p>
            <p>Email: 3zMarket@gmail.com</p>
        </div>
    </footer>
    
    <script>// Event listener for flipping the card when clicking the image
document.querySelectorAll('.product-img').forEach(img => {
    img.addEventListener('click', () => {
        img.closest('.product-item').classList.toggle('flip');
    });
});

// Event listener for flipping the card back when clicking anywhere on the card
document.querySelectorAll('.product-card').forEach(card => {
    card.addEventListener('click', (event) => {
        if (!event.target.closest('.product-img')) {
            card.closest('.product-item').classList.remove('flip');
        }
    });
});


    </script>


</body>
</html>
