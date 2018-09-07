<?php
require_once __DIR__ . '/includes/index.php';
redirect_if_logged_in();

$action = $_POST['action'];
if (in_array($action, ['login', 'register'])) {
    $username = filter_var($_POST['username'], FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/^\\w{5,45}$/']]);
    $username = mysqli_real_escape_string($db, $username);
    $password = filter_var($_POST['password']);
    if (!$username) redirect('/login.php', 'invalid username', 'danger');
    elseif (!$password) redirect('/login.php', 'invalid password', 'danger');
    elseif ($action === 'login') {
        // login
        $result = mysqli_query($db, "select id,password from users where username='{$username}' limit 1;");
        $user = mysqli_fetch_assoc($result);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['id'];
            redirect('/user.php', 'logged in successfully', 'success');
        } else redirect('/login.php', 'user not found', 'danger');
    } else {
        // register
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        $email = mysqli_real_escape_string($db, $email);
        $repassword = filter_var($_POST['re-password']);
        if ($password !== $repassword) redirect('/login.php', 'passwords do not match', 'danger');
        elseif ($username && $email && $password) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $result = mysqli_query($db, "insert into users (username,email,password) values ('{$username}','{$email}','{$password}')");
            if (!$result) redirect('/login.php', mysqli_error($db), 'danger');
            else redirect('/login.php', 'registered successfully', 'success');
        } else redirect('/login.php', 'invalid email', 'danger');
    }
} else redirect('/login.php', 'invalid action', 'danger');
exit;

