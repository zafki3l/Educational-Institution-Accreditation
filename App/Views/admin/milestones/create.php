<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/admin/add.css">
</head>

<body>
    <div class="main-content">
        <!--Sidebar-->
        <div class="sidebar">
            <?php include_once VIEW_PATH . '/layouts/parts/admin/sidebar.admin.php' ?>
        </div>
        <div class="container">
            <div class="container-header">
                <h2>THÊM MỐC ĐÁNH GIÁ</h2>
            </div>

            <div class="container-content">
                <form action="/<?= PROJECT_NAME ?>/admin/milestones" method="post">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                    <div class="form-group">
                        <label for="id">Mã mốc đánh giá: </label>
                        <input type="text" id="id" name="id" placeholder="Mã mốc đánh giá">
                    </div>

                    <div class="form-group">
                        <label for="criteria_id">Tiêu chí: </label>
                        <select name="criteria_id" id="criteria_id">
                            <?php foreach ($criterias as $criteria): ?>
                                <option value="<?= $criteria['criteria_id']  ?>"><p><?= $criteria['criteria_name'] ?></p></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Tên mốc đánh giá: </label>
                        <input type="text" id="name" name="name" placeholder="Tên mốc đánh giá">
                    </div>

                    <div class="form-group">
                        <a href="/<?= PROJECT_NAME ?>/admin/milestones" class="cancel-btn">Cancel</a>
                        <input type="submit" name="submit" value="Tạo mốc đánh giá" class="submit-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>