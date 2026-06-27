<?php
// app/core/App.php

class App {
    protected $controller = 'EcoleController'; // Contrôleur par défaut, l’authentification école passe en priorité
    protected $method = 'landing';             // Méthode par défaut
    protected $params = [];                    // Paramètres optionnels

    public function __construct() {
        $url = $this->parseUrl();

        // 1. Vérification du contrôleur
        if (!empty($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            // CORRECTION : On ajoute bien .php ici pour la vérification du fichier
            if (file_exists(__DIR__ . '/../controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                $this->trigger404();
                return;
            }
        }

        // CORRECTION : Ajout de '.php' à la fin du require_once pour que PHP trouve le fichier
        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 2. Vérification de la méthode / de l'action
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            } else {
                $this->trigger404();
                return;
            }
        }

        // 3. Récupération des paramètres
        $this->params = $url ? array_values($url) : [];

        // 4. Appel de la méthode
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl() {
        $requestUri = $_SERVER['REQUEST_URI'];
        // Permet de nettoyer proprement le chemin sous XAMPP
        $route = str_replace('/school/', '', $requestUri);
        $route = explode('?', $route)[0]; 
        $route = rtrim($route, '/');
        
        return $route ? explode('/', $route) : [];
    }

    private function trigger404() {
        http_response_code(404);
        if (file_exists(__DIR__ . '/../../views/errors/404.php')) {
            require_once __DIR__ . '/../../views/errors/404.php';
        } else {
            echo "<h1>404 - Page non trouvée</h1>";
        }
    }
}