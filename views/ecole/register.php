<?php include(__DIR__ . '/../layout/header.php'); ?>
<?php include(__DIR__ . '/../layout/sidebar.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Créer un établissement</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Inscription école</h3>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($error)): ?>
                                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>

                            <form action="<?= BASE_URL ?>/Ecole/register" method="post">
                                <div class="form-group">
                                    <label>Nom de l'établissement</label>
                                    <input type="text" name="nom_etablissement" class="form-control" value="<?= htmlspecialchars($inputs['nom_etablissement']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Adresse</label>
                                    <textarea name="adresse" class="form-control"><?= htmlspecialchars($inputs['adresse']) ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input type="text" name="telephone_contact" class="form-control" value="<?= htmlspecialchars($inputs['telephone_contact']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Email officiel</label>
                                    <input type="email" name="email_officiel" class="form-control" value="<?= htmlspecialchars($inputs['email_officiel']) ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Confirmer le mot de passe</label>
                                    <input type="password" name="password_confirm" class="form-control" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Code établissement</label>
                                        <input type="text" name="code_ecole" class="form-control" value="<?= htmlspecialchars($inputs['code_ecole']) ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Province / région</label>
                                        <input type="text" name="province_education" class="form-control" value="<?= htmlspecialchars($inputs['province_education']) ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Devise principale</label>
                                    <input type="text" name="devise_principale" class="form-control" value="<?= htmlspecialchars($inputs['devise_principale']) ?>">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Créer l'établissement</button>
                            </form>
                            <div class="mt-3 text-center">
                                <a href="<?= BASE_URL ?>/Ecole/login">Retour à la connexion</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>