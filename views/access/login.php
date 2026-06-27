<?php
// views/access/login.php
?><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion Scolaire</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/custom.css">
</head>
<body class="hold-transition login-page login-page-brand">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10">
            <div class="login-box mx-auto">
                <div class="card login-card shadow-lg border-0 rounded-lg overflow-hidden">
                    <div class="login-card-header text-center text-white py-5" style="background: linear-gradient(135deg, #1e3a8a 0%, #4338ca 100%);">
                        <div class="mb-3">
                            <i class="fas fa-universal-access fa-2x"></i>
                        </div>
                        <h1 class="mb-1">Connexion</h1>
                        <p class="mb-0">Connectez-vous avec votre email ou téléphone</p>
                        <?php if (!empty($schoolName)): ?>
                            <p class="mb-0 mt-2 font-weight-bold text-light"><?= htmlspecialchars($schoolName) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="card-body login-card-body px-4 py-4">
                        <p class="login-box-msg mb-4">Choisissez votre identifiant et connectez-vous</p>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger rounded-lg py-3"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>

                        <form action="<?= BASE_URL ?>/Access/login" method="post">
                            <div class="form-group mb-3">
                                <label for="identifier" class="font-weight-bold">Email ou Téléphone</label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-user text-secondary"></i></span>
                                    </div>
                                    <input id="identifier" type="text" name="identifier" class="form-control border-left-0 rounded-right-lg" placeholder="Email ou Téléphone" value="<?= htmlspecialchars($identifier ?? '') ?>" required>
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
                            <a href="<?= BASE_URL ?>/Auth/login" class="text-secondary">Connexion parent (ancienne)</a> ·
                            <a href="<?= BASE_URL ?>/Agent/login" class="text-secondary">Connexion personnel (ancienne)</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="<?= BASE_URL ?>/public/assets/js/adminlte.min.js"></script>
</body>
</html>
