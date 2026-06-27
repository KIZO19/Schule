<?php
// views/layout/sidebar.php
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= BASE_URL ?>" class="brand-link">
        <i class="fas fa-school fa-lg ml-3 mr-2"></i>
        <span class="brand-text font-weight-light">SMSys</span>
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

    <div class="sidebar">
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

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if ($sessionType === 'parent'): ?>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/Parent/dashboard" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Enfants
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Suivi des enfants</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Notes & évaluations</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-credit-card"></i>
                            <p>
                                Paiements
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Situation comptable</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Fiches de paie</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php elseif ($sessionType === 'agent'): ?>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/Agent/dashboard" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <?php if (!empty($_SESSION['agent_role_id']) && in_array($_SESSION['agent_role_id'], [1, 2, 3, 4, 5])): ?>
                        <li class="nav-item">
                            <a href="<?= BASE_URL ?>/Admin/childRequests" class="nav-link">
                                <i class="nav-icon fas fa-user-check"></i>
                                <p>Demandes d'enfants</p>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>Mon planning</p>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php elseif ($sessionType === 'ecole'): ?>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/Ecole/dashboard" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASE_URL ?>/Admin/childRequests" class="nav-link">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>Demandes d'enfants</p>
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
