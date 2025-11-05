<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/<?= PROJECT_NAME ?>/public/css/auth/register.css">
</head>

<body>
    <div class="main-content">
        <div class="register-container">
            <h2>ACCOUNT REGISTRATION</h2>
            <form action="/<?= PROJECT_NAME ?>/register" method="post">
                <input type="hidden" name="CSRF-token" value="<?= $_SESSION['CSRF-token'] ?>">
                <div>
                    <div class="row">
                        <div class="form-group">
                            <label for="first_name">First name: *</label>
                            <input type="text" name="first_name" id="first_name" placeholder="First name">

                            <div class="error-msg">
                                <?php if (!empty($_SESSION['errors']['empty-firstname'])): ?>
                                    <p><?= error('empty-firstname') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name">Last name: *</label>
                            <input type="text" name="last_name" id="last_name" placeholder="Last name">

                            <div class="error-msg">
                                <?php if (!empty($_SESSION['errors']['empty-lastname'])): ?>
                                    <p><?= error('empty-lastname') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group">
                            <label for="email">Email: * </label>
                            <input type="text" name="email" id="email" placeholder="email">

                            <div class="error-msg">
                                <?php if (!empty($_SESSION['errors']['empty-email'])): ?>
                                    <p><?= error('empty-email') ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="error-msg">
                                <?php if (!empty($_SESSION['errors']['email-existed'])): ?>
                                    <p><?= error('email-existed') ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="error-msg">
                                <?php if (!empty($_SESSION['errors']['email-invalid'])): ?>
                                    <p><?= error('email-invalid') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender">Gender: *</label>
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
                    </div>
                    
                    <div class="row">
                        <div class="form-group">
                            <label for="city">City: * </label>
                            <input type="text" name="city" id="city" placeholder="City">
                        </div>

                        <div class="form-group">
                            <label for="street">Street: * </label>
                            <input type="text" name="street" id="street" placeholder="Street">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="password">Password: *</label>
                            <input type="password" name="password" id="password" placeholder="password">

                            <div class="error-msg">
                                <?php if (!empty($_SESSION['errors']['empty-password'])): ?>
                                    <p><?= error('empty-password') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="password-confirmation">Password confirm: *</label>
                            <input type="password" name="password-confirmation" id="password-confirmation" placeholder="Confirm your password">

                            <div class="error-msg">
                                <?php if (!empty($_SESSION['errors']['pwd-confirm-error'])): ?>
                                    <p><?= error('pwd-confirm-error') ?></p>
                                <?php endif; ?>
                            </div>

                            <div class="error-msg">
                                <?php if (!empty($_SESSION['errors']['pwd-mismatch'])): ?>
                                    <p><?= error('pwd-mismatch') ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="submit-box">
                    <div class="login-btn">
                        <p>Already have an account? </p>
                        <p><a href="/<?= PROJECT_NAME ?>/login">Login here</a></p>
                    </div>
            
                    <button class="submit-btn" type="submit">Register</button>
                </div>

            </form>
        </div>

        <?php
            if (isset($_SESSION['errors'])) {
                unset($_SESSION['errors']);
            }
        ?>

    </div>
</body>

</html>