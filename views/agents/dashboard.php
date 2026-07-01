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
                            <p><?= htmlspecialchars($dashboardHeader) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php if (!empty($dashboardCards)): ?>
                    <?php foreach ($dashboardCards as $card): ?>
                        <div class="col-lg-6 col-md-12">
                            <div class="info-box <?= htmlspecialchars($card['bg']) ?>">
                                <span class="info-box-icon"><i class="fas <?= htmlspecialchars($card['icon']) ?>"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><?= htmlspecialchars($card['title']) ?></span>
                                    <span class="info-box-number">&nbsp;</span>
                                    <span class="progress-description"><?= htmlspecialchars($card['text']) ?></span>
                                    <?php if (!empty($card['link'])): ?>
                                        <a href="<?= htmlspecialchars($card['link']) ?>" class="small text-white"><?= htmlspecialchars($card['linkText']) ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-lg-12 col-md-12">
                        <div class="card card-secondary">
                            <div class="card-body">
                                <p>Votre rôle n'est pas encore mappé à un tableau de bord spécifique. Contactez l'administrateur.</p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>
