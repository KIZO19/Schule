<?php include(__DIR__ . '/../layout/header.php'); ?>
<?php include(__DIR__ . '/../layout/sidebar.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tableau de bord</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?= BASE_URL ?>/Admin/childRequests" class="btn btn-primary">Voir les demandes d'enfants</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fas fa-user-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Demandes en attente</span>
                            <span class="info-box-number"><?= htmlspecialchars($metrics['pendingRequests'] ?? 0) ?></span>
                            <div class="progress">
                                <div class="progress-bar" style="width: <?= min(100, ($metrics['pendingRequests'] ?? 0) * 10) ?>%"></div>
                            </div>
                            <span class="progress-description">Traitez rapidement les nouvelles demandes.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="fas fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Parents enregistrés</span>
                            <span class="info-box-number"><?= htmlspecialchars($metrics['parentsCount'] ?? 0) ?></span>
                            <span class="progress-description">Total des familles actives.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="fas fa-school"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Élèves actifs</span>
                            <span class="info-box-number"><?= htmlspecialchars($metrics['studentsCount'] ?? 0) ?></span>
                            <span class="progress-description">Élèves inscrits dans l'établissement.</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="info-box bg-secondary">
                        <span class="info-box-icon"><i class="fas fa-user-tie"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Personnel</span>
                            <span class="info-box-number"><?= htmlspecialchars($metrics['agentsCount'] ?? 0) ?></span>
                            <span class="progress-description">Agents et enseignants actifs.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Dernières demandes en attente</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Parent</th>
                                        <th>Email</th>
                                        <th>Nom de l'enfant</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($recentRequests)): ?>
                                        <?php foreach ($recentRequests as $request): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($request['id']) ?></td>
                                                <td><?= htmlspecialchars($request['nom_responsable']) ?></td>
                                                <td><?= htmlspecialchars($request['email']) ?></td>
                                                <td><?= htmlspecialchars($request['nom'] . ' ' . $request['postnom'] . ' ' . $request['prenom']) ?></td>
                                                <td><?= htmlspecialchars($request['created_at']) ?></td>
                                                <td>
                                                    <a href="<?= BASE_URL ?>/Admin/approveRequest/<?= $request['id'] ?>" class="btn btn-success btn-sm">Valider</a>
                                                    <a href="<?= BASE_URL ?>/Admin/rejectRequest/<?= $request['id'] ?>" class="btn btn-danger btn-sm">Rejeter</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Aucune demande en attente.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Actions rapides</h3>
                        </div>
                        <div class="card-body">
                            <p class="mb-2">Utilisez ces liens pour gérer immédiatement les demandes et la configuration :</p>
                            <a href="<?= BASE_URL ?>/Admin/childRequests" class="btn btn-primary btn-block mb-2">Voir toutes les demandes</a>
                            <a href="<?= BASE_URL ?>/Ecole/dashboard" class="btn btn-outline-secondary btn-block">Accéder au dashboard école</a>
                            <a href="<?= BASE_URL ?>/Auth/login" class="btn btn-outline-info btn-block">Retour à la connexion parent</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>
