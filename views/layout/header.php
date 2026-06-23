<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMSys - Gestion Scolaire</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-p1CmYCoPokrB35YqjKM8KJ6xTg+vVKp5JEcT0BSG0sP3VK8jPQ4UMYUDi+AHGp/SxRzPaw8x5Zk6fZx0gd6HAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/adminlte.min.css">
    <style>
        /* Theme toggle button styles */
        .theme-toggle {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 1100;
        }
        @media (max-width: 576px) {
            .theme-toggle { top: 8px; right: 8px; }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <div class="theme-toggle">
        <button id="theme-toggle-btn" class="btn btn-sm btn-secondary" aria-pressed="false" title="Basculer thème clair/sombre">
            <i id="theme-toggle-icon" class="fas fa-moon"></i>
        </button>
    </div>