<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="staff_UpdateInv.css"> 


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
        <a href="login.php"><img id="img1" src="Images/icon.svg" alt="login page"></a>
    </header>

    <div class="home">          
    <a href="staff.php" > HOME </a>
    </div>

    <div class="cat">
        <a href="staff_UpdateInv.php"><h3>All Categories</h3></a>
        <?php
        include 'db_conn.php';
        // Fetch categories from the database
        $categorySql = "SELECT * FROM category";
        $categoryStmt = $db->query($categorySql);
        // Display categories
        while ($categoryRow = $categoryStmt->fetch(PDO::FETCH_ASSOC)) {
            $categoryId = $categoryRow['catid'];
            $categoryName = $categoryRow['catname'];
            $categoryLink = "staff_UpdateInv.php?c=" . $categoryId;
            echo "<a href='$categoryLink'><h3>$categoryName</h3></a>";
        }
        ?>
    </div>


    <form method="POST" action="staff_UpdateInv.php" class="search-form">
        <input type='hidden' name='form_id' value='form1'> 
        <input type="text" name="search" placeholder="Search..." style="display: block; margin: 0 auto;">
        <input type="submit" value="Search" style="display: block; margin: 0 auto;">
    </form>

    <?php
    try {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $display_sql = "SELECT * FROM products";
            if (isset($_GET['c'])) {
                $cat = $_GET['c'];
                $display_sql = "SELECT * FROM products WHERE catid = '$cat' "; 
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formId = $_POST['form_id'];
            if ($formId === 'form1') {
                $formId = $_POST['form_id'];
                if (isset($_POST['search']) && !empty($_POST['search'])) {
                    $search = $_POST['search'];
                    $display_sql = "SELECT * FROM products WHERE Description LIKE '%$search%'";
                }
            }
            else if ($formId === 'form2') {
                $pid = $_POST['pid'];
                $qty = $_POST['qty'];
    
                if (isset($_POST['submit']) && $_POST['submit'] == 'UPDATE') {
                    $sql = "UPDATE products SET Stock = :qty WHERE pid = :pid";
                    $display_sql = "SELECT * FROM products"; 
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':qty', $qty, PDO::PARAM_INT);
                    $stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
                    $stmt->execute();
                    echo "<script>showAlert('Stock updated successfully.')</script>";
                    
                }
            }
    
            else if ($formId === 'form3') {
                $pid = $_POST['pid'];
    
                if (isset($_POST['submit']) && $_POST['submit'] == 'REMOVE PRODUCT') {
                    $sql = "DELETE FROM products WHERE pid = :pid";
                    $display_sql = "SELECT * FROM products"; 
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
                    $stmt->execute();
                    
                    echo "<script>showAlert('Product removed successfully.')</script>";
                }
            }
        }
        $display_stmt = $db->query($display_sql);

        if ($display_stmt->rowCount() > 0) {
            echo "<table>";
            echo "<tr><th>Description</th><th>Picture</th><th>Quantity</th><th>Action</th></tr>";

            while ($row = $display_stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row["Description"] . "</td>";
                echo "<td><img width='200px' height='150px' src='images/" . $row["Picture"] . "'></td>";
                echo "<td>" . $row["Stock"] . "</td>";
                echo "<td>";

                echo "<form method='POST' action='staff_UpdateInv.php'>";
                echo " <input type='hidden' name='form_id' value='form2'>";
                echo "<input type='hidden' name='pid' value='{$row["pid"]}'>";
                echo "<input type='number' name='qty' value='1' min='0' max=''>";
                echo "<input type='submit'class='buttons' name='submit'style='margin-left=50px;' value='UPDATE'>";
                echo "</form>";

                echo "<form method='POST' action='staff_UpdateInv.php'>";
                echo " <input type='hidden' name='form_id' value='form3'>";
                echo "<input type='hidden' name='pid' value='{$row["pid"]}'>";
                echo "<input type='submit' class='buttons' name='submit' value='REMOVE PRODUCT' >";
                echo "</form>";

                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>NO RESULTS !!!</p>";
        }
    } catch (PDOException $ex) {
        echo "<script>showAlert('error occured')</script>";
        die($ex->getMessage());
    }
    ?>
</body>
</html>