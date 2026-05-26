<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../classes/Auth.php';

Auth::requireLogin();
require_once __DIR__ . '/header.php';
?>
