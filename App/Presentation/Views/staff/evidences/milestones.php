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
                </div>

                <!-- Thanh tìm kiếm -->
                <div class="search-add">
                    <form action="/<?= PROJECT_NAME ?>/staff/evidences/<?= htmlspecialchars($evidence_id) ?>/milestones"
                        method="post">
                        <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">

                        <select name="milestone_id" id="milestone_id">
                            <?php foreach ($milestones as $milestone): ?>
                                <option value="<?= htmlspecialchars($milestone['id']) ?>"><?= $milestone['name'] ?></option>
                            <?php endforeach; ?>
                        </select>

                        <button type="submit">Thêm mốc đánh giá</button>
                    </form>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>MÃ MINH CHỨNG</th>
                            <th>MÃ MỐC ĐÁNH GIÁ</th>
                            <th>MỐC ĐÁNH GIÁ</th>
                            <th>HÀNH ĐỘNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($evidences)): ?>
                            <?php foreach ($evidences as $evidence): ?>
                                <tr>
                                    <td><?= htmlspecialchars($evidence['id']) ?></td>
                                    <td><?= htmlspecialchars($evidence['milestone_id']) ?></td>
                                    <td><?= htmlspecialchars($evidence['milestone_name']) ?></td>
                                    <td>
                                        <?php if (App\Domain\Entities\Models\User::isAdmin($_SESSION['user']['role_id']) ||
                                                $_SESSION['user']['department_id'] == $evidence['department_id']): ?>
                                            <a href="/<?= PROJECT_NAME ?>/staff/evidences/<?= htmlspecialchars($evidence['id']) ?>/edit" 
                                                class="edit-btn"><i class="fa-solid fa-pen"></i></a>

                                            <button onclick="showConfirm('<?php echo htmlspecialchars($evidence['id']) ?>')" class="delete-btn">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                            <!-- Delete Modal -->
                                            <div id="confirmModal-<?php echo htmlspecialchars($evidence['id']) ?>" class="modal">
                                                <div class="modal-content">
                                                    <h2>Delete</h2>
                                                    <hr>
                                                    <p>Click confirm to delete</p>
                                                    <form action="/<?= PROJECT_NAME ?>/staff/evidences/<?= htmlspecialchars($evidence['id']) ?>"
                                                        method="post" id="deleteForm-<?php echo htmlspecialchars($evidence['id']) ?>">
                                                        <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        
                                                        <input type="hidden" name="evidence_id" value="<?php echo htmlspecialchars($evidence['id']) ?>">

                                                        <button type="submit" class="submit-modal">Confirm</button>
                                                        <button type="button" class="cancel-modal" 
                                                        onclick="closeModal('<?php echo htmlspecialchars($evidence['id']) ?>')">Cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td><p>No results found</p></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>

</html>