<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="staff_AddCat.css">
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

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $formId = $_POST['form_id'];
        if ($formId === 'form1') {
            try {
                include 'db_conn.php';

                $catname = $_POST['catname'];
                $sql = "INSERT INTO category (catname) VALUES (:catname)";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':catname', $catname);
                $stmt->execute();

                echo "<script>showAlert('Category added successfully!')</script>";

                $db = null; // Closing the connection
            } catch (PDOException $e) {
                echo "<script>showAlert('Connection failed: ' . {$e->getMessage()} )</script>";
            }
        } else if ($formId === 'form2') {
            try {
                include 'db_conn.php';

                $catname = $_POST['catname'];

                // Retrieve the catid based on the selected catname
                $getCatIdSql = "SELECT catid FROM category WHERE catname = :catname";
                $stmt = $db->prepare($getCatIdSql);
                $stmt->bindParam(':catname', $catname);
                $stmt->execute();
                $catId = $stmt->fetchColumn();

                // Delete products with the retrieved catid
                $deleteProductsSql = "DELETE FROM products WHERE catid = :catid";
                $stmt = $db->prepare($deleteProductsSql);
                $stmt->bindParam(':catid', $catId);
                $stmt->execute();

                // Delete the category
                $deleteCategorySql = "DELETE FROM category WHERE catname = :catname";
                $stmt = $db->prepare($deleteCategorySql);
                $stmt->bindParam(':catname', $catname);
                $stmt->execute();

                echo "<script>showAlert('Category and its associated products have been deleted successfully!')</script>";


                $db = null; // Closing the connection
            } catch (PDOException $e) {
                echo "<script>showAlert('Connection failed: ' . {$e->getMessage()} )</script>";
            }
        }
    }
    ?>

    
  

    <div class="form-container">

   
    
        <div>
            <h2>Add Category</h2>
            <form method="POST" action="staff_AddCat.php">
                <input type='hidden' name='form_id' value='form1'>
                <label for="catname">Name of The Category: </label><br><br>
                <textarea name="catname" id="catname" required></textarea><br>
                <input type="submit" class="buttons" value="Add Category">
            </form>
        </div>

        <div>
            <h2>Delete Category</h2>
            <form method="POST" action="staff_AddCat.php">
                <input type='hidden' name='form_id' value='form2'>
                <label for="catname">Select the Category to Delete: </label><br><br>
                <select name="catname" id="catname" required>
                    <?php
                    // Fetch the list of categories from the database
                    include 'db_conn.php';
                    $sql = "SELECT catname FROM category";
                    $stmt = $db->query($sql);
                    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

                    // Generate the options for the select input
                    foreach ($categories as $category) {
                        echo "<option value='$category'>$category</option>";
                    }
                    ?>
                </select><br><br>
                <input type="submit" class="buttons" value="Delete Category">
            </form>
        </div>
    </div>

</body>
</html>