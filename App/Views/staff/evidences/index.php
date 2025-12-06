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
                    <h2>QUẢN LÝ MINH CHỨNG</h2>
                    <h3>WELCOME <?php echo htmlspecialchars($_SESSION['user']['last_name']) ?></h3>
                </div>

                <!-- Thanh tìm kiếm -->
                <div class="search-add">
                    <a href="/<?= PROJECT_NAME ?>/staff/evidences/create" class="addEvidence">Thêm minh chứng</a>
                </div>

                <form action="/<?= PROJECT_NAME ?>/staff/evidences/milestones"
                    method="post">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                    <select name="evidence_id" id="evidence_id">
                        <?php foreach ($evidencesWithoutMilestone as $evidence): ?>
                            <option value="<?= htmlspecialchars($evidence['evidence_id']) ?>"><?= $evidence['evidence_name'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <select name="milestone_id" id="milestone_id">
                        <?php foreach ($milestones as $milestone): ?>
                            <option value="<?= htmlspecialchars($milestone['id']) ?>"><?= $milestone['name'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit">Thêm mốc đánh giá</button>
                </form>
            </div>

            <form action="?standard_id=&criteria_id=&milestone_id=" method="get">
                <select name="standard_id" id="standard_id">
                    <option value="">Chọn 1 tiêu chuẩn để lọc</option>
                    <?php foreach ($standards as $standard): ?>
                        <option value="<?= htmlspecialchars($standard['id']) ?>"><?= htmlspecialchars($standard['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <select name="criteria_id" id="criteria_id">
                    <option value="">Chọn 1 tiêu chí để lọc</option>
                    <?php foreach ($criterias as $criteria): ?>
                        <option value="<?= htmlspecialchars($criteria['criteria_id']) ?>"><?= htmlspecialchars($criteria['criteria_name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <select name="milestone_id" id="milestone_id">
                    <option value="">Chọn 1 mốc đánh giá để lọc</option>
                    <?php foreach ($milestones as $milestone): ?>
                        <option value="<?= htmlspecialchars($milestone['id']) ?>"><?= htmlspecialchars($milestone['name']) ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit">
            </form>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>MÃ MINH CHỨNG</th>
                            <th>MINH CHỨNG</th>
                            <th>MỐC ĐÁNH GIÁ</th>
                            <th>QUYẾT ĐỊNH</th>
                            <th>NGÀY PHÁT HÀNH</th>
                            <th>NƠI PHÁT HÀNH</th>
                            <th>LIÊN KẾT</th>
                            <th>TIÊU CHÍ ĐÁP ỨNG</th>
                            <th>HÀNH ĐỘNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($evidences as $evidence): ?>
                            <tr>
                                <td><?= htmlspecialchars($evidence['evidence_id']) ?></td>
                                <td><?= htmlspecialchars($evidence['evidence_name']) ?></td>
                                <td><?= htmlspecialchars($evidence['evaluation_milestone']) ?></td>
                                <td><?= htmlspecialchars($evidence['decision']) ?></td>
                                <td><?= htmlspecialchars($evidence['document_date']) ?></td>
                                <td><?= htmlspecialchars($evidence['issue_place']) ?></td>
                                <td><a href="/<?= PROJECT_NAME ?>/staff/evidences/<?= htmlspecialchars($evidence['link']) ?>">Xem minh chứng</a></td>
                                <td>
                                    <a href="/<?= PROJECT_NAME ?>/staff/evidences/<?= htmlspecialchars($evidence['evidence_id']) ?>/milestones">Xem chi tiết</a>
                                </td>
                                <td>
                                    <?php if (App\Models\User::isAdmin($_SESSION['user']['role_id']) ||
                                            $_SESSION['user']['department_id'] == $evidence['department_id']): ?>
                                        <a href="/<?= PROJECT_NAME ?>/staff/evidences/<?= htmlspecialchars($evidence['evidence_id']) ?>/edit" 
                                            class="edit-btn"><i class="fa-solid fa-pen"></i></a>

                                        <button onclick="showConfirm('<?php echo htmlspecialchars($evidence['evidence_id']) ?>')" class="delete-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                        <!-- Delete Modal -->
                                        <div id="confirmModal-<?php echo htmlspecialchars($evidence['evidence_id']) ?>" class="modal">
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
                    </tbody>
                </table>

                <!-- Pagination -->
                <?php include_once VIEW_PATH . 'layouts/parts/pagination.php' ?>
            </div>

        </div>
    </div>

    <script src="/<?= PROJECT_NAME ?>/public/js/staff/evidences/confirmDelete.js"></script>

</body>

</html>