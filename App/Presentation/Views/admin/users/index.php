<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/admin/index.css">
    <title>Document</title>
</head>
<body>
    <div class="main-content">
        <!--Sidebar-->
        <div class="sidebar">
            <?php include_once VIEW_PATH . '/layouts/parts/admin/sidebar.user_management.php' ?>
        </div>
        <div class="dashboard-container">
            <!-- DASHBOARD HEADER -->
            <div class="dashboard-header">
                <div class="header-left">
                    <div class="header-line"></div>
                    <div class="header-text">
                        <h3>QUẢN LÝ NGƯỜI DÙNG</h3>       
                    </div>
                </div>

                <!-- Searchbar and Add User -->
                <div class="dashboard-search-add">
                    <?php include_once 'search.php' ?>
                    <a href="/<?= PROJECT_NAME ?>/admin/users/create">+ Thêm người dùng</a>
                </div>
            </div>

            <!-- DASHBOARD USER MANAGEMENT TABLE -->
            <div class="dashboard-table">
                <div class="table-head">
                    <h2>Danh sách người dùng</h2>
                    <p>3 nguoi</p>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>USER ID</th>
                            <th>FIRST NAME</th>
                            <th>LAST NAME</th>
                            <th>EMAIL</th>
                            <th>GENDER</th>
                            <th>DEPARTMENT</th>
                            <th>ROLE</th>
                            <th>CREATED AT</th>
                            <th>UPDATED AT</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id']) ?></td>
                                <td><?= htmlspecialchars($user['first_name']) ?></td>
                                <td><?= htmlspecialchars($user['last_name']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                                <td><?= htmlspecialchars($user['gender']) ?></td>
                                <td><?= htmlspecialchars($user['department_name']) ?></td>
                                <td><?= htmlspecialchars($user['role_name']) ?></td>
                                <td><?= htmlspecialchars($user['created_at']) ?></td>
                                <td><?= htmlspecialchars($user['updated_at']) ?></td>
                                <td>
                                    <div class="action-btn">
                                        <a class="edit-btn" href="/<?= PROJECT_NAME ?>/admin/users/<?= htmlspecialchars($user['id']) ?>/edit">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>

                                        <button onclick="showConfirm(<?php echo htmlspecialchars($user['id']) ?>)" class="delete-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        <!-- Delete Modal -->
                                        <div id="confirmModal-<?php echo htmlspecialchars($user['id']) ?>" class="modal">
                                            <div class="modal-content">
                                                <h2>Delete</h2>
                                                <hr>
                                                <p>Click confirm to delete</p>
                                                <form action="/<?= PROJECT_NAME ?>/admin/users/<?= htmlspecialchars($user['id']) ?>"
                                                    method="post" id="deleteForm">
                                                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    
                                                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']) ?>">

                                                    <button type="submit" class="submit-modal">Confirm</button>
                                                    <button type="button" class="cancel-modal" 
                                                    onclick="closeModal(<?php echo htmlspecialchars($user['id']) ?>)">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <?php include_once VIEW_PATH . 'layouts/parts/pagination.php' ?>
            </div>
        </div>
    </div>

    <div class="edit-user-message">
        <?php if (isset($_SESSION['edit-user-success'])): ?>
            <?php echo htmlspecialchars(message('edit-user-success')); ?>
        <?php endif; ?>
    </div>

    <!-- Edit user message -->
    <?php if (!empty($_SESSION['edit-user-success'])): ?>
        <script src="/<?= PROJECT_NAME ?>/public/js/admin/users/editMessage.js"></script>
        <?php unset($_SESSION['edit-user-success']) ?>
    <?php endif; ?>

    <div class="delete-user-message">
        <?php if (isset($_SESSION['delete-user-success'])): ?>
            <?php echo htmlspecialchars(message('delete-user-success')); ?>
        <?php endif; ?>
    </div>

    <!-- Delete user message -->
    <?php if (!empty($_SESSION['delete-user-success'])): ?>
        <script src="/<?= PROJECT_NAME ?>/public/js/admin/users/deleteMessage.js"></script>
        <?php unset($_SESSION['delete-user-success']) ?>
    <?php endif; ?>

    <script src="/<?= PROJECT_NAME ?>/public/js/admin/users/confirmDelete.js"></script>
</body>
</html>