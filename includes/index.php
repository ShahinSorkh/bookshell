<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT_DIR', __DIR__ . '/..');
define('ROOT_URL', 'http://zareibookshellpro.ir');

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

session_start();

