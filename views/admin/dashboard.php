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
                <div class="col-md-6">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fas fa-user-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Demandes d'enfants</span>
                            <span class="info-box-number">Consulter</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">Validez ou rejetez les nouvelles demandes d'inscription.</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Rappels</h3>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li>Les comptes parents sont actifs une fois qu'un enfant est approuvé.</li>
                                <li>Une demande rejetée peut être renvoyée via le formulaire parent.</li>
                                <li>Utilisez le tableau des demandes pour voir tous les détails.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>
