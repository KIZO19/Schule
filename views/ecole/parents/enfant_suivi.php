<?php
$pageTitle = $pageTitle ?? 'Tableau de bord Parent - Gestion Scolaire';
$metaDescription = $metaDescription ?? 'Suivez facilement le solde, les notes et la présence de votre enfant depuis le tableau de bord parent sécurisé.';
$ogTitle = $ogTitle ?? $pageTitle;
$ogDescription = $ogDescription ?? $metaDescription;
$canonicalUrl = $canonicalUrl ?? (BASE_URL . '/Parent/dashboard');
?>
<?php include(__DIR__ . '/../../layout/header.php'); ?>
<?php include(__DIR__ . '/../../layout/sidebar.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard Parent</h1>
                    <p class="text-muted">Tableau de bord pédagogique et financier pour <?= htmlspecialchars(trim(($eleve['prenom'] ?? '') . ' ' . ($eleve['nom'] ?? '')) ?: 'votre enfant') ?>.</p>
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
        <div class="container-fluid">
            <div class="row">
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

            <div class="row">
                <div class="col-lg-7 connectedSortable">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Progression des notes</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="gradesChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="card direct-chat direct-chat-primary">
                        <div class="card-header">
                            <h3 class="card-title">Notifications</h3>
                            <div class="card-tools">
                                <span title="2 nouveaux messages" class="badge badge-primary">2</span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="direct-chat-messages" style="max-height: 260px; overflow-y:auto;">
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left">École</span>
                                        <span class="direct-chat-timestamp float-right">09:30</span>
                                    </div>
                                    <img class="direct-chat-img" src="<?= BASE_URL ?>/public/assets/img/user2-160x160.jpg" alt="User Image">
                                    <div class="direct-chat-text">Le paiement du trimestre a bien été reçu.</div>
                                </div>
                                <div class="direct-chat-msg right">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-right"><?= htmlspecialchars($parentName) ?></span>
                                        <span class="direct-chat-timestamp float-left">09:35</span>
                                    </div>
                                    <img class="direct-chat-img" src="<?= BASE_URL ?>/public/assets/img/user1-128x128.jpg" alt="Parent Image">
                                    <div class="direct-chat-text">Merci, je veux voir le calendrier des réunions.</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <form action="#" method="post">
                                <div class="input-group">
                                    <input type="text" name="message" placeholder="Écrire un message..." class="form-control">
                                    <span class="input-group-append">
                                        <button type="submit" class="btn btn-primary">Envoyer</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 connectedSortable">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Carte de présence</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="d-flex justify-content-center align-items-center" style="height: 260px; background: linear-gradient(135deg, #3c8dbc 0%, #00c0ef 100%); border-radius: .25rem;">
                                <span class="text-white font-weight-bold">Carte de présence</span>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-4 text-center border-right">
                                    <div class="description-block">
                                        <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> <?= number_format($taux_presence ?? 0,1) ?>%</span>
                                        <h5 class="description-header"><?= number_format($taux_presence ?? 0,1) ?>%</h5>
                                        <span class="description-text">Présence</span>
                                    </div>
                                </div>
                                <div class="col-4 text-center border-right">
                                    <div class="description-block">
                                        <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> <?= !empty($notes) ? min(100, floor(count($notes) * 2)) : 0 ?>%</span>
                                        <h5 class="description-header"><?= !empty($notes) ? count($notes) : 0 ?></h5>
                                        <span class="description-text">Évaluations</span>
                                    </div>
                                </div>
                                <div class="col-4 text-center">
                                    <div class="description-block">
                                        <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> <?= isset($discipline['PointsRetires']) ? intval($discipline['PointsRetires']) : 0 ?> pts</span>
                                        <h5 class="description-header"><?= isset($discipline['PointsRetires']) ? intval($discipline['PointsRetires']) : 0 ?></h5>
                                        <span class="description-text">Discipline</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Résumé rapide</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Enfant :</strong> <?= htmlspecialchars(trim(($eleve['prenom'] ?? '') . ' ' . ($eleve['nom'] ?? ''))) ?></p>
                            <p><strong>Classe :</strong> <?= htmlspecialchars($eleve['nom_classe'] ?? 'Non définie') ?></p>
                            <p><strong>Parent :</strong> <?= htmlspecialchars($parentName) ?></p>
                            <p><strong>Solde :</strong> <?= number_format($compte['reste_a_payer'] ?? 0,2) ?> $</p>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (!empty($eleves) && count($eleves) > 1): ?>
            <div class="row">
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

<?php include(__DIR__ . '/../../layout/footer.php'); ?>