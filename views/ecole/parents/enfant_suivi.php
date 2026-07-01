<?php
$pageTitle = $pageTitle ?? 'Tableau de bord Parent - Gestion Scolaire';
$metaDescription = $metaDescription ?? 'Suivez facilement le solde, les notes et la présence de votre enfant depuis le tableau de bord parent sécurisé.';
$ogTitle = $ogTitle ?? $pageTitle;
$ogDescription = $ogDescription ?? $metaDescription;
$canonicalUrl = $canonicalUrl ?? (BASE_URL . '/Parent/dashboard');
?>
<?php include(__DIR__ . '/../../layout/header.php'); ?>
<?php include(__DIR__ . '/../../layout/sidebar.php'); ?>

<main class="app-main">
    <div class="app-content">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tableau de bord parent</h1>
                        <p class="text-muted">Retrouvez ici le suivi scolaire, les paiements et les évaluations de <?= htmlspecialchars(trim(($eleve['prenom'] ?? '') . ' ' . ($eleve['nom'] ?? ''))) ?>.</p>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Accueil</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid py-4">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                        <div class="row g-0 align-items-stretch">
                            <div class="col-md-7 p-5 text-white" style="background: linear-gradient(135deg, #1e3a8a 0%, #4338ca 100%);">
                                <h1 class="display-5 fw-bold">Bienvenue, <?= htmlspecialchars($_SESSION['parent_name'] ?? 'Parent') ?> !</h1>
                                <p class="lead mb-4">Accédez en un clic à toutes les informations de votre enfant, de la présence aux paiements.</p>
                                <div class="d-flex flex-wrap gap-2 mb-4">
                                    <span class="badge bg-light text-primary py-2 px-3"><i class="fas fa-user-graduate me-2"></i>Suivi élève</span>
                                    <span class="badge bg-light text-primary py-2 px-3"><i class="fas fa-wallet me-2"></i>Paiements</span>
                                    <span class="badge bg-light text-primary py-2 px-3"><i class="fas fa-chart-line me-2"></i>Présence</span>
                                </div>
                                <p class="mb-0">Dernière mise à jour : <?= date('d/m/Y H:i') ?></p>
                            </div>
                            <div class="col-md-5 p-4 bg-white">
                                <div class="mb-4">
                                    <h3 class="h5 text-dark">Résumé rapide</h3>
                                    <p class="text-muted">Statistiques clés pour <?= htmlspecialchars(trim(($eleve['prenom'] ?? '') . ' ' . ($eleve['nom'] ?? ''))) ?>.</p>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Reste à payer</span>
                                        <strong><?= number_format($compte['reste_a_payer'] ?? 0, 2) ?> $</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Taux de présence</span>
                                        <strong><?= number_format($taux_presence ?? 0, 1) ?>%</strong>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Points disciplinaires</span>
                                        <strong><?= isset($discipline['PointsRetires']) ? intval($discipline['PointsRetires']) : 0 ?></strong>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-primary btn-lg w-100 mb-3">Voir le suivi détaillé</a>
                                <a href="#" class="btn btn-outline-secondary btn-lg w-100">Voir les factures</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= number_format($compte['reste_a_payer'] ?? 0, 2) ?> $</h3>
                            <p>Reste à payer</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <a href="#" class="small-box-footer">Voir le détail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= isset($discipline['PointsRetires']) ? ('-'.intval($discipline['PointsRetires'])) : '0' ?></h3>
                            <p>Points disciplinaires</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <a href="#" class="small-box-footer">Voir le détail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= number_format($taux_presence ?? 0, 1) ?>%</h3>
                            <p>Taux de présence</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <a href="#" class="small-box-footer">Voir le détail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= !empty($notes) ? count($notes) : 0 ?></h3>
                            <p>Dernières évaluations</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <a href="#" class="small-box-footer">Voir le détail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-7">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Progression des notes</h3>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="gradesChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Résumé du profil</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Enfant :</strong> <?= htmlspecialchars(trim(($eleve['prenom'] ?? '') . ' ' . ($eleve['nom'] ?? ''))) ?></p>
                            <p><strong>Classe :</strong> <?= htmlspecialchars($eleve['nom_classe'] ?? 'Non définie') ?></p>
                            <p><strong>Parent :</strong> <?= htmlspecialchars($parentName) ?></p>
                            <p><strong>Solde :</strong> <?= number_format($compte['reste_a_payer'] ?? 0, 2) ?> $</p>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($eleves) && count($eleves) > 1): ?>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Tous les enfants</h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Classe</th>
                                            <th>Statut</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($eleves as $child): ?>
                                            <tr class="<?= $child['id'] === $eleve['id'] ? 'table-active' : '' ?>">
                                                <td><?= htmlspecialchars(trim(($child['prenom'] ?? '') . ' ' . ($child['nom'] ?? ''))) ?></td>
                                                <td><?= htmlspecialchars($child['nom_classe'] ?? 'Non définie') ?></td>
                                                <td><?= $child['id'] === $eleve['id'] ? '<span class="badge badge-success">Actif</span>' : '<span class="badge badge-secondary">Inactif</span>' ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            </div>
        </section>
    </div>
</main>

<?php include(__DIR__ . '/../../layout/footer.php'); ?>