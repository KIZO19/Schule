<?php
// app/controllers/AccessController.php

class AccessController extends Controller {
    private $userModel;
    private $agentModel;
    private $parentModel;
    private $eleveModel;
    private $ecoleModel;

    public function __construct() {
        $this->userModel = $this->loadModel('UserModel');
        $this->agentModel = $this->loadModel('AgentModel');
        $this->parentModel = $this->loadModel('ParentModel');
        $this->eleveModel = $this->loadModel('Eleve');
        $this->ecoleModel = $this->loadModel('EcoleModel');
    }

    public function login() {
        $selectedSchoolId = $_SESSION['selected_ecole_id'] ?? null;
        if (empty($selectedSchoolId)) {
            $this->redirect('/school/');
        }

        // Si déjà connecté, rediriger selon le type présent en session
        if (!empty($_SESSION['agent_id'])) {
            $this->redirect('/school/Agent/dashboard');
        }
        if (!empty($_SESSION['parent_id'])) {
            $this->redirect('/school/Parent/dashboard');
        }
        if (!empty($_SESSION['ecole_id'])) {
            $this->redirect('/school/Ecole/dashboard');
        }

        $error = '';
        $identifier = '';

        $school = $this->ecoleModel->findById($selectedSchoolId);
        if (!$school) {
            unset($_SESSION['selected_ecole_id'], $_SESSION['selected_ecole_name']);
            $this->redirect('/school/');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // CSRF check
            $csrf = $_POST['csrf_token'] ?? '';
            if (!$this->verifyCsrfToken($csrf)) {
                $error = 'Requête invalide (CSRF).';
            } else {
                $identifier = trim($_POST['identifier'] ?? '');
                $password = $_POST['password'] ?? '';

                // Rate limiting: key per IP + identifier
                $ip = $this->getClientIp();
                $rateKey = 'login:' . $ip . ':' . md5($identifier);
                if ($this->isRateLimited($rateKey, 6, 300)) {
                    $error = 'Trop de tentatives. Réessayez plus tard.';
                } elseif (empty($identifier) || empty($password)) {
                    $error = 'Veuillez saisir votre identifiant et votre mot de passe.';
                } else {
                $user = $this->userModel->findByIdentifiant($identifier);
                if (!$user) {
                    // Pas d'utilisateur global; essayer agents/parents directement
                    $agent = $this->agentModel->findByIdentifier($identifier, $selectedSchoolId);
                    $parent = $this->parentModel->findByTelephone($identifier, $selectedSchoolId) ?: $this->parentModel->findByEmail($identifier, $selectedSchoolId);
                    $eleve = null;

                    if ($agent && isset($agent['mot_de_passe']) && password_verify($password, $agent['mot_de_passe'])) {
                        $_SESSION['agent_id'] = $agent['id'];
                        $_SESSION['agent_name'] = trim($agent['nom'] . ' ' . $agent['postnom']);
                        $_SESSION['agent_role_id'] = $agent['role_id'];
                        $_SESSION['agent_role_title'] = $agent['role_title'];
                        $_SESSION['agent_ecole_id'] = $agent['ecole_id'];
                        $_SESSION['ecole_id'] = $selectedSchoolId;
                        $_SESSION['ecole_name'] = $school['nom_etablissement'];
                        $this->redirect('/school/Agent/dashboard');
                        return;
                    }

                    if ($parent && isset($parent['mot_de_passe']) && password_verify($password, $parent['mot_de_passe'])) {
                        $_SESSION['parent_id'] = $parent['id'];
                        $_SESSION['parent_name'] = $parent['nom_responsable'];
                        $_SESSION['parent_email'] = $parent['email'];
                        $this->redirect('/school/Parent/dashboard');
                        return;
                    }

                    // Si échec
                    $this->incrementRateLimit($rateKey, 6, 300);
                    $error = 'Identifiant ou mot de passe incorrect.';
                } else {
                    // On a trouvé un enregistrement dans `utilisateurs`.
                    if (!isset($user['mot_de_passe']) || !password_verify($password, $user['mot_de_passe'])) {
                        $error = 'Identifiant ou mot de passe incorrect.';
                    } else {
                        // Regenerate session id on successful login
                        session_regenerate_id(true);
                        // Clear rate limit for this identifier on success
                        $this->clearRateLimit($rateKey);
                        // Charger les données de référence selon le rôle
                        $ref = $this->userModel->findByReference($user['reference_id'], $user['role'], $user['ecole_id']);

                        switch ($user['role']) {
                            case 'super_admin':
                            case 'ecole_admin':
                            case 'préfet_école':
                            case 'DE_école':
                            case 'DD_école':
                            case 'DP_école':
                            case 'DA_école':
                            case 'comptable_école':
                            case 'sec_école':
                            case 'promoteur_école':
                            case 'enseignant_école':
                                // Agent-like roles
                                if ($ref) {
                                    $_SESSION['agent_id'] = $ref['id'];
                                    $_SESSION['agent_name'] = trim(($ref['nom'] ?? '') . ' ' . ($ref['postnom'] ?? ''));
                                    $_SESSION['agent_role_id'] = $ref['role_id'] ?? null;
                                    $_SESSION['agent_role_title'] = $ref['role_title'] ?? $user['role'];
                                    $_SESSION['agent_ecole_id'] = $ref['ecole_id'] ?? $user['ecole_id'];
                                    $_SESSION['ecole_id'] = $user['ecole_id'];
                                    $_SESSION['ecole_name'] = $this->ecoleModel->findById($user['ecole_id'])['nom_etablissement'] ?? '';
                                    $this->redirect('/school/Agent/dashboard');
                                    return;
                                }
                                break;
                            case 'parent_ecole':
                                if ($ref) {
                                    $_SESSION['parent_id'] = $ref['id'];
                                    $_SESSION['parent_name'] = $ref['nom_responsable'] ?? '';
                                    $_SESSION['parent_email'] = $ref['email'] ?? '';
                                    $this->redirect('/school/Parent/dashboard');
                                    return;
                                }
                                break;
                            case 'eleve_ecole':
                                if ($ref) {
                                    // Connecter comme élève: on pourrait stocker eleve_id
                                    $_SESSION['eleve_id'] = $ref['id'];
                                    $_SESSION['eleve_name'] = trim(($ref['nom'] ?? '') . ' ' . ($ref['postnom'] ?? ''));
                                    $this->redirect('/school/Parent/enfant_suivi');
                                    return;
                                }
                                break;
                        }

                        $this->incrementRateLimit($rateKey, 6, 300);
                        $error = 'Identifiant ou mot de passe incorrect.';
                    }
                }
            }
        }

        $this->renderView('access/login', [
            'error' => $error,
            'identifier' => $identifier,
            'schoolName' => $school['nom_etablissement']
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
