<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion École - Gestion Scolaire</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/custom.css">
</head>
<body class="hold-transition login-page login-page-brand">
<div class="login-box">
    <div class="card login-card shadow-lg border-0 rounded-lg overflow-hidden">
        <div class="login-card-header text-center text-white py-5" style="background: linear-gradient(135deg, #1e3a8a 0%, #4338ca 100%);">
            <div class="mb-3">
                <i class="fas fa-school fa-2x"></i>
            </div>
            <h1 class="mb-1">Connexion École</h1>
            <p class="mb-0">Gestion de l’établissement</p>
        </div>
        <div class="card-body login-card-body px-5 py-4">
            <p class="login-box-msg mb-4">Entrez vos identifiants d'établissement</p>
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger rounded-lg py-3"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form action="<?= BASE_URL ?>/Ecole/login" method="post">
                <div class="form-group mb-3">
                    <label for="email" class="font-weight-bold">Email officiel</label>
                    <div class="input-group input-group-lg shadow-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-envelope text-secondary"></i></span>
                        </div>
                        <input id="email" type="email" name="email" class="form-control border-left-0 rounded-right-lg" placeholder="Email officiel" value="<?= htmlspecialchars($email) ?>" required>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="password" class="font-weight-bold">Mot de passe</label>
                    <div class="input-group input-group-lg shadow-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-lock text-secondary"></i></span>
                        </div>
                        <input id="password" type="password" name="password" class="form-control border-left-0 rounded-right-lg" placeholder="Mot de passe" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-gradient btn-lg btn-block mb-3">Se connecter</button>
            </form>
            <div class="text-center mt-3">
                <p class="mb-0">Pas encore d'établissement ? <a href="<?= BASE_URL ?>/Ecole/register">Créer un compte école</a></p>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= BASE_URL ?>/public/assets/js/adminlte.min.js"></script>
</body>
</html>
