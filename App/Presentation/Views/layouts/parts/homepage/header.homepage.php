<header>
    <ul type="none" class="nav-menu">
        <div class="nav-left">
            <?php if ($permission['canShowHomepage']): ?>
                <li><a href="/<?= PROJECT_NAME ?>">Homepage</a></li>
            <?php endif; ?>

            <?php if ($permission['canShowAdminDashboard']): ?> <!--admin-->
                    <li><a href="/<?= PROJECT_NAME ?>/admin/dashboard">Admin Dashboard</a></li> <!--show dashboard for admin-->
            <?php endif; ?>

            <?php if ($permission['canShowStaffDashboard']): ?>
                <li><a href="/<?= PROJECT_NAME ?>/staff/dashboard">Staff Dashboard</a></li> <!--Show dashboard for staff-->
            <?php endif; ?>
        </div>

        <div class="nav-right">
            <?php if($isAuth): ?>
                <li><a href="">Account</a></li>
                <li>
                    <a href="#" onclick="document.getElementById('logoutForm').submit(); return false;">Logout</a>
                </li>
                <form id="logoutForm" action="/<?= PROJECT_NAME ?>/logout" method="post" style="display:none;">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                    <input type="hidden" name="logout" value="1">
                </form>
            <?php else: ?>
                <li><a href="/<?= PROJECT_NAME ?>/login">login</a></li>
            <?php endif; ?>
        </div>
    </ul>
</header>