<?php
require_once 'config/db.php'; // Include your database connection
include './templates/navbar.php'; // Include the navbar

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    // If not admin, redirect to home page or another appropriate page
    header("Location: home.php");
    exit();
}

$categories = [
    1 => 'تطوير الذات',  // Self-Development
    2 => 'خيال',         // Fiction
    3 => 'رواية'
    // Add more categories as needed
];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image_path = $_POST['image_path']; // Assuming you enter the image URL directly

    // Insert the new book into the database
    $stmt = $pdo->prepare("INSERT INTO books (title, author, description, price, category_id, image_path, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$title, $author, $description, $price, $category_id, $image_path]);

    $message = '<div class="alert alert-success">تم اضافة الكتاب!</div>';
    echo $message;
}
?>

<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفوف - اضافة كتاب</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="icon" type="image/x-icon" href="./public/images/favicon.ico">

</head>

<?php
// Display alert message if set
if (isset($_SESSION['message'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            ' . htmlspecialchars($_SESSION['message']) . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    unset($_SESSION['message']); // Clear the message after displaying it
}
?>
<body>
    <div class="container mt-5">
        <h1>اضافة كتاب جديد</h1>
        <form method="POST" action="">
    <div class="mb-3">
        <label for="title" class="form-label">العنوان</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">الكاتب</label>
        <input type="text" class="form-control" id="author" name="author" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">الوصف</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">السعر (بالريال)</label>
        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="category_id" class="form-label">الصنف</label>
        <select class="form-control" id="category_id" name="category_id" required>
            <option value="" disabled selected>اختر الصنف</option> 
            <?php foreach ($categories as $id => $name): ?>
                <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($name); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="image_path" class="form-label">رابط الصورة</label>
        <input type="text" class="form-control" id="image_path" name="image_path" required>
    </div>
    <button type="submit" class="btn btn-primary">إضافة كتاب</button>
</form>

    </div>
</body>
</html>
