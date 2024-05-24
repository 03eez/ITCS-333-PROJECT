
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Staff Information </title>
        <link rel="stylesheet" href="admin_staffinfo_style.css">
        </head>
        <body>
            
<header>
        <p>HAYYAK</p>

        <a href="login.php"><img id="img1" src="Images/logout.png" alt="Logout"></a>        
    </header>
<?php

if (isset($_POST['staffinfo']))
{
    try {
        require('db_conn.php') ;
        

        $sql = "SELECT * FROM staff";
        $stmt = $db->query($sql);
        if ($stmt->rowCount() > 0)
         { 
            echo "<table align='center'>" ; 
            echo "<tr><th colspan = '6'>Staff Information</tr>" ; 
            echo "<tr><th>Staff ID</th> <th>Staff Name</th> <th>Staff Username</th> <th>Staff Email</th><th>Staff Phone Number</th> <th>Staff Position</th> </tr>" ; 
               
            while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                echo "<tr>";
                echo "<td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[5]."</td><td>".$row[6]."</td>" ; 
                echo "</tr>";
                
            }
            echo "</table>";
            echo"<a href='admin.php'> <h4>Back</h4></a>";
        }
        else {
                echo "<h2>Sorry , No staff is available!! ";
            }

}
 catch (PDOException $ex)
 {
    echo "Error occurred!"; // user-friendly message
    die($ex->getMessage());
 }
 $db = null ; 
}

?>
</body>
</html>
