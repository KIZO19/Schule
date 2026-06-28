<?php
// app/core/Controller.php

class Controller {
    
    // Permet d'instancier un modèle SQL
    public function loadModel($model) {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    // Permet de charger une vue en lui transmettant des données
    public function renderView($view, $data = []) {
        // Transforme les clés du tableau en variables
        extract($data);

        $viewPath = __DIR__ . '/../../views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("La vue '$view' n'existe pas.");
        }
    }

    protected function ensureSchoolAuthenticated() {
        if (empty($_SESSION['ecole_id']) && empty($_SESSION['agent_id']) && empty($_SESSION['parent_id'])) {
            $this->redirect('/school/Ecole/login');
        }
    }

    protected function ensureAgentAuthenticated() {
        if (empty($_SESSION['agent_id'])) {
            if (!empty($_SESSION['parent_id']) || !empty($_SESSION['ecole_id'])) {
                $this->triggerForbidden();
            }
            $this->redirect('/school/Agent/login');
        }
    }

    protected function ensureParentAuthenticated() {
        if (empty($_SESSION['parent_id'])) {
            if (!empty($_SESSION['agent_id']) || !empty($_SESSION['ecole_id'])) {
                $this->triggerForbidden();
            }
            $this->redirect('/school/Auth/login');
        }
    }

    protected function ensureEcoleAuthenticated() {
        if (empty($_SESSION['ecole_id'])) {
            if (!empty($_SESSION['agent_id']) || !empty($_SESSION['parent_id'])) {
                $this->triggerForbidden();
            }
            $this->redirect('/school/Ecole/login');
        }
    }

    public function redirect($route) {
        if (strpos($route, 'http://') === 0 || strpos($route, 'https://') === 0 || strpos($route, '/') === 0) {
            header('Location: ' . $route);
        } else {
            header('Location: ' . BASE_URL . '/' . ltrim($route, '/'));
        }
        exit;
    }

    // CSRF token helpers
    protected function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    protected function verifyCsrfToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    // Simple input sanitization function for display (not SQL)
    protected function e($value) {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }

    // Detect whether request is secure (HTTPS)
    protected function isSecureRequest() {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    }

    // Set a secure cookie using modern options array (PHP 7.3+)
    protected function setSecureCookie($name, $value, $expire = 0) {
        $options = [
            'expires' => $expire ? time() + (int)$expire : 0,
            'path' => '/',
            'secure' => $this->isSecureRequest(),
            'httponly' => true,
            'samesite' => 'Lax'
        ];
        setcookie($name, $value, $options);
    }

    // Clear a cookie (set expiry in the past)
    protected function clearSecureCookie($name) {
        $options = [
            'expires' => time() - 3600,
            'path' => '/',
            'secure' => $this->isSecureRequest(),
            'httponly' => true,
            'samesite' => 'Lax'
        ];
        setcookie($name, '', $options);
    }

    protected function triggerForbidden() {
        http_response_code(403);
        if (file_exists(__DIR__ . '/../../views/errors/403.php')) {
            require_once __DIR__ . '/../../views/errors/403.php';
        } else {
            echo "<h1>403 - Accès refusé</h1><p>Vous n'êtes pas autorisé à consulter cette page.</p>";
        }
        exit;
    }

    // --- Simple session-based rate limiting helpers ---
    protected function getClientIp() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0];
        return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    }

    protected function isRateLimited($key, $maxAttempts = 5, $windowSeconds = 300) {
        if (empty($_SESSION['rate_limit'][$key])) return false;
        $info = $_SESSION['rate_limit'][$key];
        if (time() - ($info['first'] ?? 0) > $windowSeconds) return false;
        return ($info['count'] ?? 0) >= $maxAttempts;
    }

    protected function incrementRateLimit($key, $maxAttempts = 5, $windowSeconds = 300) {
        if (empty($_SESSION['rate_limit'][$key]) || time() - ($_SESSION['rate_limit'][$key]['first'] ?? 0) > $windowSeconds) {
            $_SESSION['rate_limit'][$key] = ['count' => 1, 'first' => time()];
            return 1;
        }
        $_SESSION['rate_limit'][$key]['count'] = ($_SESSION['rate_limit'][$key]['count'] ?? 0) + 1;
        return $_SESSION['rate_limit'][$key]['count'];
    }

    protected function clearRateLimit($key) {
        if (isset($_SESSION['rate_limit'][$key])) unset($_SESSION['rate_limit'][$key]);
    }
}