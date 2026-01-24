<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Standards & Criteria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/find_evidence/sidebar.css">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/find_evidence/main.css">
</head>

<body>

    <main class="layout">
        <!-- SIDEBAR -->
        <?php include 'components/sidebar.php' ?>

        <!-- Content Area -->
        <div class="content-area">

            <!-- TITLE -->
            <div class="page-header">
                <h1>Hệ thống tìm kiếm minh chứng</h1>
                <p>Tra cứu minh chứng theo tiêu chuẩn và tiêu chí kiểm định</p>
            </div>

            <!-- SEARCH -->
            <?php include 'components/searchbar.php' ?>

            <!-- STATS -->
            <div class="stats">
                <div class="stat-card">
                    <h2>25</h2>
                    <span>Tiêu chuẩn</span>
                </div>

                <div class="stat-card">
                    <h2>250</h2>
                    <span>Tiêu chí</span>
                </div>

                <div class="stat-card">
                    <h2>2500</h2>
                    <span>Minh chứng</span>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.querySelectorAll("[data-toggle]").forEach(button => {
            button.addEventListener("click", () => {
                const target = document.getElementById(button.dataset.toggle);
                if (!target) return;

                target.classList.toggle("open");

                const icon = button.querySelector(".nav-toggle i");
                if (icon) icon.classList.toggle("rotate");
            });
        });
    </script>

</body>

</html>