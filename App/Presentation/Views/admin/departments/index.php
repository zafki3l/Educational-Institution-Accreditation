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
                    <h2>DANH SÁCH PHÒNG BAN</h1>
                    <h3>ADMIN DASHBOARD</h3>
                </div>

                <!-- Searchbar and Add User -->
                <div class="dashboard-search-add">
                    <?php include_once 'search.php' ?>
                    <a href="/<?= PROJECT_NAME ?>/">Thêm phòng ban</a>
                </div>
            </div>

            <!-- DASHBOARD USER MANAGEMENT TABLE -->
            <div class="dashboard-table">
                <table>
                    <thead>
                        <tr>
                            <th>MÃ PHÒNG BAN</th>
                            <th>TÊN PHÒNG BAN</th>
                            <th>HÀNH ĐỘNG</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($departments as $department): ?>
                            <tr>
                                <td><?= htmlspecialchars($department['id']) ?></td>
                                <td><?= htmlspecialchars($department['name']) ?></td>
                                <td>
                                    <div class="action-btn">
                                        <a class="edit-btn" href="/<?= PROJECT_NAME ?>/admin/departments/<?= htmlspecialchars($department['id']) ?>/edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <button onclick="showConfirm(<?php echo htmlspecialchars($department['id']) ?>)" class="delete-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        <!-- Delete Modal -->
                                        <div id="confirmModal-<?php echo htmlspecialchars($department['id']) ?>" class="modal">
                                            <div class="modal-content">
                                                <h2>Delete</h2>
                                                <hr>
                                                <p>Click confirm to delete</p>
                                                <form action="/<?= PROJECT_NAME ?>/admin/departments/<?= htmlspecialchars($department['id']) ?>"
                                                    method="post" id="deleteForm">
                                                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    
                                                    <input type="hidden" name="department_id" value="<?php echo htmlspecialchars($department['id']) ?>">

                                                    <button type="submit" class="submit-modal">Confirm</button>
                                                    <button type="button" class="cancel-modal" 
                                                    onclick="closeModal(<?php echo htmlspecialchars($department['id']) ?>)">Cancel</button>
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
</body>
</html>