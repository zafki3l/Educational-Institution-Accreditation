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
            <div class="content-header">
                <div class="header-text">
                    <h2>DANH SÁCH TIÊU CHÍ</h2>
                    <h3>WELCOME <?php echo htmlspecialchars($_SESSION['user']['last_name']) ?></h3>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 10%;">MÃ TIÊU CHÍ</th>
                            <th style="width: 10%;">MÃ TIÊU CHUẨN</th>
                            <th style="width:25%;">TÊN TIÊU CHÍ</th>
                            <th style="width: 10%;">MÃ PHÒNG BAN</th>
                            <th>CREATED AT</th>
                            <th>UPDATED AT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($criterias as $criteria): ?>
                            <tr>
                                <td><?= htmlspecialchars($criteria['criteria_id']) ?></td>
                                <td><?= htmlspecialchars($criteria['standard_id']) ?></td>
                                <td><?= htmlspecialchars($criteria['criteria_name']) ?></td>
                                <td><?= htmlspecialchars($criteria['department_id']) ?></td>
                                <td><?= htmlspecialchars($criteria['created_at']) ?></td>
                                <td><?= htmlspecialchars($criteria['updated_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>

</html>