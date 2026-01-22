<aside class="sidebar">
    <div class="sidebar-header">
        <h2>
            DANH SÁCH MINH CHỨNG
        </h2>
    </div>

    <nav class="sidebar-nav">
        <?php foreach ($standards as $standard): ?>
            <div class="nav-group">
                <!-- Standard -->
                <button class="nav-item nav-item-standard" data-toggle="standard-<?= $standard['id'] ?>">
                    <span class="nav-toggle">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                    <span class="nav-icon">
                        <i class="fas fa-layer-group"></i>
                    </span>
                    <span class="nav-label">
                        <strong><?= htmlspecialchars($standard['id']) ?></strong>
                        <span><?= htmlspecialchars($standard['name']) ?></span>
                    </span>
                    <span class="nav-badge"><?= count($criteriaByStandard[$standard['id']] ?? []) ?></span>
                </button>

                <!-- Criteria List -->
                <?php if (!empty($criteriaByStandard[$standard['id']])): ?>
                    <div class="nav-children" id="standard-<?= $standard['id'] ?>">
                        <?php foreach ($criteriaByStandard[$standard['id']] as $criteria): ?>
                            <div class="nav-group nav-group-level-2">
                                <!-- Criteria -->
                                <button class="nav-item nav-item-criteria" data-toggle="criteria-<?= $criteria['id'] ?>">
                                    <span class="nav-toggle">
                                        <i class="fas fa-chevron-right"></i>
                                    </span>
                                    <span class="nav-icon">
                                        <i class="fas fa-list"></i>
                                    </span>
                                    <span class="nav-label">
                                        <strong><?= htmlspecialchars($criteria['id']) ?></strong>
                                        <span><?= htmlspecialchars($criteria['name']) ?></span>
                                    </span>
                                    <span class="nav-badge"><?= count($evidenceByCriteria[$criteria['id']] ?? []) ?></span>
                                </button>

                                <!-- Evidence List -->
                                <?php if (!empty($evidenceByCriteria[$criteria['id']])): ?>
                                    <div class="nav-children" id="criteria-<?= $criteria['id'] ?>">
                                        <?php foreach ($evidenceByCriteria[$criteria['id']] as $evidence): ?>
                                            <a href="/<?= PROJECT_NAME ?>/evidences/<?= htmlspecialchars($evidence['link']) ?>"
                                                class="nav-item nav-item-evidence">
                                                <span class="nav-icon">
                                                    <i class="fas fa-file-alt"></i>
                                                </span>
                                                <span class="nav-label">
                                                    <strong><?= htmlspecialchars($evidence['id']) ?></strong>
                                                    <span><?= htmlspecialchars($evidence['name']) ?></span>
                                                </span>
                                                <span class="nav-action">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </span>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </nav>
</aside>