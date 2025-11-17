<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/admin/index.css">
</head>

<body>
    <div class="main-content">
        <!--Sidebar-->
        <div class="sidebar">
            <?php include_once VIEW_PATH . '/layouts/parts/admin/sidebar.admin.php' ?>
        </div>

        <div class="dashboard-container">
            <div class="dashboard-header">
                <div class="header-text">
                    <h2>DANH SÁCH MỐC ĐÁNH GIÁ</h2>
                    <h3>WELCOME <?php echo htmlspecialchars($_SESSION['user']['last_name']) ?></h3>
                </div>

                <div class="dashboard-search-add">
                    <a href="/<?= PROJECT_NAME ?>/admin/milestones/create">Thêm mốc đánh giá</a>
                </div>
            </div>

            <?php foreach ($criterias as $criteria): ?>
                <a href="/<?= PROJECT_NAME ?>/admin/criterias/<?= $criteria['criteria_id']  ?>/milestones">Tiêu chí <?= $criteria['criteria_id']  ?>: <?= $criteria['criteria_name'] ?></a>
                <br>
            <?php endforeach; ?>
        </div>
</body>

</html>