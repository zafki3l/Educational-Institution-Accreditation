<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- SEARCH BAR -->
    <?php include VIEW_PATH . "/layouts/parts/homepage/searchbar.homepage.php" ?>

    <div class="main-content">
        <h1>Hello <?= $_SESSION['user']['last_name'] ?? 'Guest' ?></h1>
    </div>
</body>
</html>