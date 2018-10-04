<?php
require_once __DIR__ . '/includes/index.php';

unset($_SESSION['user']);
redirect('/', 'logged out successfully', 'success');

