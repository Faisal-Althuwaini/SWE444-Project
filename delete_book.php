<?php
session_start();
require_once 'config/db.php';

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: index.php"); // Redirect non-admins
    exit();
}

// Check if the book ID is provided
if (isset($_POST['book_id'])) {
    $book_id = $_POST['book_id'];

    // Delete the book from the database
    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$book_id]);

    // Redirect back to the admin dashboard with a success message
    $_SESSION['message'] = "Book deleted successfully!";
    header("Location: admin_dashboard.php");
    exit();
} else {
    // Redirect back if no book ID is provided
    $_SESSION['message'] = "No book selected for deletion!";
    header("Location: admin_dashboard.php");
    exit();
}
?>
