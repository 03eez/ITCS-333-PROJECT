<?php
session_start();
$pid=$_POST['pid'];
$qty=$_POST['qty'];
$_SESSION['cart'][$pid]=$qty;
header('location:homepage.php');
?>
