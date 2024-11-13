

<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفوف - الرئيسية</title>
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

    <!-- Hero section -->

    <section class="hero-section">
    
    <div class="container-fluid vintage-background rounded-4 d-flex justify-content-center animate__animated animate__fadeIn ">
  <div class="container d-flex row hero-section">
    <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center animate__animated animate__zoomIn ">
    <h1 class="headline">اكتشف عالماً من المعرفة</h1>
    <p class="subtitle">
    استكشف مجموعة متنوعة من الكتب التي تنقلك عبر عوالم مختلفة، من الأدب الكلاسيكي إلى العلوم الحديثة. انغمس في تجارب إنسانية غنية ومعرفة عميقة مع كل صفحة تقلبها.
    </p>
    <a href="products.php" class="btn btn-burnt-orange">تصفح الكتب</a>
    </div>

    <div class="col-lg-6 image-section d-flex justify-content-center animate__animated animate__zoomIn">
        <img src="./public/images/hero.png" class="hero-image" alt="">
    </div>
    </div>


    </div>
    </section>

    <!-- End Hero section -->

    <!-- Explore section -->
     
    <section class="explore-section ">

    <!-- Self-development books -->
    <div class="container mt-5 animate__animated animate__fadeIn ">
        <div class="row">
            <div class="col-lg-12 d-flex">
                <img src="./public/images/logo-icon.png" width="24" height="24" alt="">
                <h5 class="category-title ps-2">كتب تطوير الذات</h5>
                
            </div>
            
            <div class="col-lg-12">
                
                 <?php
                 
                 $category_id = 1; // this is for self development
                //  $category_id = 2; this is for fiction
                 include './templates/category_books.php'; ?>

            </div>

        </div>
    </div>

    <!-- novel books -->
    <div class="container mt-5 animate__animated animate__fadeIn ">
        <div class="row">
            <div class="col-lg-12 d-flex">
            <img src="./public/images/logo-icon.png" width="24" height="24" alt="">
                <h5 class="category-title ps-2">كتب الروايات </h5>
                
            </div>
            
            <div class="col-lg-12">
                
                 <?php
                 
                //  $category_id = 1; // this is for self development
                 $category_id = 2; // this is for fiction
                 include './templates/category_books.php'; ?>

            </div>
        </div>
    </div>


    </section>

    <!-- End Explore section -->





    </div>

    <!-- Footer template -->
    <?php
    include './templates/footer.php'; ?>
    <!-- End Footer template -->


    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
