<div class="card system-overview">
    <h3>Tổng quan hệ thống</h3>
    <div class="container-box">
        <a href="/<?= PROJECT_NAME ?>/admin/criterias"><div class="box criteria-box">
            <img src="/<?= PROJECT_NAME ?>/public/assets/icon/Check square.png" alt="">
            <p><?= $criterias ?? 0 ?></p>
            <p>Tiêu chí</p>
        </div></a>
        <a href="/<?= PROJECT_NAME ?>/admin/users"><div class="box user-box">
            <img src="/<?= PROJECT_NAME ?>/public/assets/icon/vector.png" alt="">
            <p><?= $users ?? 0 ?></p>
            <p>Người dùng</p>
        </div></a>
        <a href="/<?= PROJECT_NAME ?>/admin/standards"><div class="box evidence-box">
            <img src="/<?= PROJECT_NAME ?>/public/assets/icon/frame.png" alt="">
            <p><?= $evidences ?? 0 ?></p>
            <p>Minh chứng</p>
        </div></a>
        <a href="/<?= PROJECT_NAME ?>/admin/milestones"><div class="box milestone-box">
            <img src="/<?= PROJECT_NAME ?>/public/assets/icon/marker.png" alt="">
            <p><?= $milestones ?? 0 ?></p>
            <p>Mốc đánh giá</p>
        </div></a>
    </div>
</div>