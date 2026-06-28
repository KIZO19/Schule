<?php
// public/index.php

// Configure des paramètres de cookie pour sécuriser les sessions
$isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
ini_set('session.use_strict_mode', '1');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_secure', $isHttps ? '1' : '0');

// PHP 7.3+ supports passing an array with samesite
session_set_cookie_params([
	'lifetime' => 0,
	'path' => '/',
	'secure' => $isHttps,
	'httponly' => true,
	'samesite' => 'Lax'
]);

session_start();

// 1. Charger la configuration
require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/config/app.php';

// 2. Charger les classes du Core (ATTENTION À L'ORDRE)
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Controller.php'; // Doit être chargé AVANT App.php
require_once __DIR__ . '/../app/core/App.php';

// 3. Lancer l'application
$app = new App();