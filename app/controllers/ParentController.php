<?php
// app/controllers/ParentController.php

class ParentController extends Controller {
    public function dashboard() {
        if (empty($_SESSION['parent_id'])) {
            $this->redirect('/school/');
        }

        $parentId = $_SESSION['parent_id'];

        // Charge le modèle Eleve pour récupérer les enfants et données associées
        $eleveModel = $this->loadModel('Eleve');
        $eleves = $eleveModel->getElevesByParent($parentId);

        // Choisit le premier enfant par défaut
        $eleve = !empty($eleves) ? $eleves[0] : null;

        $compte = ['reste_a_payer' => 0.0];
        $discipline = [];
        $notes = [];
        $taux_presence = 0.0;

        if ($eleve && isset($eleve['id'])) {
            $eleveId = $eleve['id'];
            $compte = $eleveModel->getCompteByEleve($eleveId);
            $discipline = $eleveModel->getDisciplineSummary($eleveId);
            $notes = $eleveModel->getNotesByEleve($eleveId, 50);
            $taux_presence = $eleveModel->getPresenceRate($eleveId);
        }

        $this->renderView('parents/enfant_suivi', [
            'eleve' => $eleve,
            'compte' => $compte,
            'discipline' => $discipline,
            'notes' => $notes,
            'taux_presence' => $taux_presence
        ]);
    }
}
