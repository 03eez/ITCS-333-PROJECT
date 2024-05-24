<?php
session_start();
$pid = $_POST['pid'];
$qty = $_POST['qty'];
for ($i = 0; $i < count($pid); ++$i) {
    $_SESSION['cart'][$pid[$i]] = $qty[$i];
}
header("Location: cart.php?status=1");
?>

