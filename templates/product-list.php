<?php
require_once 'config/db.php';

// Fetch books from the database
$stmt = $pdo->query("SELECT * FROM books");
$books = $stmt->fetchAll();
?>

<div class="row">
    <?php foreach ($books as $book): ?>
        <div class="col-lg-2 col-md-6 col-sm-6 d-flex">
            <div class="card w-100 my-2 shadow-2-strong">
                <img src="<?php echo $book['image_path']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book['title']); ?>" />
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h5>
                    <p class="card-text">الكاتب: <?php echo htmlspecialchars($book['author']); ?></p>
                    <p class="card-text">السعر: <?php echo htmlspecialchars($book['price']); ?> ريال</p>
                    <p class="card-text"><?php echo htmlspecialchars($book['description']); ?></p>
                    <div class="card-footer d-flex align-items-end pt-3 px-0 pb-0 mt-auto">
                        <form action="add_to_cart.php" method="POST">
                            <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>" />
                            <button type="submit" class="btn btn-primary shadow-0 me-1 main-color-bg">اضف الى السلة</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
