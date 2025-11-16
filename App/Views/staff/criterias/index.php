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
                                    <?php if (App\Database\Models\User::isAdmin($_SESSION['user']['role_id'])): ?>
                                        <a href="/<?= PROJECT_NAME ?>/staff/criterias/<?= htmlspecialchars($evidence['criteria_id']) ?>/edit" 
                                            class="edit-btn"><i class="fa-solid fa-pen"></i></a>

                                        <button onclick="showConfirm('<?php echo htmlspecialchars($evidence['criteria_id']) ?>')" class="delete-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        <!-- Delete Modal -->
                                        <div id="confirmModal-<?php echo htmlspecialchars($criteria['criteria_id']) ?>" class="modal">
                                            <div class="modal-content">
                                                <h2>Delete</h2>
                                                <hr>
                                                <p>Click confirm to delete</p>
                                                <form action="/<?= PROJECT_NAME ?>/staff/evidences/<?= htmlspecialchars($evidence['evidence_id']) ?>"
                                                    method="post" id="deleteForm-<?php echo htmlspecialchars($evidence['evidence_id']) ?>">
                                                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    
                                                    <input type="hidden" name="evidence_id" value="<?php echo htmlspecialchars($evidence['evidence_id']) ?>">

                                                    <button type="submit" class="submit-modal">Confirm</button>
                                                    <button type="button" class="cancel-modal" 
                                                    onclick="closeModal('<?php echo htmlspecialchars($evidence['evidence_id']) ?>')">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
        </div>
    </div>
</body>
</html>