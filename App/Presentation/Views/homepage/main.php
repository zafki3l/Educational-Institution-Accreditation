<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/homepage/main.css">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/homepage/banner.css">
</head>
<body>
    <main>
        <?php include 'components/banner.php' ?>

        <?php include 'components/introduction.php' ?>

        <?php include 'components/features.php' ?>

        <?php include 'components/actions.php' ?>
    </main>
</body>
</html>