<?php $guest_required = true; $current_page = 'login'; include_once __DIR__ . '/template/head.php'; ?>

<form class="form-signin border" action="<?= ROOT_URL ?>/auth.php" method="post">
    <div class="text-center mb-4">
        <h2 class="h3 mb-3 font-weight-normal rounded text-light bg-info">ورود</h2>
    </div>
    <div class="form-label-group">
        <input class="form-control" id="login-username" name="username" type="text" placeholder="نام کاربری" required autofocus>
        <label class="rtl" for="login-username">نام کاربری</label>
    </div>

    <div class="form-label-group">
        <input class="form-control" id="login-password" name="password" type="password" placeholder="رمز ورود" required>
        <label class="rtl" for="login-password">رمز ورود</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" name="action" value="login" type="submit">ورود</button>
</form>

<form class="form-signin border" action="<?= ROOT_URL ?>/auth.php" method="post">
    <div class="text-center mb-4">
        <h2 class="h3 mb-3 font-weight-normal rounded text-light bg-info">ثبت نام</h2>
    </div>
    <div class="form-label-group">
        <input class="form-control" id="register-username" name="username" type="text" placeholder="نام کاربری" required>
        <label class="rtl" for="register-username">نام کاربری</label>
    </div>
    <div class="form-label-group">
        <input class="form-control" id="register-email" name="email" type="email" placeholder="ایمیل" required>
        <label class="rtl" for="register-email">ایمیل</label>
    </div>
    <div class="form-label-group">
        <input class="form-control" id="register-password" name="password" type="password" placeholder="رمز ورود" required>
        <label class="rtl" for="register-password">رمز ورود</label>
    </div>
    <div class="form-label-group">
        <input class="form-control" id="register-re-password" name="re-password" type="password" placeholder="تکرار رمز ورود" required>
        <label class="rtl" for="register-re-password">تکرار رمز ورود</label>
    </div>

    <button class="btn btn-lg btn-primary btn-block" name="action" value="register" type="submit">ثبت نام</button>
</form>

<?php include_once __DIR__ . '/template/foot.php'; ?>
