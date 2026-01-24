<section class="actions">
    <div class="actions-content">
        <h2>Bắt đầu sử dụng hệ thống</h2>
        <p>
            Đăng nhập để quản lý minh chứng hoặc tra cứu thông tin
            phục vụ công tác kiểm định chất lượng.
        </p>
    </div>

    <div class="actions-buttons">
        <?php if(!$isAuth): ?>
            <a href="/<?= PROJECT_NAME ?>/login" class="btn-login">Đăng nhập hệ thống</a>
        <?php endif; ?>
        <a href="/<?= PROJECT_NAME ?>/evidences" class="btn-find-evidences">Tìm kiếm minh chứng</a>
    </div>
</section>