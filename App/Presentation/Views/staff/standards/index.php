<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/staff/index.css">
</head>
<body>
    <div class="main-content">
        <!--Sidebar-->
        <div class="sidebar">
            <?php include_once VIEW_PATH . '/layouts/parts/staff/sidebar.staff.php' ?>
        </div>

        <div class="content">
            <!-- DASHBOARD HEADER -->
            <div class="content-header">
                <div class="header-text">
                    <h2>CẬP NHẬT TIÊU CHUẨN</h1>
                    <h3>ADMIN DASHBOARD</h3>
                </div>
            </div>

            <!-- DASHBOARD USER MANAGEMENT TABLE -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>MÃ TIÊU CHUẨN</th>
                            <th>TÊN TIÊU CHUẨN</th>
                            <th>CREATED AT</th>
                            <th>UPDATED AT</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($standards as $standard): ?>
                            <tr>
                                <td><?= htmlspecialchars($standard['id']) ?></td>
                                <td><?= htmlspecialchars($standard['name']) ?></td>
                                <td><?= htmlspecialchars($standard['created_at']) ?></td>
                                <td><?= htmlspecialchars($standard['updated_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>