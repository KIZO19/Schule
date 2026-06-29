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
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard Parent</h3>
                    <p class="text-muted">Tableau de bord pédagogique et financier pour <?= htmlspecialchars(trim(($eleve['prenom'] ?? '') . ' ' . ($eleve['nom'] ?? '')) ?: 'votre enfant') ?>.</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-info">
                        <div class="inner">
                            <h3><?= number_format($compte['reste_a_payer'] ?? 0, 2) ?> $</h3>
                            <p>Reste à payer</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M2 7.5A2.5 2.5 0 014.5 5h15a2.5 2.5 0 012.5 2.5v9a2.5 2.5 0 01-2.5 2.5h-15A2.5 2.5 0 012 16.5v-9z"></path></svg>
                        <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">Voir le détail <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3><?= isset($discipline['PointsRetires']) ? ('-'.intval($discipline['PointsRetires'])) : '0' ?></h3>
                            <p>Points disciplinaires</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M9 21h6v-2H9v2zm3-20C6.48 1 2 5.48 2 11s4.48 10 10 10 10-4.48 10-10S17.52 1 12 1zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"></path></svg>
                        <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">Voir le détail <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3><?= number_format($taux_presence ?? 0, 1) ?>%</h3>
                            <p>Taux de présence</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm1 15h-2v-2h2zm0-4h-2V7h2z"></path></svg>
                        <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">Voir le détail <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3><?= !empty($notes) ? count($notes) : 0 ?></h3>
                            <p>Dernières évaluations</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zm14 4H5v10h14zm-2 2h-3v6h3zm-5 0H9v6h3z"></path></svg>
                        <a href="#" class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover">Voir le détail <i class="bi bi-arrow-right"></i></a>
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
    </div>
</main>

<?php include(__DIR__ . '/../../layout/footer.php'); ?>