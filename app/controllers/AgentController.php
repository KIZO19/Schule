<?php
// app/controllers/AgentController.php

class AgentController extends Controller {
    private $agentModel;
    private $ecoleModel;

    public function __construct() {
        $this->agentModel = $this->loadModel('AgentModel');
        $this->ecoleModel = $this->loadModel('EcoleModel');
    }

    public function login() {
        $selectedSchoolId = $_SESSION['selected_ecole_id'] ?? null;
        if (empty($selectedSchoolId)) {
            $this->redirect('/school/');
        }

        if (!empty($_SESSION['agent_id'])) {
            $this->redirect('/school/Agent/dashboard');
        }

        $error = '';
        $identifier = '';

        $school = $this->ecoleModel->findById($selectedSchoolId);
        if (!$school) {
            unset($_SESSION['selected_ecole_id'], $_SESSION['selected_ecole_name']);
            $this->redirect('/school/');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $identifier = trim($_POST['identifier'] ?? '');
            $password = $_POST['password'] ?? '';

            // Rate limiting per IP + identifier
            $ip = $this->getClientIp();
            $rateKey = 'agent_login:' . $ip . ':' . md5($identifier);
            if ($this->isRateLimited($rateKey, 6, 300)) {
                $error = 'Trop de tentatives. Réessayez plus tard.';
            } elseif (empty($identifier) || empty($password)) {
                $error = 'Veuillez saisir votre téléphone ou email et votre mot de passe.';
            } else {
                $agent = $this->agentModel->findByIdentifier($identifier, $selectedSchoolId);
                if (!$agent || !isset($agent['mot_de_passe']) || !password_verify($password, $agent['mot_de_passe'])) {
                    $this->incrementRateLimit($rateKey, 6, 300);
                    $error = 'Identifiant ou mot de passe incorrect.';
                } else {
                    // Successful login: regenerate id and clear rate limiter
                    session_regenerate_id(true);
                    $this->clearRateLimit($rateKey);
                    $_SESSION['agent_id'] = $agent['id'];
                    $_SESSION['agent_name'] = trim($agent['nom'] . ' ' . $agent['postnom']);
                    $_SESSION['agent_role_id'] = $agent['role_id'];
                    $_SESSION['agent_role_title'] = $agent['role_title'];
                    $_SESSION['agent_ecole_id'] = $agent['ecole_id'];
                    $_SESSION['ecole_id'] = $selectedSchoolId;
                    $_SESSION['ecole_name'] = $school['nom_etablissement'];
                    $this->redirect('/school/Agent/dashboard');
                }
            }
        }

        $this->renderView('agents/login', [
            'error' => $error,
            'identifier' => $identifier,
            'schoolName' => $school['nom_etablissement']
        ]);
    }

    public function dashboard() {
        if (empty($_SESSION['agent_id'])) {
            $this->redirect('/school/Agent/login');
        }

        $agent = $this->agentModel->findById($_SESSION['agent_id']);
        if (!$agent) {
            session_unset();
            session_destroy();
            $this->redirect('/school/');
        }

        $roleTitle = $agent['role_title'] ?? 'Personnel';
        $dashboardType = 'default';

        if (in_array($agent['role_id'], [1, 2, 3, 4, 5])) {
            $dashboardType = 'management';
        } elseif (in_array($agent['role_id'], [6, 7])) {
            $dashboardType = 'teaching';
        }

        $this->renderView('agents/dashboard', [
            'agent' => $agent,
            'roleTitle' => $roleTitle,
            'dashboardType' => $dashboardType
        ]);
    }

    public function logout() {
        // Clear session cookie and server-side session
        $this->clearSecureCookie(session_name());
        session_unset();
        session_destroy();
        $this->redirect('/school/');
    }
}
