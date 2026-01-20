<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/admin/dashboard/main.css">
</head>

<body>
    <div class="main-content">
        <div class="dashboard-grid">
            <?php include 'components/user_infor.php' ?>

            <?php include 'components/system_overview.php' ?>

            <?php include 'components/standard_evaluation_management.php' ?>

            <?php include 'components/user_management.php' ?>

            <?php include 'components/report_section.php' ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/oop-bookstore/public/js/chart.js"></script>
</body>

</html>