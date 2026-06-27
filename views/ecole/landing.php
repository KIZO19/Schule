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
                        <h3 class="mb-4 text-dark">Choisissez votre établissement</h3>
                        <div class="mb-4">
                            <div class="input-group input-group-lg shadow-sm">
                                <input id="schoolSearch" type="search" class="form-control" placeholder="Rechercher une école" value="<?= htmlspecialchars($search ?? '') ?>" autocomplete="off">
                                <div class="input-group-append">
                                    <button id="searchButton" class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive mb-4" id="schoolsWrapper" style="display: <?= $search !== '' ? 'block' : 'none'; ?>;">
                            <table class="table table-hover table-borderless" id="schoolsTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Établissement</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="schoolsBody">
                                    <?php if (!empty($schools)): ?>
                                        <?php foreach ($schools as $school): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($school['nom_etablissement']) ?></td>
                                                <td class="text-right">
                                                    <a href="<?= BASE_URL ?>/Ecole/select/<?= $school['id'] ?>?role=parent" class="btn btn-sm btn-outline-primary mr-2">Parent</a>
                                                    <a href="<?= BASE_URL ?>/Ecole/select/<?= $school['id'] ?>?role=agent" class="btn btn-sm btn-outline-secondary">Personnel</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div id="searchFeedback" class="mb-3">
                            <?php if ($search === ''): ?>
                                <div class="alert alert-info" role="alert">
                                    Commencez par saisir le nom d'une école pour lancer la recherche.
                                </div>
                            <?php elseif (empty($schools)): ?>
                                <div class="alert alert-warning" role="alert">
                                    L'école que vous recherchez n'est pas encore en partenariat avec notre système, ou son inscription n'est pas encore finalisée.
                                </div>
                            <?php endif; ?>
                        </div>
                        <a href="<?= BASE_URL ?>/Ecole/login" class="btn btn-primary btn-lg btn-block mb-3">
                            <i class="fas fa-school mr-2"></i> Connexion établissement
                        </a>
                        <div class="alert alert-info" role="alert">
                            Après avoir choisi une école dans la liste, vous pourrez vous connecter en tant que parent ou personnel.
                        </div>
                        <hr class="my-4">
                        <p class="text-muted mb-0">Sélectionnez d’abord votre établissement, puis choisissez le type de connexion.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    const searchInput = document.getElementById('schoolSearch');
    const searchButton = document.getElementById('searchButton');
    const schoolsBody = document.getElementById('schoolsBody');
    const searchFeedback = document.getElementById('searchFeedback');

    let searchTimer;

    function renderSchools(schools, query) {
        schoolsBody.innerHTML = '';
        const wrapper = document.getElementById('schoolsWrapper');
        wrapper.style.display = 'block';

        if (!schools || schools.length === 0) {
            searchFeedback.innerHTML = `
                <div class="alert alert-warning" role="alert">
                    ${query ? 'L\'école que vous recherchez n\'est pas encore en partenariat avec notre système, ou son inscription n\'est pas encore finalisée.' : 'Aucune école active n\'est disponible pour le moment.'}
                </div>
            `;
            return;
        }

        searchFeedback.innerHTML = '';

        schools.forEach(school => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${escapeHtml(school.nom_etablissement)}</td>
                <td><a href="<?= BASE_URL ?>/Ecole/select/${school.id}" class="btn btn-sm btn-outline-primary">Choisir</a></td>
            `;
            schoolsBody.appendChild(row);
        });
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return String(text).replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    function fetchSchools(query) {
        const url = new URL('<?= BASE_URL ?>/Ecole/search', window.location.origin);
        url.searchParams.set('q', query);

        fetch(url, { method: 'GET' })
            .then(response => response.json())
            .then(data => renderSchools(data, query))
            .catch(() => {
                searchFeedback.innerHTML = '<div class="alert alert-danger" role="alert">Impossible de charger les écoles pour le moment.</div>';
            });
    }

    function handleSearch() {
        const query = searchInput.value.trim();
        clearTimeout(searchTimer);
        searchTimer = setTimeout(() => fetchSchools(query), 250);
    }

    searchInput.addEventListener('input', handleSearch);
    searchButton.addEventListener('click', () => fetchSchools(searchInput.value.trim()));
</script>
</body>
</html>
