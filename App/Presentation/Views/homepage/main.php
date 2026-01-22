<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Standards & Criteria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/homepage.css">
    
</head>
<body>
    <div class="homepage-container">
        <!-- SIDEBAR -->
        <?php include 'sidebar.php' ?>

        <div class="main-content">
            <!-- Content Area -->
            <div class="content-area">
                <?php include 'searchbar.php' ?>
                
                <?php include 'introduction.php' ?>
            </div>
        </div>
    </div>

    <script src="/<?= PROJECT_NAME ?>/public/js/homepage.js"></script>
</body>
</html>
