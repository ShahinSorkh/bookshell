<?php

function redirect($location, $msg = null, $msg_type = null)
{
    if ($msg) {
        $_SESSION['msg'] = $msg;
        $_SESSION['msg-type'] = $msg_type;
    }
    header("Location: {$location}");
}

function redirect_if_logged_in()
{
    if (logged_in()) {
        redirect('/user.php');
        exit;
    }
}

function redirect_if_not_logged_in()
{
    if (!logged_in()) {
        redirect('/login.php', 'you have to log in first', 'danger');
        exit;
    }
}

function logged_in()
{
    return isset($_SESSION['user']);
}

