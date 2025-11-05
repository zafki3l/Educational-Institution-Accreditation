<div class="header">
    <ul type="none" class="nav-menu">
        <div class="nav-left">
            <li>
                <div class="dropdown">
                    <button>Category</button>
                    <div class="category-content">
                    <a href="">Fiction</a>
                    <a href="">Non-Fiction</a>
                    <a href="">Science</a>
                    <a href="">History</a>
                </div>
            <li><a href="/<?= PROJECT_NAME ?>">Homepage</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['role'] == 3): ?> <!--admin-->
                        <li><a href="/<?= PROJECT_NAME ?>/admin/dashboard">Admin Dashboard</a></li> <!--show dashboard for admin-->
                        <li><a href="/<?= PROJECT_NAME ?>/staff/dashboard">Staff Dashboard</a></li>
                <?php elseif ($_SESSION['user']['role'] == 2): ?>
                        <li><a href="/<?= PROJECT_NAME ?>/staff/dashboard">Staff Dashboard</a></li> <!--Show dashboard for staff-->
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="nav-right">
            <?php if(isset($_SESSION['user'])): ?>
                <li><a href="/oop-bookstore/views/myorder/all.myorder.php">Account</a></li>
                <li>
                    <a href="#" onclick="document.getElementById('logoutForm').submit(); return false;">Logout</a>
                </li>
                <form id="logoutForm" action="/<?= PROJECT_NAME ?>/logout" method="post" style="display:none;">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                    <input type="hidden" name="logout" value="1">
                </form>
            <?php else: ?>
                <li><a href="/<?= PROJECT_NAME ?>/register">Register</a></li>
                <li><a href="/<?= PROJECT_NAME ?>/login">login</a></li>
            <?php endif; ?>
        </div>
    </ul>
</div>