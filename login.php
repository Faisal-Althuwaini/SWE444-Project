<?php
require_once 'config/db.php';
session_start();

// If a user is already logged in (i.e., their user_id is set in the session), they are redirected to the index.php page. This prevents logged-in users from seeing the login form again.

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// The script checks if the request method is POST, which indicates that the login form has been submitted. It retrieves the submitted username and password.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL statement to fetch user data
    // prepare(): This method prepares an SQL statement for execution. 
    // By using prepare(), you are creating a template for the SQL statement, which helps prevent SQL injection attacks. 
    // The ? placeholder is used for binding parameters later.
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");

    // execute(): This method executes the prepared statement. It takes an array of parameters to replace the placeholders defined in the prepare() method. In this case, the array contains the $username variable.
    // [$username]: This array contains a single element, which is the value of the $username variable. When execute() is called, PDO replaces the ? in the prepared statement with the value of $username.
    $stmt->execute([$username]);

    $user = $stmt->fetch();

    // Check if user exists and password is correct
    if ($user && password_verify($password, $user['password'])) {
        // Store user information in the session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username']; // Optional: Store username if needed
        $_SESSION['is_admin'] = $user['is_admin']; // Store admin status

        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفوف - تسجيل الدخول</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <link rel="icon" type="image/x-icon" href="./public/images/favicon.ico">

</head>
<body>
    <!-- Navbar -->
    <?php include 'templates/navbar.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">تسجيل الدخول</h1>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">الاسم</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">الرقم السري</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">تسجيل دخول</button>
                </form>
                <p class="mt-3 text-center">ليس لديك حساب؟ <a href="register.php">سجل هنا</a>.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'templates/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
