<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/layouts/homepage/header.css">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/layouts/homepage/footer.css">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/layouts/homepage/searchbar.css">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/rule.css">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/noti.css">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/error.css">
    <link rel="shortcut icon" href="/<?= PROJECT_NAME ?>/public/images/icon/crow.png" type="image/x-icon">
    <title><?= $data['title'] ?></title>
</head>
<body>
    <!-- HEADER -->
    <?php include_once VIEW_PATH . '/layouts/parts/homepage/header.homepage.php' ?>

    <!-- MAIN CONTENT -->
    <?= $data['content']; ?>

    <!-- FOOTER -->
    <?php include_once VIEW_PATH . '/layouts/parts/homepage/footer.homepage.php' ?>
</body>
</html>