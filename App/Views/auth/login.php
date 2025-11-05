<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/auth/login.css">
</head>
<body>
    <div class="main-content">
        <div class="login-container">
            <h2>LOGIN</h2>
            <form action="/<?= PROJECT_NAME ?>/login" method="post">
                <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                <div>
                    <label for="email">Email: *</label>
                    <input type="email" id="email" name="email" placeholder="Email">
                    <br>

                    <div class="error-msg">
                        <?php if (!empty($_SESSION['errors']['empty-email'])): ?>
                            <p><?= error('empty-email') ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="error-msg">
                        <?php if (!empty($_SESSION['errors']['email-not-existed'])): ?>
                            <p><?= error('email-not-existed') ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div>
                    <label for="password">Password: *</label>
                    <input type="password" name="password" placeholder="Password">
                    <br>
                    
                    <div class="error-msg">
                        <?php if (!empty($_SESSION['errors']['incorrect-password'])): ?>
                            <p><?= error('incorrect-password') ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <button type="submit">Login</button>
            </form>

            <p>
                Don't have an account?
                <a href="/<?= PROJECT_NAME ?>/register">Register</a>
            </p>
        </div>
    </div>

    <?php
        if (isset($_SESSION['errors'])) {
            unset($_SESSION['errors']);
        }
    ?>
</body>
</html>