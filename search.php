<?php
require_once 'config/db.php';
// session_start();

// Initialize cart in the session if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Calculate the number of items in the cart
$cart_count = count($_SESSION['cart']);

// Initialize variables for search
$searchedBook = null;
$relatedBooks = [];

// Check if a search query has been submitted
if (isset($_GET['q'])) {
    $query = $_GET['q'];

    // Fetch the searched book
    $stmt = $pdo->prepare("SELECT * FROM books WHERE title LIKE ?");
    $searchTerm = '%' . $query . '%';
    $stmt->execute([$searchTerm]);

    // Fetch the searched book details
    $searchedBook = $stmt->fetch();

    // If the book exists, fetch related books
    if ($searchedBook) {
        // Fetch related books (example: same category)
        $relatedStmt = $pdo->prepare("SELECT * FROM books WHERE category_id = ? AND id != ?");
        $relatedStmt->execute([$searchedBook['category_id'], $searchedBook['id']]);
        $relatedBooks = $relatedStmt->fetchAll();
    }
}
?>

<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفوف - البحث</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="icon" type="image/x-icon" href="./public/images/favicon.ico">

</head>
<body>
    <?php include './templates/navbar.php'; // Include the navbar ?>

    <div class="container mt-5 animate__animated animate__fadeIn">
        <h1>البحث عن الكتب</h1>
        <form id="search-form" class="mb-4" method="GET" action="search.php">
            <div class="input-group">
                <input type="text" class="form-control" id="search-input" name="q" placeholder="اكتب اسم الكتاب" aria-label="Search for books" value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
                <button class="btn btn-primary" type="submit">بحث</button>
            </div>
        </form>

        <div id="search-results" class="row">
            <?php if ($searchedBook): ?>
                <h2>نتائح بحث: <?php echo htmlspecialchars($searchedBook['title']); ?></h2>
                
                <!-- Display the searched book -->
                <div class="col-lg-3 col-md-6 col-sm-12 animate__animated animate__fadeIn">
                    <div class="card mb-3">
                        <img src="<?php echo htmlspecialchars($searchedBook['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($searchedBook['title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($searchedBook['title']); ?></h5>
                            <p class="card-text">الكاتب: <?php echo htmlspecialchars($searchedBook['author']); ?></p>
                            <p class="card-text">السعر: <?php echo htmlspecialchars($searchedBook['price']); ?> ريال</p>
                        </div>
                    </div>
                </div>

                <!-- Display related books -->
                <?php if ($relatedBooks): ?>
                    <h3>كتب ذات صلة:</h3>
                    <?php foreach ($relatedBooks as $book): ?>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="card mb-3">
                                <img src="<?php echo htmlspecialchars($book['image_path']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book['title']); ?>">
                                <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h5>
                            <p class="card-text">الكاتب: <?php echo htmlspecialchars($book['author']); ?></p>
                            <p class="card-text">السعر: <?php echo htmlspecialchars($book['price']); ?> ريال</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">لا توجد كتب ذات علاقة.</p>
                <?php endif; ?>
            <?php elseif (isset($_GET['q'])): ?>
                <p class="text-danger">لا توجد كتب بناءً على بحثك.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="./public/js/script.js"></script>

</body>
</html>
