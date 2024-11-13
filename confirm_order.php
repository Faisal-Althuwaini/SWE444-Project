<?php
session_start();

// Check if the cart is not empty
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {

    // Clear the cart
    unset($_SESSION['cart']);

    // Redirect to the success page
    header("Location: success.php");
    exit();
} else {
    // Redirect to the cart page if no items in the cart
    header("Location: cart.php");
    exit();
}
?>
