<div class="card user-info-card">
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