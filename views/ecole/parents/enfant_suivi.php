<?php include(__DIR__ . '/../../layout/header.php'); ?>
<?php include(__DIR__ . '/../../layout/sidebar.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Suivi de l'enfant : <?= htmlspecialchars($eleve['prenom'] . ' ' . $eleve['nom']) ?></h1>
                    <p class="text-muted">Classe : <?= htmlspecialchars($eleve['nom_classe'] ?? 'Non définie') ?></p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                        <li class="breadcrumb-item active">Suivi</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-4">Tableau de bord — <?= htmlspecialchars($eleve['prenom'] . ' ' . $eleve['nom']) ?></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                    <div class="kpi-box kpi-blue">
                        <div>
                            <div class="kpi-value"><?= number_format($compte['reste_a_payer'] ?? 0,2) ?> $</div>
                            <div class="kpi-desc">Reste à payer</div>
                        </div>
                        <div class="text-right"><i class="fas fa-wallet fa-2x"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                    <div class="kpi-box kpi-green">
                        <div>
                            <div class="kpi-value"><?= isset($discipline['PointsRetires']) ? ('-'.intval($discipline['PointsRetires']).' Pts') : '0 Pts' ?></div>
                            <div class="kpi-desc">Discipline</div>
                        </div>
                        <div class="text-right"><i class="fas fa-gavel fa-2x"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                    <div class="kpi-box kpi-yellow">
                        <div>
                            <div class="kpi-value"><?= number_format($taux_presence ?? 0,1) ?> %</div>
                            <div class="kpi-desc">Taux de présence (mois)</div>
                        </div>
                        <div class="text-right"><i class="fas fa-user-check fa-2x"></i></div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                    <div class="kpi-box kpi-red">
                        <div>
                            <div class="kpi-value"><?= !empty($notes) ? count($notes) : 0 ?></div>
                            <div class="kpi-desc">Dernières évaluations</div>
                        </div>
                        <div class="text-right"><i class="fas fa-chart-pie fa-2x"></i></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-dark-header">
                        <div class="card-header">
                            <h3 class="card-title">Progression des notes</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="gradesChart" style="height:300px; width:100%"></canvas>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Détails des évaluations</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover notes-table mb-0">
                                <thead>
                                    <tr>
                                        <th>Cours</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th class="text-center">Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($notes) && is_array($notes)): ?>
                                    <?php foreach ($notes as $note): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($note['nom_cours'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($note['type_evaluation'] ?? '-') ?></td>
                                        <td><?= !empty($note['date_evaluation']) ? date('d/m/Y', strtotime($note['date_evaluation'])) : '-' ?></td>
                                        <td class="text-center font-weight-bold text-primary"><?= htmlspecialchars($note['note_obtenue'] ?? '-') ?> <small class="text-muted">/ <?= htmlspecialchars($note['ponderation_max'] ?? '-') ?></small></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Aucune note enregistrée.</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Carte de présence</h3>
                        </div>
                        <div class="card-body p-0">
                            <div style="height:300px; display:flex; align-items:center; justify-content:center; background:linear-gradient(180deg,#f5f7fa,#e9eef6);">
                                <div class="text-center text-muted">[Map / Graphique]</div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Résumé</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Classe :</strong> <?= htmlspecialchars($eleve['nom_classe'] ?? 'Non définie') ?></p>
                            <p><strong>Parent :</strong> <?= htmlspecialchars($_SESSION['parent_name'] ?? 'Parent') ?></p>
                            <p><strong>Solde :</strong> <?= number_format($compte['reste_a_payer'] ?? 0,2) ?> $</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>