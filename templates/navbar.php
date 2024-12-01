<?php

// Start the session only if it's not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize cart in the session if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = []; // Set to an empty array if it doesn't exist
}



?>
<head>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />


</head>
<nav class="navbar navbar-expand-lg animate__animated animate__fadeIn">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="./public/images/logo.png" width="128" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="products.php">تصفح</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="search.php">البحث</a>
                </li>

                <?php if (isset($_SESSION['user_id'])): // Check if user is logged in ?>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php" id="cart-icon">
                            <i class="bi bi-cart"></i> السلة 
                            <span class="badge btn-primary "><?php echo count($_SESSION['cart']); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <a class="nav-link" href="login.php">تسجيل الدخول</a>
                    <?php else: ?>
                        <a class="nav-link" href="logout.php">تسجيل الخروج</a>
                    <?php endif; ?>
                </li>

                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="add_book.php">اضافة كتاب</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">حذف كتاب</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
