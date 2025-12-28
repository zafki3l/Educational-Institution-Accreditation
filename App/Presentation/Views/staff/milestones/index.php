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
                    <h2>DANH SÁCH MỐC ĐÁNH GIÁ</h2>
                    <h3>WELCOME <?php echo htmlspecialchars($_SESSION['user']['last_name']) ?></h3>
                </div>
            </div>

            <form action="?standard_id=&criteria_id=" method="get">
                <option value="">Chọn 1 tiêu chuẩn để lọc</option>
                <select name="standard_id" id="standard_id">
                    <?php foreach ($standards as $standard): ?>
                        <option value="<?= htmlspecialchars($standard['id']) ?>"><?= htmlspecialchars($standard['name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="criteria_id" id="criteria_id">
                    <option value="">Chọn 1 tiêu chí để lọc</option>
                    <?php foreach ($criterias as $criteria): ?>
                        <option value="<?= htmlspecialchars($criteria['criteria_id']) ?>"><?= htmlspecialchars($criteria['criteria_name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="submit">
            </form>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>MÃ MỐC ĐÁNH GIÁ</th>
                            <th>TÊN MỐC ĐÁNH GIÁ</th>
                            <th>CREATED AT</th>
                            <th>UPDATED AT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($milestones as $milestone): ?>
                            <tr>
                                <td><?= htmlspecialchars($milestone['id']) ?></td>
                                <td><?= htmlspecialchars($milestone['name']) ?></td>
                                <td><?= htmlspecialchars($milestone['created_at']) ?></td>
                                <td><?= htmlspecialchars($milestone['updated_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>

</html>