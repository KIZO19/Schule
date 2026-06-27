<?php
// app/models/ParentModel.php

class ParentModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findByEmail($email, $ecoleId = null) {
        if ($ecoleId !== null) {
            $stmt = $this->db->prepare('SELECT * FROM parents WHERE email = :email AND ecole_id = :ecole_id LIMIT 1');
            $stmt->execute(['email' => $email, 'ecole_id' => $ecoleId]);
        } else {
            $stmt = $this->db->prepare('SELECT * FROM parents WHERE email = :email LIMIT 1');
            $stmt->execute(['email' => $email]);
        }
        return $stmt->fetch();
    }

    public function findByTelephone($telephone, $ecoleId = null) {
        if ($ecoleId !== null) {
            $stmt = $this->db->prepare('SELECT * FROM parents WHERE telephone = :telephone AND ecole_id = :ecole_id LIMIT 1');
            $stmt->execute(['telephone' => $telephone, 'ecole_id' => $ecoleId]);
        } else {
            $stmt = $this->db->prepare('SELECT * FROM parents WHERE telephone = :telephone LIMIT 1');
            $stmt->execute(['telephone' => $telephone]);
        }
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare(
            'INSERT INTO parents (ecole_id, nom_responsable, telephone, email, mot_de_passe) VALUES (:ecole_id, :nom_responsable, :telephone, :email, :mot_de_passe)'
        );
        return $stmt->execute([
            'ecole_id' => $data['ecole_id'],
            'nom_responsable' => $data['nom_responsable'],
            'telephone' => $data['telephone'],
            'email' => $data['email'],
            'mot_de_passe' => $data['mot_de_passe'],
        ]);
    }

    public function hasChildren($parentId) {
        $stmt = $this->db->prepare('SELECT COUNT(*) as total FROM eleves WHERE parent_id = :parent_id');
        $stmt->execute(['parent_id' => $parentId]);
        $row = $stmt->fetch();
        return isset($row['total']) && intval($row['total']) > 0;
    }

    public function countParentsByEcole($ecoleId) {
        $stmt = $this->db->prepare('SELECT COUNT(*) as total FROM parents WHERE ecole_id = :ecole_id');
        $stmt->execute(['ecole_id' => $ecoleId]);
        $row = $stmt->fetch();
        return intval($row['total'] ?? 0);
    }
}
