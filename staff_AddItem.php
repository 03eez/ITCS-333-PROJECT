<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="vv.css">
    <link rel="stylesheet" href="staff_AddItem.css">


    <script>
    function showAlert(message) {
        alert(message);
    }
</script>

            


</head>
<body>
    <header>
        <p>HAYYAK</p>
        <img id="img2" src="Images/lo.png" alt="supermarket logo">        
        <a href="login.php"> <img id="img1" src="Images/icon.svg" alt="login page"></a>
    </header>

    <div class="home">          
    <a href="staff.php" > HOME </a>
    </div>

    <h2>Add Item</h2>
    <form method="POST" action="staff_AddItem.php" enctype="multipart/form-data">
        <label for="description">Name and Description of the product: </label>
        <textarea name="description" id="description" required></textarea><br><br>
        <?php
        try {
            include 'db_conn.php';

            $sql = "SELECT * FROM category";
            $stmt = $db->query($sql);
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo '<label for="catid">Category:  </label>';
            echo '<select name="catid" id="catid" required>';
            echo '<option value="" disabled selected>Select a category</option>'; // Added message
            foreach ($categories as $category) {
                $catid = $category['catid'];
                $categoryName = $category['catname'];
                echo '<option value="' . $catid . '">' . $categoryName . '</option>';
            }
            echo '</select><br>';

            $db = null; // Closing the connection
        } catch (PDOException $e) {
            echo "<script>showAlert('Connection failed: ' . {$e->getMessage()} )</script>";
        }
        ?>
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" required><br><br>
        <label for="stock">Stock:</label>
        <input type="number" name="stock" id="stock" required><br><br>
        <label for="picture">Picture:</label>
        <input type="file" name="picture" id="picture" required><br><br>
        <input type="submit" class="buttons" value="Add Item">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            include 'db_conn.php';

            $catid = $_POST['catid'];
            $price = $_POST['price'];
            $stock = $_POST['stock'];
            $picture = $_FILES['picture']['name'];
            $description = $_POST['description'];

            // Move the uploaded picture to a folder
            $targetDir = "images/";
            $targetFile = $targetDir . basename($_FILES['picture']['name']);
            move_uploaded_file($_FILES['picture']['tmp_name'], $targetFile);

            $sql = "INSERT INTO products (catid, price, stock, picture, description) VALUES (:catid, :price, :stock, :picture, :description)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':catid', $catid);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':picture', $picture);
            $stmt->bindParam(':description', $description);
            $stmt->execute();

            
            echo "<script>showAlert('Item added successfully!!')</script>";

            $db = null; // Closing the connection
        } catch (PDOException $e) {
            echo "<script>showAlert('Connection failed: ' . {$e->getMessage()} )</script>";
        }
    }
    ?>
</body>
</html>