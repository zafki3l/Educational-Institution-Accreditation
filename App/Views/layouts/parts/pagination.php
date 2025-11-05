<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/layouts/pagination.css">
    <title>Document</title>
</head>
<body>
    <div class="pagination">
        <?php if (isset($_GET['search'])): ?>
            <?php if ($current_page > 1): ?>
                <a href="?search=<?= $_GET['search'] ?>&page=<?= $current_page - 1 ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?search=<?= $_GET['search'] ?>&page=<?= $i ?>"><?= $i ?></a>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages): ?>
                <a href="?search=<?= $_GET['search'] ?>&page=<?= $current_page + 1 ?>">Next</a>
            <?php endif; ?>
        <?php else: ?>
            <?php if ($current_page > 1): ?>
                <a href="?page=<?= $current_page - 1 ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i ?>"><?= $i ?></a>
            <?php endfor; ?>

            <?php if ($current_page < $total_pages): ?>
                <a href="?page=<?= $current_page + 1 ?>">Next</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>