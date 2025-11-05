<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/admin/addUser.css">
</head>

<body>
    <div class="main-content">
        <div class="container">
            <div class="container-header">
                <h2>CREATE NEW USER</h2>
            </div>

            <div class="container-content">
                <form action="/<?= PROJECT_NAME ?>/admin/users" method="post">
                    <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                    <div class="form-group">
                        <label for="first_name">First name: </label>
                        <input type="text" id="first_name" name="first_name" placeholder="First name">

                        <div class="error-msg">
                            <?php if (!empty($_SESSION['errors']['empty-firstname'])): ?>
                                <p><?= error('empty-firstname') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last name: </label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last name">

                        <div class="error-msg">
                            <?php if (!empty($_SESSION['errors']['empty-lastname'])): ?>
                                <p><?= error('empty-lastname') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input type="text" id="email" name="email" placeholder="Email">

                        <div class="error-msg">
                            <?php if (!empty($_SESSION['errors']['empty-email'])): ?>
                                <p><?= error('empty-email') ?></p>
                            <?php elseif (!empty($_SESSION['errors']['email-invalid'])): ?>
                                <p><?= error('email-invalid') ?></p>
                            <?php elseif (!empty($_SESSION['errors']['email-existed'])): ?>
                                <p><?= error('email-existed') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender:</label>
                        <div class="gender-group">
                            <label>
                                <input type="radio" name="gender" value="male"> Male
                            </label>
                            <label>
                                <input type="radio" name="gender" value="female"> Female
                            </label>
                            <label>
                                <input type="radio" name="gender" value="other"> Other
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
                        <input type="street" id="street" name="street" placeholder="Street">
                    </div>

                    <div class="form-group">
                        <label for="city">City: </label>
                        <input type="city" id="city" name="city" placeholder="City">
                    </div>

                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input type="password" id="password" name="password" placeholder="Password">

                        <div class="error-msg">
                            <?php if (!empty($_SESSION['errors']['empty-password'])): ?>
                                <p><?= error('empty-password') ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="role">Role: </label>
                        <select name="role" id="role">
                            <option value="1">Customer</option>
                            <option value="2">Staff</option>
                            <option value="3">Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <a href="/<?= PROJECT_NAME ?>/admin/dashboard" class="cancel-btn">Cancel</a>
                        <input type="submit" name="submit" value="Create User" class="submit-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
        if (isset($_SESSION['errors'])) {
            unset($_SESSION['errors']);
        }
    ?>
</body>

</html>