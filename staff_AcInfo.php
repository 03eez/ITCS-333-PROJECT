<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Page</title>
    <link rel="stylesheet" href="staff_AcInfo.css">
    
</head>
<body>
    <header>
        <p>HAYYAK</p>
        <img id="img2" src="Images/lo.png" alt="supermarket logo">        
    </header>

       
    <div class="home">          
    <a href="staff.php" > HOME </a>
    </div>

    <div class="cards-container">
        <?php
        session_start();

        if (!isset($_SESSION['susername'])) {
            header("Location: login.php");
            exit();
        }

        $susername = $_SESSION['susername'];

        try {
            $db = new PDO("mysql:host=localhost; dbname=333tst; charset=utf8", 'root', '');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM staff WHERE susername = :susername";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':susername', $susername);
            $stmt->execute();
            $staff = $stmt->fetchAll(PDO::FETCH_ASSOC);


           
            echo "<h2>Account Information:</h2>";
            

            if ($staff) {
                foreach ($staff as $staffinfo) {
                    echo "<div class='card'>";
                    echo "<h3>Name: {$staffinfo['sname']}</h3>";
                    echo "<p><strong>Username:</strong> {$staffinfo['susername']}</p>";
                    echo "<p><strong>E-mail:</strong> {$staffinfo['semail']}</p>";
                    echo "<p><strong>Phone:</strong> {$staffinfo['sphone']}</p>";
                    echo "<p><strong>Position:</strong> {$staffinfo['position']}</p>";
                    echo "</div>";
                }
            } else {
                echo "No staff member found.";
            }

            $db = null; // Closing the connection
        } catch (PDOException $e) {
            echo "<script>showAlert('Connection failed: ' . {$e->getMessage()} )</script>";
        }
        ?>
    </div>

    <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
