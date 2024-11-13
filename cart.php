<?php


include './templates/navbar.php'; // Include the navbar


// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
?>

<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفوف - السلة</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./public/css/style.css">    
    <style>
        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        .cart-item img {
            width: 80px;
            height: auto;
            margin-right: 15px;
            border-radius: 5px;
        }
        .cart-item h5 {
            margin: 0;
        }
        .total-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #e0e0e0;
            padding-top: 15px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">سلّتك</h1>

        <?php if (count($_SESSION['cart']) > 0): ?>
            <div class="list-group mb-4">

                <!-- Calculating total price  -->
                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $book_id => $book): 
                    $subtotal = $book['price'] ;
                    $total += $subtotal;
                ?>

                <!-- Displaying cart items -->
                    <div class="list-group-item cart-item">
                        <img class="mx-3" src="<?php echo htmlspecialchars($book['image_path']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" />
                        <div class="flex-grow-1">
                            <h5><?php echo htmlspecialchars($book['title']); ?></h5>
                            <p class="mb-1 text-muted">الكاتب: <?php echo htmlspecialchars($book['author']); ?></p>
                            <p class="mb-1">السعر: <?php echo number_format($book['price'], 2); ?> ريال</p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <div class="total-section">
                <h4>السعر الاجمالي:</h4>
                <h4 class="fw-bold"><?php echo number_format($total, 2); ?> ريال</h4>
            </div>

            <form action="confirm_order.php" method="POST" class="mt-4">
                <button type="submit" class="btn btn-primary w-100">تأكيد الطلب</button>
            </form>

            <!-- if the cart is empty: -->
        <?php else: ?>
            <p class="text-muted">سلّتك فارغة.</p>
        <?php endif; ?>
    </div>
</body>
</html>
