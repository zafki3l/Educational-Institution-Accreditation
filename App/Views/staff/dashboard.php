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
                <section class="card staff-info-card">
                    <header class="card-header">
                        <h3>Thông tin nhân viên</h3>
                    </header>
                    <div class="card-body">
                        <div class="profile-avatar">
                            <i class="fa-solid fa-user-circle fa-4x" aria-hidden="true"></i>
                        </div>
                        <div class="profile-details">
                            <p><strong>User ID:</strong> <?= htmlspecialchars($_SESSION['user']['user_id'] ?? '') ?></p>
                            <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['user']['last_name'] ?? '') ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?></p>
                            <p><strong>Role:</strong> <?= htmlspecialchars(($_SESSION['user']['role_id'] ?? 0) == App\Database\Models\User::ROLE_BUSINESS_STAFF ? 'Staff' : 'Admin') ?></p>
                        </div>
                    </div>
                </section>

                <section class="card inventory-card">
                    <header class="card-header">
                        <h3>Tiêu chuẩn, Tiêu chí, Mốc đánh giá</h3>
                    </header>
                    <div class="card-body">
                        <div class="management-links">
                            <a class="manage-link" href="">
                                <i class="fa-solid fa-tags"></i>
                                Cập nhật tiêu chuẩn
                            </a>
                            <a class="manage-link" href="">
                                <i class="fa-solid fa-tags"></i>
                                Cập nhật tiêu chí
                            </a>

                            <a class="manage-link" href="">
                                <i class="fa-solid fa-tags"></i>
                                Cập nhật mốc đánh giá
                            </a>
                        </div>
                    </div>
                </section>

                <section class="card orders-card">
                    <header class="card-header">
                        <h3>Minh chứng</h3>
                    </header>
                    <div class="card-body">
                        <div class="management-links">
                            <a class="manage-link" href="/<?= PROJECT_NAME ?>/staff/evidences">
                                <i class="fa-solid fa-tags"></i>
                                Cập nhật minh chứng
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