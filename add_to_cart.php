<?php
session_start();
require_once 'config/db.php'; // Include your database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if the book ID is provided
if (isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];

    // Fetch book details from the database
    $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->execute([$book_id]);
    $book = $stmt->fetch();

    // Check if the book exists
    if ($book) {
        // Initialize the cart if it doesn't exist
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add the book to the cart (if not already present)
        $_SESSION['cart'][$book_id] = [
            'title' => $book['title'],
            'author' => $book['author'],
            'price' => $book['price'],
            'image_path' => $book['image_path'],
            'quantity' => 1 // Set initial quantity to 1
        ];

        echo "Book added to cart successfully!";
    } else {
        echo "Book not found!";
    }
} else {
    echo "No book ID provided!";
}

// Redirect back to the same page
header("Location: " . $_SERVER['HTTP_REFERER']);


exit();


?>
