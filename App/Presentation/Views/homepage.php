<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <!-- SEARCH BAR -->
    <?php include VIEW_PATH . "/layouts/parts/homepage/searchbar.homepage.php" ?>

    <div class="main-content">
        <ul>
            <?php foreach ($standards as $standard): ?>
                <li>
                    📁 <?= htmlspecialchars($standard['name']) ?>

                    <?php if (!empty($criteriaByStandard[$standard['id']])): ?>
                        <ul>
                            <?php foreach ($criteriaByStandard[$standard['id']] as $criteria): ?>
                                <li>
                                    📁 <?= htmlspecialchars($criteria['name']) ?>

                                    <?php if (!empty($milestoneByCriteria[$criteria['id']])): ?>
                                        <ul>
                                            <?php foreach ($milestoneByCriteria[$criteria['id']] as $milestone): ?>
                                                <li>
                                                    📁 <?= htmlspecialchars($milestone['name']) ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</body>
</html>