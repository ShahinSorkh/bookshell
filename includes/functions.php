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
        redirect("/{$user['role']}.php");
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

function redirect_if_not_admin()
{
    if (!is_admin()) {
        redirect('/index.php', 'you are not allowed to be here', 'danger');
    }
}

