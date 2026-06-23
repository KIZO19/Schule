<?php include(__DIR__ . '/../layout/header.php'); ?>
<?php include(__DIR__ . '/../layout/sidebar.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tableau de bord École</h1>
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
                            <h3 class="card-title">Bienvenue, <?= htmlspecialchars($_SESSION['ecole_name'] ?? 'Établissement') ?></h3>
                        </div>
                        <div class="card-body">
                            <p>Vous êtes connecté en tant qu'établissement. Gérez vos parents et vos demandes d'inscription depuis le menu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>