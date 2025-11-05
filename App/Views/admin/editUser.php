<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/admin/editUser.css">
</head>

<body>
    <div class="main-content">
        <div class="container">
            <div class="container-header">
                <h2>EDIT USER INFORMATION</h2>
            </div>

            <!-- Edit user form -->
            <div class="container-content">
                <form action="/<?= PROJECT_NAME ?>/admin/users/<?= htmlspecialchars($user[0]['user_id']) ?>" method="post">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user[0]['user_id']) ?>">
                    <input type="hidden" name="address_id" value="<?php echo htmlspecialchars($user[0]['address_id']) ?>">

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
                        <label for="street">Street: </label>
                        <input type="text" id="street" name="street" value="<?php echo htmlspecialchars($user[0]['street']) ?>" placeholder="Street">
                    </div>

                    <div class="form-group">
                        <label for="city">City: </label>
                        <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($user[0]['city']) ?>" placeholder="City">
                    </div>

                    <div class="form-group">
                        <label for="role">Role: </label>
                        <select name="role" id="role">
                            <option value="1" <?php echo htmlspecialchars($user[0]['role'] == App\Models\User::ROLE_USER ? 'selected' : '') ?>>Customer</option>
                            <option value="2" <?php echo htmlspecialchars($user[0]['role'] == App\Models\User::ROLE_STAFF ? 'selected' : '') ?>>Staff</option>
                            <option value="3" <?php echo htmlspecialchars($user[0]['role'] == App\Models\User::ROLE_ADMIN ? 'selected' : '') ?>>Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <a href="/<?= PROJECT_NAME ?>/admin/dashboard" class="cancel-btn">Go back</a>
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