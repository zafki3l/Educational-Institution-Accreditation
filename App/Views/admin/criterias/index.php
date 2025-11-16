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
                    <h2>DANH SÁCH TIÊU CHÍ</h2>
                    <h3>WELCOME <?php echo htmlspecialchars($_SESSION['user']['last_name']) ?></h3>
                </div>

                <div class="dashboard-search-add">
                    <a href="/<?= PROJECT_NAME ?>/admin/criterias/create">Thêm tiêu chí</a>
                </div>
            </div>

            <div class="dashboard-table">
                <table>
                    <thead>
                        <tr>
                            <th>MÃ TIÊU CHÍ</th>
                            <th>MÃ TIÊU CHUẨN</th>
                            <th>TÊN TIÊU CHÍ</th>
                            <th>MÃ PHÒNG BAN</th>
                            <th>CREATED AT</th>
                            <th>UPDATED AT</th>
                            <th>HÀNH ĐỘNG</th>
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
                                <td>
                                    <div class="action-btn">
                                        <button onclick="showConfirm(<?php echo htmlspecialchars($criteria['criteria_id']) ?>)" class="delete-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        <!-- Delete Modal -->
                                        <div id="confirmModal-<?php echo htmlspecialchars($criteria['criteria_id']) ?>" class="modal">
                                            <div class="modal-content">
                                                <h2>Delete</h2>
                                                <hr>
                                                <p>Click confirm to delete</p>
                                                <form action="/<?= PROJECT_NAME ?>/admin/criterias/<?= htmlspecialchars($criteria['criteria_id']) ?>"
                                                    method="post" id="deleteForm">
                                                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    
                                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($criteria['criteria_id']) ?>">

                                                    <button type="submit" class="submit-modal">Confirm</button>
                                                    <button type="button" class="cancel-modal" 
                                                    onclick="closeModal(<?php echo htmlspecialchars($criteria['criteria_id']) ?>)">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <script src="/<?= PROJECT_NAME ?>/public/js/admin/standards/confirmDelete.js"></script>
            </div>
        </div>
</body>

</html>