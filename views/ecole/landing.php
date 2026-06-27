<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue - Gestion Scolaire</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/custom.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-xl overflow-hidden">
                <div class="row no-gutters">
                    <div class="col-md-7 p-5" style="background: linear-gradient(135deg, #1e3a8a 0%, #4338ca 100%); color: white;">
                        <h1 class="display-4 font-weight-bold mb-3">Bienvenue dans votre espace scolaire</h1>
                        <p class="lead mb-4">Gérez les inscriptions, le suivi des élèves, les paiements et l’organisation pédagogique depuis une seule plateforme.</p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge badge-light text-primary px-3 py-2"><i class="fas fa-user-graduate mr-2"></i> Suivi élève</span>
                            <span class="badge badge-light text-primary px-3 py-2"><i class="fas fa-money-bill-wave mr-2"></i> Paiements</span>
                            <span class="badge badge-light text-primary px-3 py-2"><i class="fas fa-calendar-alt mr-2"></i> Planification</span>
                        </div>
                    </div>
                    <div class="col-md-5 p-5 bg-white">
                        <h3 class="mb-4 text-dark">Choisissez votre accès</h3>
                        <a href="<?= BASE_URL ?>/Ecole/login" class="btn btn-primary btn-lg btn-block mb-3">
                            <i class="fas fa-school mr-2"></i> Se connecter comme école
                        </a>
                        <a href="<?= BASE_URL ?>/Ecole/register" class="btn btn-outline-primary btn-lg btn-block mb-3">
                            <i class="fas fa-user-plus mr-2"></i> Créer un compte école
                        </a>
                        <a href="<?= BASE_URL ?>/Auth/login" class="btn btn-success btn-lg btn-block">
                            <i class="fas fa-users mr-2"></i> Espace parent
                        </a>
                        <hr class="my-4">
                        <p class="text-muted mb-0">Accédez rapidement à la gestion scolaire et au parcours parent selon votre profil.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
