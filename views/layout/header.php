<!DOCTYPE html>
<html lang="fr">
<head>
    <?php $siteLabel = $_SESSION['selected_ecole_name'] ?? $_SESSION['ecole_name'] ?? 'SMSys'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? ($siteLabel . ' - Gestion Scolaire')) ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription ?? ($siteLabel . ', portail de gestion scolaire pour parents, élèves et administrateurs. Suivez les notes, la présence et les paiements sur une interface centralisée.')) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($metaKeywords ?? 'tableau de bord parent, gestion scolaire, notes, présence, paiements, enfant, suivi scolaire') ?>">
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl ?? (BASE_URL . $_SERVER['REQUEST_URI'])) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle ?? ($pageTitle ?? ($siteLabel . ' - Gestion Scolaire'))) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($ogDescription ?? ($metaDescription ?? 'Accédez au tableau de bord parent de votre établissement scolaire.')) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= htmlspecialchars($ogUrl ?? (BASE_URL . $_SERVER['REQUEST_URI'])) ?>">
    <script>
      (() => {
        'use strict';
        const STORAGE_KEY = 'lte-theme';
        let stored = null;
        try {
          stored = localStorage.getItem(STORAGE_KEY);
        } catch {
          stored = null;
        }
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        let resolved = 'light';
        if (stored === 'dark' || stored === 'light') {
          resolved = stored;
        } else if (prefersDark) {
          resolved = 'dark';
        }
        document.documentElement.setAttribute('data-bs-theme', resolved);
        document.documentElement.style.colorScheme = resolved;
      })();
    </script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-p1CmYCoPokrB35YqjKM8KJ6xTg+vVKp5JEcT0BSG0sP3VK8jPQ4UMYUDi+AHGp/SxRzPaw8x5Zk6fZx0gd6HAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-whVOJ8cNTcR+CHkgf5+2rC+8+eX2eRV7s0kCxkYc7qOLe+/iCQQE4fJpOj5g5Yh7" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/custom.css">
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
<body class="hold-transition sidebar-expand layout-fixed">
<div class="app-wrapper">
    <nav class="app-header navbar navbar-expand navbar-white navbar-light">
        <?php
        $dashboardUrl = BASE_URL;
        if (!empty($_SESSION['agent_id'])) {
            $dashboardUrl = BASE_URL . '/Agent/dashboard';
        } elseif (!empty($_SESSION['parent_id'])) {
            $dashboardUrl = BASE_URL . '/Parent/dashboard';
        } elseif (!empty($_SESSION['ecole_id'])) {
            $dashboardUrl = BASE_URL . '/Ecole/dashboard';
        }
    ?>
    <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-md-inline-block">
                <a href="<?= BASE_URL ?>" class="nav-link">Accueil</a>
            </li>
            <li class="nav-item d-none d-md-inline-block">
                <a href="<?= $dashboardUrl ?>" class="nav-link">Tableau de bord</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item d-none d-md-inline-block">
                <a class="nav-link" href="#" title="Rechercher"><i class="bi bi-search"></i></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#" title="Messages">
                    <i class="bi bi-chat-text"></i>
                    <span class="navbar-badge badge text-bg-danger">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-header">3 messages</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <div class="d-flex align-items-start">
                            <img src="<?= BASE_URL ?>/public/assets/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 me-3 rounded-circle">
                            <div class="flex-fill">
                                <h3 class="dropdown-item-title">Support Team <span class="float-end text-sm text-danger"><i class="fas fa-star"></i></span></h3>
                                <p class="text-sm mb-1">Can we meet today?</p>
                                <p class="text-sm text-muted"><i class="far fa-clock me-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">Voir tous les messages</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" data-bs-toggle="dropdown" href="#" title="Notifications">
                    <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <span class="dropdown-header">5 notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item"><i class="fas fa-envelope me-2"></i> 4 messages<span class="float-end text-muted text-sm">3 mins</span></a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">Voir toutes</a>
                </div>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="<?= BASE_URL ?>/public/assets/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline"><?= htmlspecialchars($_SESSION['agent_name'] ?? $_SESSION['ecole_name'] ?? $_SESSION['parent_name'] ?? 'Utilisateur') ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary text-center py-3">
                        <img src="<?= BASE_URL ?>/public/assets/img/user2-160x160.jpg" class="img-circle elevation-2 mb-2" alt="User Image" style="width:60px;height:60px;">
                        <p class="mb-0"><?= htmlspecialchars($_SESSION['agent_name'] ?? $_SESSION['ecole_name'] ?? $_SESSION['parent_name'] ?? 'Utilisateur') ?><small class="d-block text-light mt-1"><?= htmlspecialchars($_SESSION['agent_role_title'] ?? ($_SESSION['parent_id'] ? 'Parent' : ($_SESSION['ecole_id'] ? 'École' : 'Utilisateur'))) ?></small></p>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="#" class="dropdown-item"><i class="fas fa-user me-2"></i> Profil</a></li>
                    <li><a href="#" class="dropdown-item"><i class="fas fa-cogs me-2"></i> Paramètres</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="<?= BASE_URL ?>/Auth/logout" class="dropdown-item"><i class="fas fa-sign-out-alt me-2"></i> Déconnexion</a></li>
                </ul>
            </li>
            <li class="nav-item d-none d-md-inline-block">
                <div class="theme-toggle">
                    <button id="theme-toggle-btn" class="btn btn-sm btn-secondary" aria-pressed="false" title="Basculer thème clair/sombre">
                        <i id="theme-toggle-icon" class="fas fa-moon"></i>
                    </button>
                </div>
            </li>
        </ul>
    </nav>