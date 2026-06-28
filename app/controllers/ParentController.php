<?php
// app/controllers/ParentController.php

class ParentController extends Controller {
    public function dashboard() {
        $this->ensureParentAuthenticated();

        $parentId = $_SESSION['parent_id'];

        // Charge le modèle Eleve pour récupérer les enfants et données associées
        $eleveModel = $this->loadModel('Eleve');
        $eleves = $eleveModel->getElevesByParent($parentId);

        // Choisit le premier enfant par défaut ; si aucun, fournir des valeurs par défaut pour éviter les warnings
        if (empty($eleves)) {
            $_SESSION['login_error'] = 'Votre compte n\'est pas valide tant qu\'un enfant n\'est pas inscrit.';
            session_unset();
            session_destroy();
            $this->redirect('/school/');
        }

        $eleve = $eleves[0];

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

        $this->renderView('ecole/parents/enfant_suivi', [
            'eleve' => $eleve,
            'eleves' => $eleves,
            'compte' => $compte,
            'discipline' => $discipline,
            'notes' => $notes,
            'taux_presence' => $taux_presence,
            'parentName' => $_SESSION['parent_name'] ?? 'Parent',
            'pageTitle' => 'Tableau de bord parent - ' . trim(($eleve['prenom'] ?? '') . ' ' . ($eleve['nom'] ?? '')),
            'metaDescription' => 'Accédez au tableau de bord parent pour suivre le solde, les notes et la présence de votre enfant ' . trim(($eleve['prenom'] ?? '') . ' ' . ($eleve['nom'] ?? '')) . '.',
            'ogTitle' => 'Espace parent - Gestion Scolaire',
            'ogDescription' => 'Suivi scolaire personnalisé pour les parents : paiements, présence, comportement et évaluations.',
            'canonicalUrl' => BASE_URL . '/Parent/dashboard',
            'ogUrl' => BASE_URL . '/Parent/dashboard'
        ]);
    }
}
