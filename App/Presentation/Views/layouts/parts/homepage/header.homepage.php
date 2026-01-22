<header>
    <div class="nav-bar">
        <ul class="left-nav">
            <li>
                <img src="/<?= PROJECT_NAME ?>/public/assets/icon/fbu.png">
            </li>
            <li><a href="/<?= PROJECT_NAME ?>/">Trang chủ</a></li>
            <li><a href="/<?= PROJECT_NAME ?>/evidences">Tìm kiếm minh chứng</a></li>

            <?php if ($permission['canShowAdminDashboard']): ?> <!--admin-->
                    <li><a href="/<?= PROJECT_NAME ?>/admin/dashboard">Admin Dashboard</a></li> <!--show dashboard for admin-->
            <?php endif; ?>

            <?php if ($permission['canShowStaffDashboard']): ?>
                <li><a href="/<?= PROJECT_NAME ?>/staff/dashboard">Staff Dashboard</a></li> <!--Show dashboard for staff-->
            <?php endif; ?>
        </ul>

        <ul class="right-nav">
            <?php if($isAuth): ?>
                <li><a href="">Tài khoản của tôi</a></li>
                <li>
                    <a href="#" onclick="document.getElementById('logoutForm').submit(); return false;">Đăng xuất</a>
                </li>
                <form id="logoutForm" action="/<?= PROJECT_NAME ?>/logout" method="post" style="display:none;">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                    <input type="hidden" name="logout" value="1">
                </form>
            <?php else: ?>
                <li><a href="/<?= PROJECT_NAME ?>/login">Đăng nhập</a></li>
            <?php endif; ?>
        </ul>
    </div>
</header>