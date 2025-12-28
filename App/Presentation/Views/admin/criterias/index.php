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
                <div class="header-left">
                    <div class="header-line"></div>
                    <div class="header-text">
                        <h2>DANH SÁCH TIÊU CHÍ</h2>
                    </div>
                </div>

                <div class="dashboard-search-add">
                    <a href="/<?= PROJECT_NAME ?>/admin/criterias/create">+ Thêm tiêu chí</a>
                </div>
            </div>

            <div class="fill">
                <form action="?standard_id=&department_id=" method="get">
                    <select name="standard_id" id="standard_id">
                        <option value="">Chọn 1 tiêu chuẩn để lọc</option>
                        <?php foreach ($standards as $standard): ?>
                            <option value="<?= htmlspecialchars($standard['id']) ?>"><?= htmlspecialchars($standard['name']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <select name="department_id" id="department_id">
                        <option value="">Chọn phòng ban để lọc</option>
                        <?php foreach ($departments as $department): ?>
                            <option value="<?= htmlspecialchars($department['id']) ?>"><?= htmlspecialchars($department['name']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <input type="submit">
                </form>
            </div>

            <div class="dashboard-table">
                <table>
                    <thead>
                        <tr>
                            <th>MÃ TIÊU CHÍ</th>
                            <th>TÊN TIÊU CHÍ</th>
                            <th>PHÒNG BAN</th>
                            <th>CREATED AT</th>
                            <th>UPDATED AT</th>
                            <th>HÀNH ĐỘNG</th>
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
                                <td>
                                    <div class="action-btn">
                                        <button onclick="showConfirm('<?php echo htmlspecialchars($criteria['criteria_id']) ?>')" class="delete-btn">
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
                                                    onclick="closeModal('<?php echo htmlspecialchars($criteria['criteria_id']) ?>')">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <script src="/<?= PROJECT_NAME ?>/public/js/admin/criterias/confirmDelete.js"></script>
            </div>
        </div>
</body>

</html>