<?php

function redirect($location, $msg = null, $msg_type = null)
{
    if ($msg) {
        $_SESSION['msg'] = $msg;
        $_SESSION['msg-type'] = $msg_type;
    }
    header("Location: {$location}");
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
        redirect("/{$user['role']}/index.php");
    }
}

function redirect_if_not_logged_in()
{
    if (!logged_in()) {
        redirect('/login.php', 'you have to log in first', 'danger');
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
        redirect('/index.php', 'you are not allowed to be here', 'danger');
    }
}

function redirect_if_not_admin()
{
    if (!is_admin()) {
        redirect('/index.php', 'you are not allowed to be here', 'danger');
    }
}

function save_uploaded_file($field, $filename)
{
    if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) return false;
    $info = pathinfo($_FILES[$field]['name']);
    $newname = "$filename.$info[extension]";

    $target = "/uploaded/$newname";
    $target_path = ROOT_DIR . $target;
    if (!is_dir(dirname($target_path))) mkdir(dirname($target_path), 0777, true);
    if (is_file($target_path)) unlink($target_path);

    move_uploaded_file( $_FILES[$field]['tmp_name'], $target_path);
    return $target;
}

