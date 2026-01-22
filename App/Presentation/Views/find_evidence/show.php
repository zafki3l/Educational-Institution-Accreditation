<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/find_evidence/sidebar.css">

    <style>
        .layout {
            display: flex;
            height: 100vh;
        }

        .content-area {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 100%;
        }
        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
        }

        embed {
            width: 100%;   
            height: 100vh;
            border: none;
        }
    </style>
</head>

<body>
    <main class="layout">
        <!-- SIDEBAR -->
        <?php include 'components/sidebar.php' ?>

        <!-- Content Area -->
        <div class="content-area">
            <div class="content">
                <embed src="/<?= PROJECT_NAME ?>/public/assets/evidences/<?= $link ?>"></embed>
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