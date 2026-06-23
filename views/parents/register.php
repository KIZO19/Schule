<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Gestion Scolaire</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-p1CmYCoPokrB35YqjKM8KJ6xTg+vVKp5JEcT0BSG0sP3VK8jPQ4UMYUDi+AHGp/SxRzPaw8x5Zk6fZx0gd6HAw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/custom.css">
</head>
<body class="hold-transition login-page login-page-brand">
<div class="login-box">
    <div class="login-logo text-center">
        <a href="<?= BASE_URL ?>/" class="text-white"><span class="login-brand-title">SMSys</span><br><small class="text-light">Inscription parent</small></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Créer un compte parent</p>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/Auth/register" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Votre nom" value="<?= htmlspecialchars($inputs['name']) ?>">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?= htmlspecialchars($inputs['email']) ?>">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="telephone" class="form-control" placeholder="Téléphone" value="<?= htmlspecialchars($inputs['telephone']) ?>">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-phone"></span></div>
                    </div>
                </div>
                <div class="card card-outline card-secondary mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Informations sur l'enfant</h3>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <input type="text" name="child_nom" class="form-control" placeholder="Nom de l'enfant" value="<?= htmlspecialchars($inputs['child_nom'] ?? '') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-id-card"></span></div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="child_postnom" class="form-control" placeholder="Postnom de l'enfant" value="<?= htmlspecialchars($inputs['child_postnom'] ?? '') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-id-card"></span></div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="child_prenom" class="form-control" placeholder="Prénom de l'enfant" value="<?= htmlspecialchars($inputs['child_prenom'] ?? '') ?>">
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-id-badge"></span></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <select name="child_genre" class="form-control">
                                        <option value="">Genre</option>
                                        <option value="M" <?= (isset($inputs['child_genre']) && $inputs['child_genre'] === 'M') ? 'selected' : '' ?>>M</option>
                                        <option value="F" <?= (isset($inputs['child_genre']) && $inputs['child_genre'] === 'F') ? 'selected' : '' ?>>F</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input type="date" name="child_date_naissance" class="form-control" value="<?= htmlspecialchars($inputs['child_date_naissance'] ?? '') ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password_confirm" class="form-control" placeholder="Confirmer le mot de passe">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-center mb-3">
                        <small class="text-muted">Entrez les informations ci-dessus pour créer un compte parent sécurisé.</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <a href="<?= BASE_URL ?>/" class="text-primary font-weight-bold">J'ai déjà un compte</a>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJ+Y3DmFzMSKDTqzISQBej6G8q4U+7kw+v9EE=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2LcRccM80ILdY4g/s2kW7B1NqI0Ffjjk+N5I9IJyH2" crossorigin="anonymous"></script>
<script src="<?= BASE_URL ?>/public/assets/js/adminlte.min.js"></script>
</body>
</html>
