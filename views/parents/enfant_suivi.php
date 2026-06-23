<?php include(__DIR__ . '/../layout/header.php'); ?>
<?php include(__DIR__ . '/../layout/sidebar.php'); ?>

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
                <div class="col-lg-4 col-6">
                    <div class="small-box <?= ($compte['reste_a_payer'] <= 0) ? 'bg-success' : 'bg-warning' ?>">
                        <div class="inner">
                            <h3><?= number_format($compte['reste_a_payer'], 2) ?> $</h3>
                            <p>Situation Comptable</p>
                        </div>
                        <div class="icon"><i class="fas fa-wallet"></i></div>
                        <a href="#" class="small-box-footer">Détails <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
                    <div class="small-box <?= (!empty($discipline) && ($discipline['PointsRetires'] ?? 0) > 0) ? 'bg-danger' : 'bg-info' ?>">
                        <div class="inner">
                            <h3><?= isset($discipline['PointsRetires']) ? ('-'.intval($discipline['PointsRetires']).' Pts') : '—' ?></h3>
                            <p>Discipline — <?= htmlspecialchars($discipline['conduite'] ?? 'Excellente') ?></p>
                        </div>
                        <div class="icon"><i class="fas fa-gavel"></i></div>
                        <a href="#" class="small-box-footer">Voir <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= number_format($taux_presence ?? 0, 1) ?> %</h3>
                            <p>Taux de présence (mois)</p>
                        </div>
                        <div class="icon"><i class="fas fa-user-check"></i></div>
                        <a href="#" class="small-box-footer">Détails <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Dernières évaluations & notes</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover table-valign-middle mb-0">
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
            </div>
        </div>
    </section>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>