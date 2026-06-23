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

    public function redirect($route) {
        if (strpos($route, 'http://') === 0 || strpos($route, 'https://') === 0 || strpos($route, '/') === 0) {
            header('Location: ' . $route);
        } else {
            header('Location: ' . BASE_URL . '/' . ltrim($route, '/'));
        }
        exit;
    }
}