<?php
require_once 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the username or email already exists
    $checkStmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $checkStmt->execute([$username, $email]);
    $existingUser = $checkStmt->fetch();

    if ($existingUser) {
        $error = "Username or email already exists. Please choose a different one.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $password, $email])) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $stmt->errorInfo()[2];
        }
    }
}
?>

<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفوف - تسجيل حساب جديد</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="icon" type="image/x-icon" href="./public/images/favicon.ico">

</head>
<body>

<!-- Include the navbar -->
<?php include './templates/navbar.php'; ?>


    <div class="container mt-5">
    <div class="row justify-content-center">
    <div class="col-md-6">
    <h1 class="text-center">تسجيل حساب جديد</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="register.php">
            <div class="mb-3">
                <label for="username" class="form-label">الاسم</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Tariq" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">الايميل</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="example@gmail.com" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">الرقم السري</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">تسجيل</button>
        </form>
        <p class="mt-3 text-center">لديك حساب؟ <a href="login.php">سجل دخول هنا</a>.</p>

    </div>
    </div>
    </div>

    <!-- Footer -->
    <?php include 'templates/footer.php'; ?>


</body>
</html>
