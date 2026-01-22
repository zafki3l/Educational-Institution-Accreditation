<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/homepage.css">

    <style>
        .content-area {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
        }
        .content {
            display: flex;
            flex: 1;
            width: 100%;
            height: 100%;
        }
        embed {
            width: 100%;   
            height: 100%;
            border: none;
        }
    </style>
</head>

<body>
    <div class="homepage-container">
        <!-- SIDEBAR -->
        <?php include 'sidebar.php' ?>

        <!-- MAIN CONTENT -->
        <main class="main-content">
            <!-- Content Area -->
            <div class="content-area">
                <div class="content">
                    <embed src="/<?= PROJECT_NAME ?>/public/assets/evidences/<?= $link ?>"></embed>
                </div>
            </div>
        </main>
    </div>
<script src="/<?= PROJECT_NAME ?>/public/js/homepage.js"></script>
</body>

</html>