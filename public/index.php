<?php
// public/index.php

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