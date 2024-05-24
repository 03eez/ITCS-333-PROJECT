
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="AdminStyle.css">
    <script>
    function showAlert(message) {
        alert(message);
    }
</script>

</head>
<body>
<header>
        <p>HAYYAK</p>
      
        <a href="login.php"><img id="img1" src="Images/logout.png" alt="Logout"></a>        
    </header>
<main>
 <div class="Admin">
        <h3><a href="homepage.php" visited="white" >Home Page </a></h3>
        <h3>Create Account for Staff</h3>
        <div class="admin-group">   
        <form method="post" >
          <label for="Staffname">Staff name:</label>
          <input type="text" id="Staffname" name="Staffname" pattern="[a-zA-z]{3,20}$" placeholder="Enter Staffname(3-12 characters)" required>
        </div>
        <br>
        <div class="admin-group">   
            <label for="Staffusername">Staff username:</label>
            <input type="text" id="Staffusername" name="Staffusername" pattern="^[a-z0-9_.]{3,12}$" placeholder="Enter StaffUsername (3-12 characters)" required>
        </div>
        <br>
        <div class="admin-group">   
            <label for="Staffemail">Staff email:</label>
            <input type="text" id="Staffemail" name="Staffemail" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-z]{,31}$" placeholder="XXXXX@domain.com" required>
        </div>
        <br>
        <div class="admin-group">   
            <label for="Staffpass">Staff password:</label>
            <input type="text" id="Staffpass" name="Staffpass" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z0-9_#@%\*\-]{8,24}$" placeholder="Enter Staffpassword" required>
        </div>
        <br>
        <div class="admin-group">   
            <label for="Staffphone">Staff phone:</label>
            <input type="text" id="Staffphone" name="Staffphone" pattern="^((\+|00)973\s?)?[3617][0-9]{7}$" placeholder="Enter Staffphonenumber" required>
        </div>
        <br>
        <div class="admin-group">   
            <label for="Staffposition">Staff position:</label>
            <input type="text" id="Staffposition" name="Staffposition" placeholder="Enter Staffposition" required>
        </div>
            <button type="submit" name="createAcc" >Create Staff Account</button>
    </form>
      <form method ="post"  action = "admin_staffinfo.php">
     <button type="submit" name="staffinfo" >View Staff Information </button>
     <br>  
    </form> 

</div>    
<?php

if(isset ($_POST["createAcc"]))
{
    try{
         
    require('db_conn.php') ;
        
    $staffname = $_POST["Staffname"] ; 
    $staffusername = $_POST["Staffusername"] ; 
    $staffemail = $_POST["Staffemail"] ; 
    $staffpassword = $_POST["Staffpass"] ; 
    $staffphone = $_POST["Staffphone"] ; 
    $staffposition = $_POST["Staffposition"] ; 

    $hashpass = password_hash($staffpassword,PASSWORD_DEFAULT);

    if ($staffusername == 'admin' || $staffposition == 'admin'  ) { 
        echo "The username or position 'admin' is not allowed for staff accounts";
        exit;
     }

     $sql = "INSERT INTO staff (sname, susername, semail, spass, sphone , position) VALUES ('$staffname', '$staffusername', '$staffemail', '$hashpass','$staffphone' ,'$staffposition')";

            $result = $db->exec($sql);

        if ($result == 1)
        {
            echo "<br><div class='staffadded'>" ; 
       
            echo "<script>showAlert('$staffname was added successfully')</script>";
  
            echo "<br>" ; 
        }
           
    }

catch (PDOException $ex) {
    echo "<script>showAlert('Connection failed: ' . {$e->getMessage()} )</script>";

}

$db = null ; 
}
?>

</main >
</body>
</html>



