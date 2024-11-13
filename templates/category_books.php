<?php
require_once 'config/db.php';

// Check if the category_id is set
if (isset($category_id)) {
    // Fetch books based on the provided category_id
    $stmt = $pdo->prepare("SELECT * FROM books WHERE category_id = :category_id LIMIT 6");
    $stmt->execute(['category_id' => $category_id]);
    $books = $stmt->fetchAll();
} else {
    // If no category_id is provided, handle accordingly 
    $books = []; // Or you can fetch all books
}
?>

<div class="row">
    <?php if (!empty($books)): ?>
        <?php foreach ($books as $book): ?>
            <div class="col-lg-2 col-md-6 col-sm-6 d-flex">
                <div class="card w-100 my-2 shadow-2-strong">
                    <img src="<?php echo $book['image_path']; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($book['title']); ?>" />
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-bold"><?php echo htmlspecialchars($book['title']); ?></h5>
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
    <?php else: ?>
        <p>لا توجد كتب في هذا الصنف.</p>
    <?php endif; ?>
</div>
