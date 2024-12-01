<?php
session_start();
require_once 'config/db.php';

// Check if the user is an admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: index.php"); // Redirect non-admins
    exit();
}

// Fetch all books from the database
$stmt = $pdo->prepare("SELECT * FROM books");
$stmt->execute();
$books = $stmt->fetchAll();

if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info">
        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>
    </div>
<?php endif; ?>


<!DOCTYPE html >
<html dir="rtl">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="icon" type="image/x-icon" href="./public/images/favicon.ico">

</head>
<body>
        <!-- Include the navbar -->
        <?php include './templates/navbar.php'; ?>

<div class="container mt-5">
    <h1>إدارة الكتب</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>العنوان</th>
                <th>الكاتب</th>
                <th>السعر</th>
                <th>الاحداث</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?php echo htmlspecialchars($book['title']); ?></td>
                    <td><?php echo htmlspecialchars($book['author']); ?></td>
                    <td><?php echo htmlspecialchars($book['price']); ?> ريال</td>
                    <td>
                        <form action="delete_book.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this book?');">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
