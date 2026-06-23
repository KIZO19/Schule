<?php include(__DIR__ . '/../layout/header.php'); ?>
<?php include(__DIR__ . '/../layout/sidebar.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Demandes d'inscription des enfants</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Demandes en attente</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Parent</th>
                                <th>Email</th>
                                <th>Nom de l'enfant</th>
                                <th>Genre</th>
                                <th>Date de naissance</th>
                                <th>Soumise le</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($requests)): ?>
                                <?php foreach ($requests as $request): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($request['id']) ?></td>
                                        <td><?= htmlspecialchars($request['nom_responsable']) ?></td>
                                        <td><?= htmlspecialchars($request['email']) ?></td>
                                        <td><?= htmlspecialchars($request['nom'] . ' ' . $request['postnom'] . ' ' . $request['prenom']) ?></td>
                                        <td><?= htmlspecialchars($request['genre']) ?></td>
                                        <td><?= htmlspecialchars($request['date_naissance']) ?></td>
                                        <td><?= htmlspecialchars($request['created_at']) ?></td>
                                        <td>
                                            <a href="<?= BASE_URL ?>/Admin/approveRequest/<?= $request['id'] ?>" class="btn btn-success btn-sm">Valider</a>
                                            <a href="<?= BASE_URL ?>/Admin/rejectRequest/<?= $request['id'] ?>" class="btn btn-danger btn-sm">Rejeter</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">Aucune demande en attente.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>