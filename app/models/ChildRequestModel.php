<?php
// app/models/ChildRequestModel.php

class ChildRequestModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensureTableExists();
    }

    private function ensureTableExists() {
        $this->db->exec(
            'CREATE TABLE IF NOT EXISTS child_requests (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                parent_id INT(11) NOT NULL,
                nom VARCHAR(100) NOT NULL,
                postnom VARCHAR(100) NOT NULL,
                prenom VARCHAR(100) NOT NULL,
                genre ENUM("Masculin", "Féminin", "Autre") NOT NULL,
                date_naissance DATE NOT NULL,
                statut ENUM("pending", "approved", "rejected") NOT NULL DEFAULT "pending",
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NULL DEFAULT NULL,
                FOREIGN KEY (parent_id) REFERENCES parents(id) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
        );
    }

    public function createRequest($data) {
        $stmt = $this->db->prepare(
            'INSERT INTO child_requests (parent_id, nom, postnom, prenom, genre, date_naissance, statut, created_at) VALUES (:parent_id, :nom, :postnom, :prenom, :genre, :date_naissance, :statut, NOW())'
        );
        return $stmt->execute([
            'parent_id' => $data['parent_id'],
            'nom' => $data['nom'],
            'postnom' => $data['postnom'],
            'prenom' => $data['prenom'],
            'genre' => $data['genre'],
            'date_naissance' => $data['date_naissance'],
            'statut' => $data['statut'] ?? 'pending'
        ]);
    }

    public function findPendingByParent($parentId) {
        $stmt = $this->db->prepare('SELECT * FROM child_requests WHERE parent_id = :parent_id AND statut = "pending" ORDER BY created_at DESC LIMIT 1');
        $stmt->execute(['parent_id' => $parentId]);
        return $stmt->fetch();
    }

    public function getPendingRequests() {
        $stmt = $this->db->prepare('SELECT cr.*, p.nom_responsable, p.email FROM child_requests cr JOIN parents p ON cr.parent_id = p.id WHERE cr.statut = "pending" ORDER BY cr.created_at DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function approveRequest($requestId) {
        $this->db->beginTransaction();

        $stmt = $this->db->prepare('SELECT * FROM child_requests WHERE id = :id FOR UPDATE');
        $stmt->execute(['id' => $requestId]);
        $request = $stmt->fetch();

        if (!$request || $request['statut'] !== 'pending') {
            $this->db->rollBack();
            return false;
        }

        $insert = $this->db->prepare('INSERT INTO eleves (nom, postnom, prenom, genre, date_naissance, parent_id, statut_eleve) VALUES (:nom, :postnom, :prenom, :genre, :date_naissance, :parent_id, :statut_eleve)');
        $insert->execute([
            'nom' => $request['nom'],
            'postnom' => $request['postnom'],
            'prenom' => $request['prenom'],
            'genre' => $request['genre'],
            'date_naissance' => $request['date_naissance'],
            'parent_id' => $request['parent_id'],
            'statut_eleve' => 'actif'
        ]);

        $update = $this->db->prepare('UPDATE child_requests SET statut = "approved", updated_at = NOW() WHERE id = :id');
        $update->execute(['id' => $requestId]);

        $this->db->commit();
        return true;
    }

    public function rejectRequest($requestId) {
        $stmt = $this->db->prepare('UPDATE child_requests SET statut = "rejected", updated_at = NOW() WHERE id = :id AND statut = "pending"');
        return $stmt->execute(['id' => $requestId]);
    }
}
