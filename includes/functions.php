<?php

function redirect($location, $msg = null, $msg_type = null)
{
    if ($msg) {
        $_SESSION['msg'] = $msg;
        $_SESSION['msg-type'] = $msg_type;
    }
    header(sprintf('Location: %s/%s', ROOT_URL, $location));
    exit;
}

function logged_in()
{
    return isset($_SESSION['user']);
}

function redirect_if_logged_in()
{
    if (logged_in()) {
        $user = $_SESSION['user'];
        redirect("{$user['role']}.php");
    }
}

function redirect_if_not_logged_in()
{
    if (!logged_in()) {
        redirect('login.php', 'ابتدا باید وارد حساب خود شوید', 'warning');
    }
}

function is_admin()
{
    return logged_in() && $_SESSION['user']['role'] === 'admin';
}

function is_user()
{
    return logged_in() && $_SESSION['user']['role'] === 'user';
}

function redirect_if_not_user()
{
    if (!is_user()) {
        redirect('index.php', 'خطای دسترسی', 'warning');
    }
}

function redirect_if_not_admin()
{
    if (!is_admin()) {
        redirect('index.php', 'خطای دسترسی', 'warning');
    }
}

function save_uploaded_file($field, $filename)
{
    if (!array_key_exists($field, $_FILES)) {
        return false;
    }
    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
    $info = pathinfo($_FILES[$field]['name']);
    $newname = "$filename.$info[extension]";

    $target = "/uploaded/$newname";
    $target_path = rtrim(ROOT_DIR, '/').$target;
    if (!is_dir(dirname($target_path))) {
        mkdir(dirname($target_path), 0777, true);
    }
    if (is_file($target_path)) {
        unlink($target_path);
    }

    move_uploaded_file($_FILES[$field]['tmp_name'], $target_path);

    return $target;
}
