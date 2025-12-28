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

            <form action="?standard_id=" method="get">
                <select name="standard_id" id="standard_id">
                    <?php foreach ($standards as $standard): ?>
                        <option value="<?= htmlspecialchars($standard['id']) ?>"><?= htmlspecialchars($standard['name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="submit">
            </form>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>MÃ TIÊU CHÍ</th>
                            <th>TÊN TIÊU CHÍ</th>
                            <th>PHÒNG BAN</th>
                            <th>CREATED AT</th>
                            <th>UPDATED AT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($criterias as $criteria): ?>
                            <tr>
                                <td><?= htmlspecialchars($criteria['criteria_id']) ?></td>
                                <td><?= htmlspecialchars($criteria['criteria_name']) ?></td>
                                <td><?= htmlspecialchars($criteria['department_name']) ?></td>
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