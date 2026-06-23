<?php
// app/core/Controller.php

class Controller {
    // Permet d'instancier un modèle SQL
    public function loadModel($model) {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    // Permet de charger une vue en lui transmettant des données (sous forme de tableau)
    public function renderView($view, $data = []) {
        // Transforme les clés du tableau en variables accessibles dans la vue
        // ex: ['eleves' => $liste] devient accessible via $eleves dans le HTML
        extract($data);

        $viewPath = __DIR__ . '/../../views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("La vue '$view' n'existe pas.");
        }
    }
}