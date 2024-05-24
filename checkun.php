<?php
try {
    require 'db_conn.php';
    $q = $_GET['q'];
 
    $sql = "SELECT * FROM customers WHERE cusername = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$q]);
 
    if ($stmt->fetch()) {
        echo "taken";
    } else {
        echo "free";
    }
 
    $db = null;
} catch (PDOException $ex) {
    die($ex->getMessage());
}
?>