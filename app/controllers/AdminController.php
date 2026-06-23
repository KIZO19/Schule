<?php
// app/controllers/AdminController.php

class AdminController extends Controller {
    
    public function dashboard() {
        // 1. (Optionnel) Aller chercher des données via le modèle
        // $eleveModel = $this->loadModel('Eleve');
        // $total = $eleveModel->countAll();

        // 2. Transmettre les données à la vue correspondante
        $this->renderView('admin/dashboard', [
            'titrePage' => 'Tableau de Bord Secrétariat'
        ]);
    }
}