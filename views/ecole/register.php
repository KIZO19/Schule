<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription École - Gestion Scolaire</title>
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
                            <i class="fas fa-school fa-2x"></i>
                        </div>
                        <h1 class="mb-1">Inscription établissement</h1>
                        <p class="mb-0">Créez l’espace de gestion pour votre école</p>
                    </div>
                    <div class="card-body login-card-body px-4 py-4">
            <p class="login-box-msg mb-4">Remplissez le formulaire pour enregistrer votre établissement</p>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger rounded-lg py-3"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/Ecole/register" method="post">
                <div class="form-group mb-3">
                    <label for="nom_etablissement" class="font-weight-bold">Nom de l'établissement</label>
                    <div class="input-group input-group-lg shadow-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-white border-right-0"><i class="fas fa-school text-secondary"></i></span>
                        </div>
                        <input id="nom_etablissement" type="text" name="nom_etablissement" class="form-control border-left-0 rounded-right-lg" placeholder="Nom de l'établissement" value="<?= htmlspecialchars($inputs['nom_etablissement']) ?>" required>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="adresse" class="font-weight-bold">Adresse</label>
                    <textarea id="adresse" name="adresse" rows="3" class="form-control shadow-sm" placeholder="Adresse de l'établissement"><?= htmlspecialchars($inputs['adresse']) ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="telephone_contact" class="font-weight-bold">Téléphone</label>
                        <div class="input-group input-group-lg shadow-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0"><i class="fas fa-phone text-secondary"></i></span>
                            </div>
                            <input id="telephone_contact" type="text" name="telephone_contact" class="form-control border-left-0 rounded-right-lg" placeholder="Téléphone" value="<?= htmlspecialchars($inputs['telephone_contact']) ?>" required>
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="email_officiel" class="font-weight-bold">Email officiel</label>
                        <div class="input-group input-group-lg shadow-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white border-right-0"><i class="fas fa-envelope text-secondary"></i></span>
                            </div>
                            <input id="email_officiel" type="email" name="email_officiel" class="form-control border-left-0 rounded-right-lg" placeholder="Email officiel" value="<?= htmlspecialchars($inputs['email_officiel']) ?>" required>
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
                                <span class="input-group-text bg-white border-right-0"><i class="fas fa-check-double text-secondary"></i></span>
                            </div>
                            <input id="password_confirm" type="password" name="password_confirm" class="form-control border-left-0 rounded-right-lg" placeholder="Confirmez le mot de passe" required>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="code_ecole" class="font-weight-bold">Code établissement</label>
                        <input id="code_ecole" type="text" name="code_ecole" class="form-control shadow-sm" placeholder="Code établissement" value="<?= htmlspecialchars($inputs['code_ecole']) ?>">
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="province_education" class="font-weight-bold">Province / région</label>
                        <input id="province_education" type="text" name="province_education" class="form-control shadow-sm" placeholder="Province ou région" value="<?= htmlspecialchars($inputs['province_education']) ?>">
                    </div>
                </div>

                <div class="form-group mb-4">
                    <label for="devise_principale" class="font-weight-bold">Devise principale</label>
                    <input id="devise_principale" type="text" name="devise_principale" class="form-control shadow-sm" placeholder="Devise principale" value="<?= htmlspecialchars($inputs['devise_principale']) ?>">
                </div>

                <button type="submit" class="btn btn-primary btn-lg btn-block">Créer l'établissement</button>
            </form>

            <div class="mt-4 text-center">
                <p class="mb-1 text-muted">Vous avez déjà un compte ?</p>
                <a href="<?= BASE_URL ?>/Ecole/login" class="font-weight-bold text-primary">Retour à la connexion</a>
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