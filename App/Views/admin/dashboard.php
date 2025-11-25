<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/staff/dashboard.css">
</head>

<body>
    <div class="main-content">
        <div class="dashboard-header">
            <div class="dashboard-title">
                <div class="header-line"></div>
                <h1>ADMIN DASHBOARD</h1>
            </div>
        </div>

        <div class="staff-dashboard">
            <div class="dashboard-grid">
                <!-- Staff Information Section -->
                <section class="card staff-info-card">
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
                </section>

                <div class="system-overview">
                    <h3>Tổng quan hệ thống</h3>
                    <div class="criteria-box">
                        <img src="/<?= PROJECT_NAME ?>/public/images/Check square.png" alt="">
                    </div>
                </div>

                <section class="card inventory-card">
                    <header class="card-header">
                        <h3>Tiêu chuẩn, Tiêu chí, Mốc đánh giá</h3>
                    </header>
                    <div class="card-body">
                        <div class="management-links">
                            <a class="manage-link" href="/<?= PROJECT_NAME ?>/admin/standards">
                                <i class="fa-solid fa-tags"></i>
                                Cập nhật tiêu chuẩn
                            </a>
                            <a class="manage-link" href="/<?= PROJECT_NAME ?>/admin/criterias">
                                <i class="fa-solid fa-tags"></i>
                                Cập nhật tiêu chí
                            </a>

                            <a class="manage-link" href="/<?= PROJECT_NAME ?>/admin/milestones">
                                <i class="fa-solid fa-tags"></i>
                                Cập nhật mốc đánh giá
                            </a>
                        </div>
                    </div>
                </section>

                <section class="card orders-card">
                    <header class="card-header">
                        <h3>Quản lý người dùng</h3>
                    </header>
                    <div class="card-body">
                        <div class="management-links">
                            <a class="manage-link" href="/<?= PROJECT_NAME ?>/admin/users">
                                <i class="fa-solid fa-tags"></i>
                                Danh sách người dùng
                            </a>

                            <a class="manage-link" href="/<?= PROJECT_NAME ?>/admin/roles">
                                <i class="fa-solid fa-tags"></i>
                                Cập nhật quyền
                            </a>

                            <a class="manage-link" href="/<?= PROJECT_NAME ?>/admin/departments">
                                <i class="fa-solid fa-tags"></i>
                                Quản lý phòng ban
                            </a>
                        </div>
                    </div>
                </section>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/oop-bookstore/public/js/chart.js"></script>
</body>

</html>