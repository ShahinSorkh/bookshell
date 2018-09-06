<?php
require_once __DIR__ . '/includes/index.php';

$action = $_POST['action'];
if ($action === 'login') {
    // login
    print_r($_POST);
} elseif ($action === 'register') {
    // register
    print_r($_POST);
} else {
    $_SESSION['msg'] = 'invalid action';
    $_SESSION['msg-type'] = 'danger';
    header('Location: /');
}
exit;

