<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/staff/index.css">

    <style>
        .content {
            display: flex;
            justify-content: center;
            justify-items: center;
        }
        embed {
            width: 800px;   
            height: auto;
            border: none;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <!--Sidebar-->
        <div class="sidebar">
            <?php include_once VIEW_PATH . '/layouts/parts/staff/sidebar.staff.php' ?>
        </div>

        <div class="content">
            <embed  src="/<?= PROJECT_NAME ?>/public/images/evidences/<?= $link ?>"></embed >
        </div>
    </div>
</body>

</html>