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
                    <h2>DANH SÁCH MỐC ĐÁNH GIÁ</h2>
                    <h3>WELCOME <?php echo htmlspecialchars($_SESSION['user']['last_name']) ?></h3>
                </div>

                <div class="dashboard-search-add">
                    <a href="/<?= PROJECT_NAME ?>/admin/milestones/create">Thêm mốc đánh giá</a>
                </div>
            </div>

            <form action="?standard_id=&criteria_id=" method="get">
                <select name="standard_id" id="standard_id">
                    <option value="">Chọn 1 tiêu chuẩn để lọc</option>
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

            <div class="dashboard-table">
                <table>
                    <thead>
                        <tr>
                            <th>MÃ MỐC ĐÁNH GIÁ</th>
                            <th>TÊN MỐC ĐÁNH GIÁ</th>
                            <th>CREATED AT</th>
                            <th>UPDATED AT</th>
                            <th>HÀNH ĐỘNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($milestones as $milestone): ?>
                            <tr>
                                <td><?= htmlspecialchars($milestone['id']) ?></td>
                                <td><?= htmlspecialchars($milestone['name']) ?></td>
                                <td><?= htmlspecialchars($milestone['created_at']) ?></td>
                                <td><?= htmlspecialchars($milestone['updated_at']) ?></td>
                                <td>
                                    <div class="action-btn">
                                        <button onclick="showConfirm('<?php echo htmlspecialchars($milestone['id']) ?>')" class="delete-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        <!-- Delete Modal -->
                                        <div id="confirmModal-<?php echo htmlspecialchars($milestone['id']) ?>" class="modal">
                                            <div class="modal-content">
                                                <h2>Delete</h2>
                                                <hr>
                                                <p>Click confirm to delete</p>
                                                <form action="/<?= PROJECT_NAME ?>/admin/milestones/<?= htmlspecialchars($milestone['id']) ?>"
                                                    method="post" id="deleteForm">
                                                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    
                                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($milestone['id']) ?>">

                                                    <button type="submit" class="submit-modal">Confirm</button>
                                                    <button type="button" class="cancel-modal" 
                                                    onclick="closeModal('<?php echo htmlspecialchars($milestone['id']) ?>')">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <script src="/<?= PROJECT_NAME ?>/public/js/admin/milestones/confirmDelete.js"></script>
            </div>
        </div>
</body>

</html>