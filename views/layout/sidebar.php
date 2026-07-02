<?php
// views/layout/sidebar.php
$currentRoute = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$isActive = function($uri) use ($currentRoute) {
    return strpos($currentRoute, trim($uri, '/')) === 0 ? 'active' : '';
};
?>
<aside class="app-sidebar sidebar-dark-primary elevation-4">
    <?php $siteLabel = $_SESSION['selected_ecole_name'] ?? $_SESSION['ecole_name'] ?? 'SMSys'; ?>
    <a href="<?= BASE_URL ?>" class="brand-link sidebar-brand">
        <span class="brand-image img-circle elevation-3 bg-white text-primary d-flex align-items-center justify-content-center" style="width:2.5rem;height:2.5rem;">
            <i class="fas fa-school"></i>
        </span>
        <span class="brand-text font-weight-light ml-2"><?= htmlspecialchars($siteLabel) ?></span>
    </a>

    <?php
    $sessionType = 'parent';
    if (!empty($_SESSION['agent_id'])) {
        $sessionType = 'agent';
    } elseif (!empty($_SESSION['ecole_id'])) {
        $sessionType = 'ecole';
    }

    $userName = $_SESSION['agent_name'] ?? $_SESSION['ecole_name'] ?? $_SESSION['parent_name'] ?? 'Utilisateur';
    $userArea = 'Espace Parent';
    $logoutUrl = BASE_URL . '/Auth/logout';
    if ($sessionType === 'agent') {
        $userArea = 'Espace Personnel';
        $logoutUrl = BASE_URL . '/Agent/logout';
    } elseif ($sessionType === 'ecole') {
        $userArea = 'Espace École';
        $logoutUrl = BASE_URL . '/Ecole/logout';
    }

    $avatarLetter = strtoupper(substr($userName, 0, 1));
    ?>

    <div class="sidebar sidebar-wrapper">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <span class="img-circle elevation-2 bg-secondary d-flex align-items-center justify-content-center" style="width:2.5rem;height:2.5rem;color:#fff;font-size:1.1rem;">
                    <?= htmlspecialchars($avatarLetter) ?>
                </span>
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= htmlspecialchars($userName) ?></a>
                <span class="text-muted" style="font-size: .85rem; display: block;"><?= htmlspecialchars($userArea) ?></span>
            </div>
        </div>

        <nav class="mt-2" aria-label="Main navigation">
            <ul class="nav nav-pills nav-sidebar flex-column" data-lte-toggle="treeview" data-lte-accordion="false" role="menu" id="navigation">
                <?php if ($sessionType === 'parent'): ?>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/Parent/dashboard" class="nav-link <?= $isActive('/Parent/dashboard') ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item <?= $isActive('/Parent') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link" data-lte-toggle="treeview">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Enfants
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= BASE_URL ?>/Parent/dashboard" class="nav-link <?= $isActive('/Parent/dashboard') ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Suivi de l'enfant</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= BASE_URL ?>/Parent/dashboard" class="nav-link <?= $isActive('/Parent/dashboard') ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Notes & évaluations</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item <?= $isActive('/Paie') ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link" data-lte-toggle="treeview">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>
                                Paiements
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= BASE_URL ?>/Parent/dashboard" class="nav-link <?= $isActive('/Parent/dashboard') ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Situation comptable</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= BASE_URL ?>/Parent/dashboard" class="nav-link <?= $isActive('/Parent/dashboard') ?>">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Fiches de paie</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php elseif ($sessionType === 'agent'): ?>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/Agent/dashboard" class="nav-link <?= $isActive('/Agent/dashboard') ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <?php
                        $agentRoleKey = $_SESSION['agent_role_key'] ?? strtolower(str_replace(' ', '_', trim($_SESSION['agent_role_title'] ?? '')));
                    ?>
                    <?php if (in_array($agentRoleKey, ['super_admin', 'ecole_admin'])): ?>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>/Admin/childRequests" class="nav-link <?= $isActive('/Admin/childRequests') ?>">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>Administration</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>/Ecole/dashboard" class="nav-link <?= $isActive('/Ecole/dashboard') ?>">
                                <i class="nav-icon fas fa-school"></i>
                                <p>Établissement</p>
                            </a>
                        </li>
                    <?php elseif (in_array($_SESSION['agent_role_id'] ?? null, [1, 2, 3, 4, 5])): ?>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>/Admin/childRequests" class="nav-link <?= $isActive('/Admin/childRequests') ?>">
                                <i class="nav-icon fas fa-user-check"></i>
                                <p>Demandes d'enfants</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Gestion du personnel</p>
                            </a>
                        </li>
                    <?php elseif (in_array($_SESSION['agent_role_id'] ?? null, [6, 7])): ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link <?= $isActive('/Agent/planning') ?>">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>Mon planning</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Évaluations</p>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>Fonctions générales</p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php elseif ($sessionType === 'ecole'): ?>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/Ecole/dashboard" class="nav-link <?= $isActive('/Ecole/dashboard') ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/Admin/childRequests" class="nav-link <?= $isActive('/Admin/childRequests') ?>">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>Demandes d'enfants</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link <?= $isActive('/Ecole/parents') ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Parents</p>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?= $logoutUrl ?>" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Déconnexion</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
