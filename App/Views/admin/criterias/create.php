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
                <h2>THÊM TIÊU CHÍ</h2>
            </div>

            <div class="container-content">
                <form action="/<?= PROJECT_NAME ?>/admin/criterias" method="post">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                    <div class="form-group">
                        <label for="id">Mã tiêu chí: </label>
                        <input type="text" id="id" name="id" placeholder="Mã tiêu chí">
                    </div>

                    <div class="form-group">
                        <label for="standard_id">Tiêu chuẩn: </label>
                        <select name="standard_id" id="standard_id">
                            <?php foreach ($standards as $standard): ?>
                                <option value="<?= $standard['id']  ?>"><p><?= $standard['name'] ?></p></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Tên tiêu chí: </label>
                        <input type="text" id="name" name="name" placeholder="Tên tiêu chí">
                    </div>

                    <div class="form-group">
                        <label for="department_id">Phòng ban: </label>
                        <select name="department_id" id="department_id">
                            <?php foreach ($departments as $department): ?>
                                <option value="<?= $department['id']  ?>"><p><?= $department['name'] ?></p></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <a href="/<?= PROJECT_NAME ?>/admin/criterias" class="cancel-btn">Cancel</a>
                        <input type="submit" name="submit" value="Create criteria" class="submit-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>