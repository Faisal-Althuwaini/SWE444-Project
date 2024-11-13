<?php
// session_start(); // Start the session
include './templates/navbar.php'; // Include the navbar

// Database connection
$host = 'localhost'; // Change if necessary
$user = 'root'; // Change if necessary
$password = ''; // Change if necessary
$dbname = 'bookstore_db'; // Your database name

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch books from the database
$sql = "SELECT * FROM books";
$result = $conn->query(query: $sql);

?>

<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفوف - تصفح</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="icon" type="image/x-icon" href="./public/images/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="shortcut icon" href="./public/images/favicon.ico" type="image/x-icon">


</head>
<body>

<div class="container mt-5 animate__animated animate__fadeIn">
    <div class="d-flex align-items-center justify-content-center col-lg-12 mb-4">
    <img src="./public/images/logo-icon.png" width="32" height="32" alt="">
    <h2 class="ps-2 ">تصفح الكتب</h2> 
    </div>
    <div class="row">
    <?php include './templates/product-list.php'; ?>

    </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
