<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/staff/edit.css">
    <title>Edit Book</title>
</head>

<body>
    <div class="main-content">
        <div class="sidebar">
            <?php include_once VIEW_PATH . '/layouts/parts/staff/sidebar.staff.php' ?>
        </div>


        <div class="container">
            <div class="container-header">
                <h2>CHỈNH SỬA MINH CHỨNG</h2>
            </div>

            <div class="container-content">
                <form action="/<?= PROJECT_NAME ?>/staff/evidences/<?= htmlspecialchars($evidence[0]['id']) ?>" method="post" enctype="">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                    <input type="hidden" name="_method" value="PUT">

                    <div class="form-group">
                        <label for="evidence_id">Mã minh chứng:</label>
                        <input type="text" id="evidence_id" name="evidence_id" placeholder="H1.01.01.01"
                            value="<?= htmlspecialchars($evidence[0]['id']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="evidence_name">Tên minh chứng:</label>
                        <input type="text" id="evidence_name" name="evidence_name" placeholder="Tên minh chứng"
                            value="<?= htmlspecialchars($evidence[0]['name']) ?>">
                    </div>

                    <!-- <div class="form-group">
                        <label for="milestone_id">Mốc đánh giá:</label>
                        <input type="text" id="milestone_id" name="milestone_id" placeholder="TĐG"
                            value="<?= htmlspecialchars($evidence[0]['milestone_id']) ?>">
                    </div> -->

                    <div class="form-group">
                        <label for="decision">Quyết định:</label>
                        <input type="text" id="decision" name="decision" placeholder="Quyết định"
                            value="<?= htmlspecialchars($evidence[0]['decision']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="document_date">Ngày văn bản:</label>
                        <input type="date" id="document_date" name="document_date" placeholder="Ngày văn bản"
                            value="<?= htmlspecialchars($evidence[0]['document_date']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="issue_place">Nơi phát hành:</label>
                        <input type="text" id="issue_place" name="issue_place" placeholder="Phát hành"
                            value="<?= htmlspecialchars($evidence[0]['issue_place']) ?>">
                    </div>

                    <div class="form-group">
                        <label for="link">Liên kết:</label>
                        <input type="text" id="link" name="link" placeholder="link"
                            value="<?= htmlspecialchars($evidence[0]['link']) ?>">

                    </div>

                    <div class="form-group">
                        <a href="/<?= PROJECT_NAME ?>/staff/evidences" class="cancel-btn">Cancel</a>
                        <input type="submit" name="submit" value="Save" class="submit-btn">
                    </div>
                </form>

            </div>
        </div>

    </div>
</body>

</html>