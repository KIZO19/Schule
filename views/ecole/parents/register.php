<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Parent - Gestion Scolaire</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
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
                            <i class="fas fa-user-friends fa-2x"></i>
                        </div>
                        <h1 class="mb-1">Inscription Parent</h1>
                        <p class="mb-0">Créer un compte parent</p>
                        <?php if (!empty($schoolName)): ?>
                            <p class="mb-0 mt-2 font-weight-bold text-light"><?= htmlspecialchars($schoolName) ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="card-body login-card-body px-4 py-4">
                        <p class="login-box-msg mb-4">Remplissez le formulaire pour créer votre compte</p>

                        <?php if (!empty($error)): ?>
                            <div class="alert alert-danger rounded-lg py-3"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>

                        <form action="<?= BASE_URL ?>/Auth/register" method="post">
                            <div class="form-group mb-3">
                                <label for="name" class="font-weight-bold">Nom</label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-user text-secondary"></i></span>
                                    </div>
                                    <input id="name" type="text" name="name" class="form-control border-left-0 rounded-right-lg" placeholder="Votre nom" value="<?= htmlspecialchars($inputs['name'] ?? '') ?>" required>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="font-weight-bold">Email</label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-envelope text-secondary"></i></span>
                                    </div>
                                    <input id="email" type="email" name="email" class="form-control border-left-0 rounded-right-lg" placeholder="Email" value="<?= htmlspecialchars($inputs['email'] ?? '') ?>" required>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="telephone" class="font-weight-bold">Téléphone</label>
                                <div class="input-group input-group-lg shadow-sm">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0"><i class="fas fa-phone text-secondary"></i></span>
                                    </div>
                                    <input id="telephone" type="text" name="telephone" class="form-control border-left-0 rounded-right-lg" placeholder="Téléphone" value="<?= htmlspecialchars($inputs['telephone'] ?? '') ?>" required>
                                </div>
                            </div>

                            <div class="card card-outline card-secondary mb-3">
                                <div class="card-header">
                                    <h3 class="card-title">Informations sur l'enfant</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-4 mb-3">
                                            <label for="child_nom" class="font-weight-bold">Nom</label>
                                            <input id="child_nom" type="text" name="child_nom" class="form-control" placeholder="Nom" value="<?= htmlspecialchars($inputs['child_nom'] ?? '') ?>" required>
                                        </div>
                                        <div class="form-group col-md-4 mb-3">
                                            <label for="child_postnom" class="font-weight-bold">Postnom</label>
                                            <input id="child_postnom" type="text" name="child_postnom" class="form-control" placeholder="Postnom" value="<?= htmlspecialchars($inputs['child_postnom'] ?? '') ?>" required>
                                        </div>
                                        <div class="form-group col-md-4 mb-3">
                                            <label for="child_prenom" class="font-weight-bold">Prénom</label>
                                            <input id="child_prenom" type="text" name="child_prenom" class="form-control" placeholder="Prénom" value="<?= htmlspecialchars($inputs['child_prenom'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="child_genre" class="font-weight-bold">Genre</label>
                                            <select id="child_genre" name="child_genre" class="form-control" required>
                                                <option value="">Sélectionner</option>
                                                <option value="M" <?= (isset($inputs['child_genre']) && $inputs['child_genre'] === 'M') ? 'selected' : '' ?>>M</option>
                                                <option value="F" <?= (isset($inputs['child_genre']) && $inputs['child_genre'] === 'F') ? 'selected' : '' ?>>F</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <label for="child_date_naissance" class="font-weight-bold">Date de naissance</label>
                                            <input id="child_date_naissance" type="date" name="child_date_naissance" class="form-control" value="<?= htmlspecialchars($inputs['child_date_naissance'] ?? '') ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="password" class="font-weight-bold">Mot de passe</label>
                                    <div class="input-group input-group-lg shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-lock text-secondary"></i></span>
                                        </div>
                                        <input id="password" type="password" name="password" class="form-control border-left-0 rounded-right-lg" placeholder="Mot de passe" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="password_confirm" class="font-weight-bold">Confirmer le mot de passe</label>
                                    <div class="input-group input-group-lg shadow-sm">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-lock text-secondary"></i></span>
                                        </div>
                                        <input id="password_confirm" type="password" name="password_confirm" class="form-control border-left-0 rounded-right-lg" placeholder="Confirmer le mot de passe" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-gradient btn-lg btn-block mb-3">S'inscrire</button>
                        </form>

                        <div class="text-center mt-3">
                            <p class="mb-1">Déjà inscrit ? <a href="<?= BASE_URL ?>/Auth/login">Se connecter</a></p>
                            <a href="<?= BASE_URL ?>/" class="text-secondary">Changer d'établissement</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= BASE_URL ?>/public/assets/js/adminlte.min.js"></script>
</body>
</html>
