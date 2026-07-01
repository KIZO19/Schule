<?php include(__DIR__ . '/../../layout/header.php'); ?>
<?php include(__DIR__ . '/../../layout/sidebar.php'); ?>

<main class="app-main">
    <div class="app-content">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= BASE_URL ?>">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>
                                <p>Nouvelles commandes</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>
                                <p>Taux de rebond</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>
                                <p>Inscriptions utilisateurs</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>
                                <p>Visiteurs uniques</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                            <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-7">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Valeur des ventes</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="salesChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Carte du monde</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-center align-items-center" style="height: 250px; background: linear-gradient(135deg, #3c8dbc 0%, #00c0ef 100%); border-radius: .25rem;">
                                    <span class="text-white font-weight-bold">Carte du monde</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-4 col-4">
                                        <div class="description-block border-right">
                                            <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                                            <h5 class="description-header">8390</h5>
                                            <span class="description-text">VISITES</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-4">
                                        <div class="description-block border-right">
                                            <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                                            <h5 class="description-header">30%</h5>
                                            <span class="description-text">EN LIGNE</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-4">
                                        <div class="description-block">
                                            <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                                            <h5 class="description-header">70</h5>
                                            <span class="description-text">VENTES</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Statistiques des élèves</h3>
                            </div>
                            <div class="card-body">
                                <div class="progress-group">
                                    <span class="progress-text">Présence</span>
                                    <span class="float-right"><b>80%</b></span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-primary" style="width: 80%"></div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <span class="progress-text">Paiements reçus</span>
                                    <span class="float-right"><b>60%</b></span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" style="width: 60%"></div>
                                    </div>
                                </div>
                                <div class="progress-group">
                                    <span class="progress-text">Évaluations complétées</span>
                                    <span class="float-right"><b>45%</b></span>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger" style="width: 45%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Analyse rapide</h3>
                            </div>
                            <div class="card-body">
                                <div class="info-box mb-3 bg-warning">
                                    <span class="info-box-icon"><i class="fas fa-users"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Parents actifs</span>
                                        <span class="info-box-number">120</span>
                                    </div>
                                </div>
                                <div class="info-box mb-3 bg-success">
                                    <span class="info-box-icon"><i class="fas fa-book"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Élèves suivi</span>
                                        <span class="info-box-number">95</span>
                                    </div>
                                </div>
                                <div class="info-box bg-info">
                                    <span class="info-box-icon"><i class="fas fa-calendar-alt"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Événements</span>
                                        <span class="info-box-number">14</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

<?php include(__DIR__ . '/../layout/footer.php'); ?>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Marché numérique',
                backgroundColor: 'rgba(60,141,188,0.2)',
                borderColor: 'rgba(60,141,188,1)',
                pointRadius: 3,
                pointBackgroundColor: 'rgba(60,141,188,1)',
                pointBorderColor: '#3b8bba',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(60,141,188,1)',
                fill: true,
                data: [28, 48, 40, 60, 70, 80]
            }, {
                label: 'Électronique',
                backgroundColor: 'rgba(210, 214, 222, 0.2)',
                borderColor: 'rgba(210, 214, 222, 1)',
                pointRadius: 3,
                pointBackgroundColor: 'rgba(210, 214, 222, 1)',
                pointBorderColor: '#c1c7d1',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(220,220,220,1)',
                fill: true,
                data: [65, 59, 80, 81, 56, 55]
            }]
        },
        options: {
            maintainAspectRatio: false,
            responsive: true,
            plugins: {
                legend: { display: true }
            },
            scales: {
                x: { grid: { display: false } },
                y: { grid: { color: 'rgba(0,0,0,0.05)' } }
            }
        }
    });
</script>
