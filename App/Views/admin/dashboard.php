<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/staff/dashboard.css">
</head>

<body>
    <div class="main-content">

        <div class="staff-dashboard">
            <div class="dashboard-grid">
                <!-- Staff Information Section -->
                <div class="card staff-info-card">
                    <header class="card-header">
                        <h3>Thông tin quản trị</h3>
                        <i class="fa-solid fa-user-circle fa-4x" aria-hidden="true"></i>
                    </header>
                    <div class="card-body">
                        <div class="profile-details">
                            <p><strong>User ID:</strong><?= htmlspecialchars($_SESSION['user']['user_id'] ?? '') ?></p>
                            <p><strong>Name:</strong><?= htmlspecialchars($_SESSION['user']['last_name'] ?? '') ?></p>
                            <p><strong>Email:</strong><?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?></p>
                            <div class="role-lable"><p><strong>Role:</strong><div class="role"><?= htmlspecialchars('Admin') ?></div></p></div>
                        </div>
                    </div>
                </div>

                <div class="card system-overview">
                    <h3>Tổng quan hệ thống</h3>
                    <div class="container-box">
                        <a href="/<?= PROJECT_NAME ?>/admin/criterias"><div class="box criteria-box">
                            <img src="/<?= PROJECT_NAME ?>/public/images/Check square.png" alt="">
                            <p>100</p>
                            <p>Tiêu chí</p>
                        </div></a>
                        <a href="/<?= PROJECT_NAME ?>/admin/users"><div class="box user-box">
                            <img src="/<?= PROJECT_NAME ?>/public/images/vector.png" alt="">
                            <p>40</p>
                            <p>Người dùng</p>
                        </div></a>
                        <a href="/<?= PROJECT_NAME ?>/admin/standards"><div class="box evidence-box">
                            <img src="/<?= PROJECT_NAME ?>/public/images/frame.png" alt="">
                            <p>2000</p>
                            <p>Minh chứng</p>
                        </div></a>
                        <a href="/<?= PROJECT_NAME ?>/admin/milestones"><div class="box milestone-box">
                            <img src="/<?= PROJECT_NAME ?>/public/images/marker.png" alt="">
                            <p>1000</p>
                            <p>Mốc đánh giá</p>
                        </div></a>
                    </div>
                </div>

                <div class="card management">
                    <h3>Quản lý tiêu chí</h3>
                    <div class="list evidence-list">
                        <p>Danh sách tiêu chuẩn</p>
                        <p>10 tiêu chuẩn</p>
                    </div>
                    <div class="list criteria-list">
                        <p>Danh sách tiêu chí</p>
                        <p>2 tiêu chí</p>
                    </div>
                    <div class="list milestone-list">
                        <p>Mốc đánh giá</p>
                        <p>2 mốc</p>
                    </div>
                </div>

                <div class="card management">
                    <h3>Quản lý người dùng</h3>
                    <div class="list">
                        <p>Quản trị viên</p>
                        <p>1 Quản trị viên</p>
                    </div>
                    <div class="list">
                        <p>Nhân viên</p>
                        <p>200 Nhân viên</p>
                    </div>
                    <div class="list add-list">
                        <a href="/<?= PROJECT_NAME ?>/admin/users/create">+ Thêm người dùng</a>
                    </div>
                </div>

                <!-- Chart Report Section -->
                <section class="card chart-card">
                    <header class="card-header">
                        <h3>Thống kê</h3>
                    </header>
                    <div class="card-body chart-body">
                        <canvas id="myChart" aria-label="Sales chart"></canvas>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/oop-bookstore/public/js/chart.js"></script>
</body>

</html>