<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/admin/edit.css">
</head>

<body>
    <div class="main-content">
        <!--Sidebar-->
        <div class="sidebar">
            <?php include_once VIEW_PATH . '/layouts/parts/admin/sidebar.admin.php' ?>
        </div>
        <div class="container">
            <div class="container-header">
                <h2>EDIT USER INFORMATION</h2>
            </div>

            <!-- Edit user form -->
            <div class="container-content">
                <form action="/<?= PROJECT_NAME ?>/admin/users/<?= htmlspecialchars($user[0]['id']) ?>" method="post">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user[0]['id']) ?>">

                    <div class="form-group">
                        <label for="first_name">First name: </label>
                        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user[0]['first_name']) ?>" placeholder="First name">

                        <div class="error-msg">
                            <?php if (!empty($_SESSION['errors']['empty-firstname'])): ?>
                                <p><?= error('empty-firstname') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last name: </label>
                        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user[0]['last_name']) ?>" placeholder="Last name">

                        <div class="error-msg">
                            <?php if (!empty($_SESSION['errors']['empty-lastname'])): ?>
                                <p><?= error('empty-lastname') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($user[0]['email']) ?>" placeholder="Email">

                        <div class="error-msg">
                            <?php if (!empty($_SESSION['errors']['empty-email'])): ?>
                                <p><?= error('empty-email') ?></p>
                            <?php elseif (!empty($_SESSION['errors']['email-invalid'])): ?>
                                <p><?= error('email-invalid') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <div class="gender-group">
                            <label>
                                <input type="radio" name="gender" value="male"
                                <?= ($user[0]['gender'] == 'male') ? 'checked' : '' ?>> Male
                            </label>
                            <label>
                                <input type="radio" name="gender" value="female"
                                <?= ($user[0]['gender'] == 'female') ? 'checked' : '' ?>> Female
                            </label>
                            <label>
                                <input type="radio" name="gender" value="other"
                                <?= ($user[0]['gender'] == 'other') ? 'checked' : '' ?>> Other
                            </label>
                        </div>

                        <div class="error-msg">
                            <?php if (!empty($_SESSION['errors']['empty-gender'])): ?>
                                <p><?= error('empty-gender') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="department_id">Department: </label>

                        <select name="department_id" id="department_id">
                            <?php foreach ($departments as $department): ?>
                                <option value="<?= htmlspecialchars($department['id']) ?>" <?= htmlspecialchars($user[0]['department_id'] === $department['id']  ? 'selected' : '') ?>><?= htmlspecialchars($department['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="role_id">Role: </label>

                        <select name="role_id" id="role_id">
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= htmlspecialchars($role['id']) ?>" <?= htmlspecialchars($user[0]['role_id'] === $role['id']  ? 'selected' : '') ?>><?= htmlspecialchars($role['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <a href="/<?= PROJECT_NAME ?>/admin/users" class="cancel-btn">Go back</a>
                        <input type="submit" class="submit-btn" value="Save">
                    </div>
                </form>
            </div>
        </div>

        <?php
            if (isset($_SESSION['errors'])) {
                unset($_SESSION['errors']);
            }
        ?>
    </div>
</body>

</html>