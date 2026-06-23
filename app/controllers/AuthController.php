<?php
// app/controllers/AuthController.php

class AuthController extends Controller {
    private $parentModel;
    private $childRequestModel;

    public function __construct() {
        $this->parentModel = $this->loadModel('ParentModel');
        $this->childRequestModel = $this->loadModel('ChildRequestModel');
    }

    public function login() {
        if (empty($_SESSION['ecole_id'])) {
            $this->redirect('/school/Ecole/login');
        }

        if (!empty($_SESSION['parent_id'])) {
            $this->redirect('/school/Parent/dashboard');
        }

        $error = '';
        $email = $_SESSION['old_email'] ?? '';
        unset($_SESSION['old_email']);

        $success = $_SESSION['success_message'] ?? '';
        unset($_SESSION['success_message']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = 'Veuillez saisir votre email et votre mot de passe.';
            } else {
                $parent = $this->parentModel->findByEmail($email, $_SESSION['ecole_id'] ?? null);

                if (!$parent || !password_verify($password, $parent['mot_de_passe'])) {
                    $error = 'Email ou mot de passe incorrect.';
                } elseif ($this->childRequestModel->findPendingByParent($parent['id']) && !$this->parentModel->hasChildren($parent['id'])) {
                    $error = 'Votre demande d\'enfant est en attente de validation par l\'administration.';
                } elseif (!$this->parentModel->hasChildren($parent['id'])) {
                    $error = 'Votre compte n\'est pas valide tant qu\'un enfant n\'est pas approuvé.';
                } else {
                    $_SESSION['parent_id'] = $parent['id'];
                    $_SESSION['parent_name'] = $parent['nom_responsable'];
                    $_SESSION['parent_email'] = $parent['email'];
                    $this->redirect('/school/Parent/dashboard');
                }
            }
        }

        $this->renderView('parents/login', [
            'error' => $error,
            'success' => $success,
            'email' => $email,
        ]);
    }

    public function register() {
        if (empty($_SESSION['ecole_id'])) {
            $this->redirect('/school/Ecole/login');
        }

        if (!empty($_SESSION['parent_id'])) {
            $this->redirect('/school/Parent/dashboard');
        }

        $error = '';
        $inputs = [
            'name' => '',
            'email' => '',
            'telephone' => '',
            'child_nom' => '',
            'child_postnom' => '',
            'child_prenom' => '',
            'child_genre' => '',
            'child_date_naissance' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $inputs['name'] = trim($_POST['name'] ?? '');
            $inputs['email'] = trim($_POST['email'] ?? '');
            $inputs['telephone'] = trim($_POST['telephone'] ?? '');
            $password = $_POST['password'] ?? '';
            $passwordConfirm = $_POST['password_confirm'] ?? '';
            $child = [
                'nom' => trim($_POST['child_nom'] ?? ''),
                'postnom' => trim($_POST['child_postnom'] ?? ''),
                'prenom' => trim($_POST['child_prenom'] ?? ''),
                'genre' => trim($_POST['child_genre'] ?? ''),
                'date_naissance' => trim($_POST['child_date_naissance'] ?? '')
            ];

            $ecoleId = $_SESSION['ecole_id'] ?? null;
            if (empty($inputs['name']) || empty($inputs['email']) || empty($inputs['telephone']) || empty($password) || empty($passwordConfirm)
                || empty($child['nom']) || empty($child['postnom']) || empty($child['prenom']) || empty($child['genre']) || empty($child['date_naissance'])) {
                $error = 'Tous les champs parent et enfant sont obligatoires.';
            } elseif (!filter_var($inputs['email'], FILTER_VALIDATE_EMAIL)) {
                $error = 'Entrez une adresse email valide.';
            } elseif ($password !== $passwordConfirm) {
                $error = 'Les mots de passe ne correspondent pas.';
            } elseif ($this->parentModel->findByEmail($inputs['email'], $ecoleId)) {
                $error = 'Un compte existe déjà avec cet email.';
            } elseif ($this->parentModel->findByTelephone($inputs['telephone'], $ecoleId)) {
                $error = 'Un compte existe déjà avec ce numéro de téléphone.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $inserted = $this->parentModel->create([
                    'ecole_id' => $ecoleId,
                    'nom_responsable' => $inputs['name'],
                    'telephone' => $inputs['telephone'],
                    'email' => $inputs['email'],
                    'mot_de_passe' => $hash,
                ]);

                if ($inserted) {
                    $parent = $this->parentModel->findByEmail($inputs['email'], $ecoleId);
                    if ($parent) {
                        $this->childRequestModel->createRequest([
                            'parent_id' => $parent['id'],
                            'nom' => $child['nom'],
                            'postnom' => $child['postnom'],
                            'prenom' => $child['prenom'],
                            'genre' => $child['genre'],
                            'date_naissance' => $child['date_naissance'],
                        ]);
                    }

                    $_SESSION['success_message'] = 'Inscription réussie. La demande d\'enfant a été envoyée à l\'administration.';
                    $this->redirect('/school/');
                } else {
                    $error = 'Impossible de créer le compte. Réessayez plus tard.';
                }
            }
        }

        $this->renderView('parents/register', [
            'error' => $error,
            'inputs' => $inputs,
        ]);
    }

    public function logout() {
        session_unset();
        session_destroy();
        $this->redirect('/school/Ecole/login');
    }
}
