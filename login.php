<?php $guest_required = true; $current_page = 'login'; include_once __DIR__ . '/template/head.php'; ?>
<form class="login-form" action="<?= ROOT_URL ?>/auth.php" method="post">
    <div class="field-box">
        <label for="login-username">نام کاربری</label>
        <input id="login-username" name="username" type="text">
    </div>
    <div class="field-box">
        <label for="login-password">رمز ورود</label>
        <input id="login-password" name="password" type="password">
    </div>
    <button type="submit" name="action" value="login">ورود</button>
</form>
<form class="register-form" action="<?= ROOT_URL ?>/auth.php" method="post">
    <div class="field-box">
        <label for="register-username">نام کاربری</label>
        <input id="register-username" name="username" type="text">
    </div>
    <div class="field-box">
        <label for="register-email">ایمیل</label>
        <input id="register-email" name="email" type="email">
    </div>
    <div class="field-box">
        <label for="register-password">رمز ورود</label>
        <input id="register-password" name="password" type="password">
    </div>
    <div class="field-box">
        <label for="register-re-password">تکرار رمز ورود</label>
        <input id="register-re-password" name="re-password" type="password">
    </div>
    <button type="submit" name="action" value="register">ثبت نام</button>
</form>
<br style="clear: both;">
<?php include_once __DIR__ . '/template/foot.php'; ?>
