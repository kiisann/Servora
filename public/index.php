<?php
session_start();

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
// Ambil base path tanpa trailing slash
$script = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$script = ($script === '/') ? '' : $script;
define('BASE_URL', $protocol . '://' . $host . $script);

require_once '../app/core/Database.php';
require_once '../app/core/Controller.php';
require_once '../app/core/App.php';

$app = new App();