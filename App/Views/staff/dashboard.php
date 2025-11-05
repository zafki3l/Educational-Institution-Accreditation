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
                        <h3>Staff Information</h3>
                    </header>
                    <div class="card-body">
                        <div class="profile-avatar">
                            <i class="fa-solid fa-user-circle fa-4x" aria-hidden="true"></i>
                        </div>
                        <div class="profile-details">
                            <p><strong>User ID:</strong> <?= htmlspecialchars($_SESSION['user']['user_id'] ?? '') ?></p>
                            <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['user']['last_name'] ?? '') ?></p>
                            <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION['user']['email'] ?? '') ?></p>
                            <p><strong>Role:</strong> <?= htmlspecialchars(($_SESSION['user']['role'] ?? 0) == App\Models\User::ROLE_STAFF ? 'Staff' : 'Admin') ?></p>
                        </div>
                    </div>
                </section>

                <!-- Books & Categories Section -->
                <section class="card inventory-card">
                    <header class="card-header">
                        <h3>Books & Categories</h3>
                    </header>
                    <div class="card-body">
                        <div class="management-links">
                            <a class="manage-link" href="/<?= PROJECT_NAME ?>/staff/books">
                                <i class="fa-solid fa-book"></i>
                                Book Management
                            </a>
                            <a class="manage-link" href="categories/index.categories.php">
                                <i class="fa-solid fa-tags"></i>
                                Category Management
                            </a>
                        </div>
                    </div>
                </section>

                <!-- Orders Section -->
                <section class="card orders-card">
                    <header class="card-header">
                        <h3>Orders</h3>
                    </header>
                    <div class="card-body">
                        <div class="management-links">
                            <a class="manage-link" href="orders/index.orders.php?page_number=1">
                                <i class="fa-solid fa-shopping-cart"></i>
                                Order Management
                            </a>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Chart Report Section -->
            <section class="card chart-card">
                <header class="card-header">
                    <h3>Sales Report</h3>
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