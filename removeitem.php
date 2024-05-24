<?php 
session_start();
unset($_SESSION["cart"][$_GET["pid"]]); 
header("location:cart.php");
?>
