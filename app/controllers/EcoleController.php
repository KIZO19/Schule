<?php
// app/controllers/EcoleController.php

class EcoleController extends Controller {
    private $ecoleModel;

    public function __construct() {
        $this->ecoleModel = $this->loadModel('EcoleModel');
    }

    public function login() {
        if (!empty($_SESSION['ecole_id'])) {
            $this->redirect('/school/Ecole/dashboard');
        }

        $error = '';
        $email = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = 'Veuillez saisir votre email et votre mot de passe.';
            } else {
                $ecole = $this->ecoleModel->findByEmail($email);
                if (!$ecole || !isset($ecole['mot_de_passe']) || !password_verify($password, $ecole['mot_de_passe'])) {
                    $error = 'Email ou mot de passe incorrect.';
                } elseif ($ecole['statut_systeme'] !== 'Actif') {
                    $error = 'Votre établissement n’est pas encore actif.';
                } else {
                    $_SESSION['ecole_id'] = $ecole['id'];
                    $_SESSION['ecole_name'] = $ecole['nom_etablissement'];
                    $_SESSION['ecole_email'] = $ecole['email_officiel'];
                    $this->redirect('/school/Ecole/dashboard');
                }
            }
        }

        $this->renderView('ecole/login', [
            'error' => $error,
            'email' => $email,
        ]);
    }

    public function dashboard() {
        if (empty($_SESSION['ecole_id'])) {
            $this->redirect('/school/Ecole/login');
        }

        $this->renderView('ecole/dashboard', [
            'titrePage' => 'Tableau de bord École'
        ]);
    }

    public function logout() {
        session_unset();
        session_destroy();
        $this->redirect('/school/Ecole/login');
    }
}
