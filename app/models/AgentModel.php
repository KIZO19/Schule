<?php
// app/models/AgentModel.php

class AgentModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensurePasswordColumnExists();
        $this->ensureEmailColumnExists();
    }

    private function ensurePasswordColumnExists() {
        try {
            $stmt = $this->db->query("SHOW COLUMNS FROM agents LIKE 'mot_de_passe'");
            $column = $stmt->fetch();
            if (!$column) {
                $this->db->exec('ALTER TABLE agents ADD COLUMN mot_de_passe VARCHAR(255) DEFAULT NULL AFTER telephone');
            }
        } catch (PDOException $e) {
            // Silencieux si la table n'existe pas et si l'accès est impossible.
        }
    }

    private function ensureEmailColumnExists() {
        try {
            $stmt = $this->db->query("SHOW COLUMNS FROM agents LIKE 'email'");
            $column = $stmt->fetch();
            if (!$column) {
                $this->db->exec('ALTER TABLE agents ADD COLUMN email VARCHAR(255) DEFAULT NULL AFTER telephone');
            }
        } catch (PDOException $e) {
            // Silencieux si la table n'existe pas ou si l'accès est impossible.
        }
    }

    public function findByTelephone($telephone, $ecoleId) {
        $stmt = $this->db->prepare(
            'SELECT a.*, r.titre_role AS role_title
             FROM agents a
             JOIN roles_administration r ON a.role_id = r.id
             WHERE a.telephone = :telephone AND a.ecole_id = :ecole_id
             LIMIT 1'
        );
        $stmt->execute([
            'telephone' => $telephone,
            'ecole_id' => $ecoleId,
        ]);

        return $stmt->fetch();
    }

    public function findByIdentifier($identifier, $ecoleId) {
        $stmt = $this->db->prepare(
            'SELECT a.*, r.titre_role AS role_title
             FROM agents a
             JOIN roles_administration r ON a.role_id = r.id
             WHERE a.ecole_id = :ecole_id AND (a.telephone = :identifier OR a.email = :identifier)
             LIMIT 1'
        );
        $stmt->execute([
            'identifier' => $identifier,
            'ecole_id' => $ecoleId,
        ]);

        return $stmt->fetch();
    }

    public function findById($id) {
        $stmt = $this->db->prepare(
            'SELECT a.*, r.titre_role AS role_title
             FROM agents a
             JOIN roles_administration r ON a.role_id = r.id
             WHERE a.id = :id
             LIMIT 1'
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function countAgentsByEcole($ecoleId) {
        $stmt = $this->db->prepare('SELECT COUNT(*) as total FROM agents WHERE ecole_id = :ecole_id');
        $stmt->execute(['ecole_id' => $ecoleId]);
        $row = $stmt->fetch();
        return intval($row['total'] ?? 0);
    }
}
