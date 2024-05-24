<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="logn.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" pattern=".{4,12}" title="Username must be between 4 and 12 characters" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <p>Do not have an account?</p>
            <a  href="signup.php" style="font-size: small;">Create a new account</a>
        </form>
        <button onclick="location.href='homepage.php'" class="homepage-button">Go to Homepage</button>
    </div>
</body>
</html>

<?php
session_start();

try {
    include 'db_conn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Query to check staff credentials
        $query = "SELECT * FROM staff WHERE susername = :username AND spass = :password";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Set session variables for the logged-in staff
            $_SESSION['susername'] = $result['susername'];
            $_SESSION['sid'] = $result['sid'];
            $_SESSION['position'] = $result['position'];

            if ($result['position'] === 'admin') {
                header("Location: admin.php");
                exit();
            } else {
                header("Location: staff.php");
                exit();
            }
        } else {
            // Query to check customer credentials
            $query = "SELECT * FROM customers WHERE cusername = :username AND cpass = :password";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Set session variables for the logged-in customer
                $_SESSION['cusername'] = $result['cusername'];
                $_SESSION['cid'] = $result['cid'];
                header("Location: homepage.php");
                $_SESSION['activeUser'] = $username;  
                exit();
            } 
            else {
                header("Location: login.php?error=1");
                echo("wrong username or password");
                exit();
            }
        }
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
