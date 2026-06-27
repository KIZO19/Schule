<?php
// app/models/UserModel.php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    /**
     * Recherche un enregistrement dans la table `utilisateurs` par identifiant (email ou téléphone)
     */
    public function findByIdentifiant($identifiant) {
        $stmt = $this->db->prepare(
            'SELECT * FROM utilisateurs WHERE identifiant = :identifiant LIMIT 1'
        );
        $stmt->execute(['identifiant' => $identifiant]);
        return $stmt->fetch();
    }

    public function findByReference($referenceId, $role, $ecoleId = null) {
        // Retourne les données complémentaires selon le rôle (agents, parents, eleves)
        if (in_array($role, ['préfet_école','DE_école','DD_école','DP_école','DA_école','comptable_école','sec_école','promoteur_école','enseignant_école','ecole_admin','super_admin'])) {
            $stmt = $this->db->prepare('SELECT a.*, r.titre_role AS role_title FROM agents a LEFT JOIN roles_administration r ON a.role_id = r.id WHERE a.id = :id LIMIT 1');
            $stmt->execute(['id' => $referenceId]);
            return $stmt->fetch();
        }

        if ($role === 'parent_ecole') {
            $stmt = $this->db->prepare('SELECT * FROM parents WHERE id = :id LIMIT 1');
            $stmt->execute(['id' => $referenceId]);
            return $stmt->fetch();
        }

        if ($role === 'eleve_ecole') {
            $stmt = $this->db->prepare('SELECT * FROM eleves WHERE id = :id LIMIT 1');
            $stmt->execute(['id' => $referenceId]);
            return $stmt->fetch();
        }

        return null;
    }
}
