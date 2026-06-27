<?php
// app/controllers/ChildRequestController.php

class ChildRequestController extends Controller {
    private $parentModel;
    private $childRequestModel;

    public function __construct() {
        $this->parentModel = $this->loadModel('ParentModel');
        $this->childRequestModel = $this->loadModel('ChildRequestModel');
    }

    public function request() {
        if (empty($_SESSION['parent_id'])) {
            $this->redirect('/school/');
        }

        $error = '';
        $success = '';
        $inputs = [
            'nom' => '',
            'postnom' => '',
            'prenom' => '',
            'genre' => '',
            'date_naissance' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inputs = [
                'nom' => trim($_POST['nom'] ?? ''),
                'postnom' => trim($_POST['postnom'] ?? ''),
                'prenom' => trim($_POST['prenom'] ?? ''),
                'genre' => trim($_POST['genre'] ?? ''),
                'date_naissance' => trim($_POST['date_naissance'] ?? '')
            ];

            if (empty($inputs['nom']) || empty($inputs['postnom']) || empty($inputs['prenom']) || empty($inputs['genre']) || empty($inputs['date_naissance'])) {
                $error = 'Veuillez remplir toutes les informations de l\'enfant.';
            } else {
                $this->childRequestModel->createRequest([
                    'parent_id' => $_SESSION['parent_id'],
                    'nom' => $inputs['nom'],
                    'postnom' => $inputs['postnom'],
                    'prenom' => $inputs['prenom'],
                    'genre' => $inputs['genre'],
                    'date_naissance' => $inputs['date_naissance'],
                ]);
                $success = 'Demande soumise. L\'administration va l\'examiner.';
            }
        }

        $this->renderView('ecole/parents/child_request', [
            'error' => $error,
            'success' => $success,
            'inputs' => $inputs
        ]);
    }
}
