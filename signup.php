<?php
// Start session at the beginning
session_start();
 
// Check if the form is submitted
if (isset($_POST["submit"])) {
    try {
        require 'db_conn.php';
 
        $name = $_POST['name'];
        $username = $_POST['username'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
 
        $hashpass = password_hash($password,PASSWORD_DEFAULT);

        $sql = "INSERT INTO customers (cname, cusername, cpass, cemail, cphone) VALUES (?, ?, ?, ?, ?)";
 
        $stmt = $db->prepare($sql);
        $stmt->execute([$name, $username, $hashpass, $email, $phone]);
        $cid = $db->lastInsertId();
 
        // Set session variables
        $_SESSION['cusername'] = $username;
        $_SESSION['cid'] = $cid;
        $_SESSION['activeUser'] = $username;
 
        // Redirect to homepage after successful registration
        header("Location: homepage.php");
        exit();
    } catch (PDOException $ex) {
        echo "An error occurred: " . $ex->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="sign.css">
    <style>
        /* Add any additional styles here */
        #unmsg {
            padding: 8px;
            font-weight: bold;
            width: fit-content;
            border-radius: 10px;
            background-color: grey;
        }
        #unmsg.red {
            color: red;
        }
        #unmsg.green {
            color: darkgreen;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form action="#" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" placeholder="write your name" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" id="txt1" onkeyup="checkUN(this.value)" pattern=".{3,20}" placeholder="username length must be from 3 to 20" required>
                <p id="unmsg"></p>
            </div>
            <div class="form-group">
                <label for="phone">Phone number:</label>
                <input type="tel" pattern="^((\+|00)973\s?)?[3617][0-9]{7}$" name="phone" placeholder="+973 33333333" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="example@gmail.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" pattern="(?=.*[A-Z]).{8,}" placeholder="8 or more digits and at least one capital character" required>
            </div>
            <button type="submit" name="submit" id="sign">Sign Up</button>
            <p>Already have an account?</p>
            <a href="login.php" style="font-size: small;">Go to login</a>
            <a href="homepage.php" style="font-size: small;">Go to Homepage</a>
        </form>
    </div>
 
    <script>
    function checkUN(str) {
        if (str.length < 2) {
            updateMessage("Type more than 2 characters!", "red");
            return;
        }
        if (str.length > 20) {
            updateMessage("Must be less than 20 characters!", "red");
            return;
        }
        const xhttp = new XMLHttpRequest();

        const signUpButton = document.getElementById("sign");

        xhttp.onload = function() {
            if (this.responseText == "taken") {
                updateMessage("Not Available", "red");
                document.getElementById("sign").disabled = true; // Disable Sign Up button
            } else {
                updateMessage("Available", "green");
                document.getElementById("sign").disabled = false; // Enable Sign Up button
            }
        };

        xhttp.open("GET", "checkun.php?q=" + str, true);
        xhttp.send();
    }
 
    function updateMessage(msg, color) {
        const unmsg = document.getElementById("unmsg");
        unmsg.textContent = msg;
        unmsg.className = color;
    }

    // Disable form submission if Sign Up button is disabled
    document.getElementById("signupForm").addEventListener("submit", function(event) {
        if (document.getElementById("sign").disabled) {
            event.preventDefault(); // Prevent form submission
        }
    });
    </script>
</body>
</html>