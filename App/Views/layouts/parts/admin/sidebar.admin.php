<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/layouts/staff/sidebar.staff.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>

<body>
    <ul>
        <div class="img">
            <li>
                <i class="fa-solid fa-user-circle fa-5x"></i>
            </li>
            <h3>Xin chào <?php echo htmlspecialchars($_SESSION['user']['last_name']) ?></h3>
        </div>
        <hr>
        <div class="sidebar-content">
            <li><div class="menu-sidebar"><i class="fa-solid fa-file-lines"></i><a href="/<?= PROJECT_NAME ?>/admin/users"><p>Quản lý người dùng</p></a></div></li>
            <li><div class="menu-sidebar"><i class="fa-solid fa-file-pen"></i><a href="/<?= PROJECT_NAME ?>/admin/standards"><p>Cập nhật tiêu chuẩn</p></a></div></li>
            <li><div class="menu-sidebar"><i class="fa-solid fa-file-pen"></i><a href="/<?= PROJECT_NAME ?>/admin/criterias"><p>Cập nhật tiêu chí</p></a></div></li>
            <li><div class="menu-sidebar"><i class="fa-solid fa-file-pen"></i><a href="/<?= PROJECT_NAME ?>/admin/milestones"><p>Cập nhật mốc đánh giá</p></a></div></li>
        </div>

    </ul>

    <script src="/<?= PROJECT_NAME ?>/public/js/admin/sidebar.admin.js"></script>
</body>

</html>