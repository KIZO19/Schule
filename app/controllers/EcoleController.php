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

    public function register() {
        if (!empty($_SESSION['ecole_id'])) {
            $this->redirect('/school/Ecole/dashboard');
        }

        $error = '';
        $inputs = [
            'nom_etablissement' => '',
            'adresse' => '',
            'telephone_contact' => '',
            'email_officiel' => '',
            'code_ecole' => '',
            'province_education' => '',
            'devise_principale' => 'USD',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inputs['nom_etablissement'] = trim($_POST['nom_etablissement'] ?? '');
            $inputs['adresse'] = trim($_POST['adresse'] ?? '');
            $inputs['telephone_contact'] = trim($_POST['telephone_contact'] ?? '');
            $inputs['email_officiel'] = trim($_POST['email_officiel'] ?? '');
            $inputs['code_ecole'] = trim($_POST['code_ecole'] ?? '');
            $inputs['province_education'] = trim($_POST['province_education'] ?? '');
            $inputs['devise_principale'] = trim($_POST['devise_principale'] ?? 'USD');
            $password = $_POST['password'] ?? '';
            $passwordConfirm = $_POST['password_confirm'] ?? '';

            if (empty($inputs['nom_etablissement']) || empty($inputs['telephone_contact']) || empty($inputs['email_officiel']) || empty($password) || empty($passwordConfirm)) {
                $error = 'Les champs nom, téléphone, email et mot de passe sont obligatoires.';
            } elseif (!filter_var($inputs['email_officiel'], FILTER_VALIDATE_EMAIL)) {
                $error = 'Entrez une adresse email officielle valide.';
            } elseif ($password !== $passwordConfirm) {
                $error = 'Les mots de passe ne correspondent pas.';
            } elseif ($this->ecoleModel->findByEmail($inputs['email_officiel'])) {
                $error = 'Un établissement existe déjà avec cet email.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $inserted = $this->ecoleModel->create([
                    'nom_etablissement' => $inputs['nom_etablissement'],
                    'adresse' => $inputs['adresse'],
                    'telephone_contact' => $inputs['telephone_contact'],
                    'email_officiel' => $inputs['email_officiel'],
                    'mot_de_passe' => $hash,
                    'statut_systeme' => 'Actif',
                    'code_ecole' => $inputs['code_ecole'],
                    'province_education' => $inputs['province_education'],
                    'devise_principale' => $inputs['devise_principale'],
                ]);

                if ($inserted) {
                    $_SESSION['success_message'] = 'École créée. Vous pouvez maintenant vous connecter.';
                    $this->redirect('/school/Ecole/login');
                } else {
                    $error = 'Impossible de créer l’établissement. Réessayez plus tard.';
                }
            }
        }

        $this->renderView('ecole/register', [
            'error' => $error,
            'inputs' => $inputs,
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
