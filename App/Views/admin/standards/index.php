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
            <!-- DASHBOARD HEADER -->
            <div class="dashboard-header">
                <div class="header-text">
                    <h2>CẬP NHẬT TIÊU CHUẨN</h1>
                    <h3>ADMIN DASHBOARD</h3>
                </div>

                <!-- Searchbar and Add User -->
                <div class="dashboard-search-add">
                    <form action="/<?= PROJECT_NAME ?>/admin/standards" method="post">
                        <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                        <button type="submit">Thêm tiểu chuẩn</button>
                        <input type="text" name="id" placeholder="Mã tiêu chuẩn">
                        <input type="text" name="name" placeholder="Tên tiêu chuẩn">
                        <select name="department_id" id="department_id">
                            <?php foreach ($departments as $department): ?>
                                <option value="<?= $department['id'] ?>"><?= $department['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </form>
                </div>
            </div>

            <!-- DASHBOARD USER MANAGEMENT TABLE -->
            <div class="dashboard-table">
                <table>
                    <thead>
                        <tr>
                            <th>MÃ TIÊU CHUẨN</th>
                            <th>TÊN TIÊU CHUẨN</th>
                            <th>PHÒNG BAN</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($standards as $standard): ?>
                            <tr>
                                <td><?= htmlspecialchars($standard['id']) ?></td>
                                <td><?= htmlspecialchars($standard['name']) ?></td>
                                <td><?= htmlspecialchars($standard['department_name']) ?></td>
                                <td>
                                    <div class="action-btn">
                                        <button onclick="showConfirm(<?php echo htmlspecialchars($standard['id']) ?>)" class="delete-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        <!-- Delete Modal -->
                                        <div id="confirmModal-<?php echo htmlspecialchars($standard['id']) ?>" class="modal">
                                            <div class="modal-content">
                                                <h2>Delete</h2>
                                                <hr>
                                                <p>Click confirm to delete</p>
                                                <form action="/<?= PROJECT_NAME ?>/admin/standards/<?= htmlspecialchars($standard['id']) ?>"
                                                    method="post" id="deleteForm">
                                                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    
                                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($standard['id']) ?>">

                                                    <button type="submit" class="submit-modal">Confirm</button>
                                                    <button type="button" class="cancel-modal" 
                                                    onclick="closeModal(<?php echo htmlspecialchars($standard['id']) ?>)">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="/<?= PROJECT_NAME ?>/public/js/admin/standards/confirmDelete.js"></script>
</body>
</html>