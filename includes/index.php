<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('ROOT_DIR', __DIR__.'/..');

$env_entries = explode(PHP_EOL, file_get_contents(ROOT_DIR.'/.env'));
foreach ($env_entries as $entry) {
    if (strpos($entry, '=') === false) {
        continue;
    }
    list($key, $value) = explode('=', $entry);
    if (!defined($key)) {
        define(trim($key), trim($value));
    }
}

require_once __DIR__.'/db.php';
require_once __DIR__.'/functions.php';

session_start();
