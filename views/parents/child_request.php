<?php include(__DIR__ . '/../layout/header.php'); ?>
<?php include(__DIR__ . '/../layout/sidebar.php'); ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Demande d'inscription de l'enfant</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Identité de l'enfant</h3>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($error)): ?>
                                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>
                            <?php if (!empty($success)): ?>
                                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
                            <?php endif; ?>

                            <form action="<?= BASE_URL ?>/ChildRequest/request" method="post">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Nom</label>
                                        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($inputs['nom']) ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Postnom</label>
                                        <input type="text" name="postnom" class="form-control" value="<?= htmlspecialchars($inputs['postnom']) ?>" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Prénom</label>
                                        <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($inputs['prenom']) ?>" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Genre</label>
                                        <select name="genre" class="form-control" required>
                                            <option value="">Choisir...</option>
                                            <option value="M" <?= $inputs['genre'] === 'M' ? 'selected' : '' ?>>M</option>
                                            <option value="F" <?= $inputs['genre'] === 'F' ? 'selected' : '' ?>>F</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Date de naissance</label>
                                        <input type="date" name="date_naissance" class="form-control" value="<?= htmlspecialchars($inputs['date_naissance']) ?>" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Soumettre la demande</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include(__DIR__ . '/../layout/footer.php'); ?>
