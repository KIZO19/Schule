<?php include(__DIR__ . '/../layout/header.php'); ?>
<?php include(__DIR__ . '/../layout/sidebar.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tableau de bord <?= htmlspecialchars($roleTitle) ?></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Bienvenue, <?= htmlspecialchars($_SESSION['agent_name'] ?? 'Personnel') ?></h3>
                        </div>
                        <div class="card-body">
                            <p>Vous êtes connecté en tant que <strong><?= htmlspecialchars($roleTitle) ?></strong>.</p>
                            <?php if ($dashboardType === 'management'): ?>
                                <p>Utilisez ce tableau de bord pour gérer les inscriptions, les demandes des parents et organiser les opérations de l'établissement.</p>
                            <?php elseif ($dashboardType === 'teaching'): ?>
                                <p>Utilisez ce tableau de bord pour suivre vos classes, consulter vos effectifs et préparer vos évaluations.</p>
                            <?php else: ?>
                                <p>Accédez à vos fonctionnalités selon votre rôle au sein de l'école.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php if ($dashboardType === 'management'): ?>
                    <div class="col-lg-6 col-md-12">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="fas fa-user-check"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Demandes d'enfants</span>
                                <span class="info-box-number">Consulter</span>
                                <a href="<?= BASE_URL ?>/Admin/childRequests" class="small text-white">Voir les demandes</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="fas fa-users"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Gestion du personnel</span>
                                <span class="info-box-number">Voir les rôles</span>
                                <span class="progress-description">Organisez les rôles selon les besoins de l'école.</span>
                            </div>
                        </div>
                    </div>
                <?php elseif ($dashboardType === 'teaching'): ?>
                    <div class="col-lg-6 col-md-12">
                        <div class="info-box bg-primary">
                            <span class="info-box-icon"><i class="fas fa-chalkboard-teacher"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Mon emploi du temps</span>
                                <span class="info-box-number">À planifier</span>
                                <span class="progress-description">Accédez à vos classes et matières.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="info-box bg-warning">
                            <span class="info-box-icon"><i class="fas fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Évaluations et notes</span>
                                <span class="info-box-number">Suivre</span>
                                <span class="progress-description">Consultez vos procès-verbaux et bulletins.</span>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-lg-6 col-md-12">
                        <div class="card card-secondary">
                            <div class="card-body">
                                <p>Votre rôle n'est pas encore mappé à un tableau de bord spécifique. Contactez l'administrateur pour activer les fonctionnalités liées à ce rôle.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>
