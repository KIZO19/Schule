<?php
// app/models/EcoleModel.php

class EcoleModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->ensurePasswordColumnExists();
    }

    private function ensurePasswordColumnExists() {
        try {
            $stmt = $this->db->query("SHOW COLUMNS FROM ecoles LIKE 'mot_de_passe'");
            $column = $stmt->fetch();
            if (!$column) {
                $this->db->exec('ALTER TABLE ecoles ADD COLUMN mot_de_passe VARCHAR(255) DEFAULT NULL AFTER email_officiel');
            }
        } catch (PDOException $e) {
            // Silencieux si la table ecoles n'existe pas encore ou si l'accès est impossible.
        }
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare('SELECT * FROM ecoles WHERE email_officiel = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $stmt = $this->db->prepare('SELECT * FROM ecoles WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function searchSchools($query = '') {
        if ($query !== '') {
            $stmt = $this->db->prepare(
                'SELECT id, nom_etablissement, adresse, telephone_contact, email_officiel
                 FROM ecoles
                 WHERE statut_systeme = :statut AND nom_etablissement LIKE :query
                 ORDER BY nom_etablissement'
            );
            $stmt->execute([
                'statut' => 'Actif',
                'query' => "%{$query}%",
            ]);
        } else {
            $stmt = $this->db->prepare(
                'SELECT id, nom_etablissement, adresse, telephone_contact, email_officiel
                 FROM ecoles
                 WHERE statut_systeme = :statut
                 ORDER BY nom_etablissement'
            );
            $stmt->execute(['statut' => 'Actif']);
        }

        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare(
            'INSERT INTO ecoles (nom_etablissement, adresse, telephone_contact, email_officiel, mot_de_passe, statut_systeme, code_ecole, province_education, devise_principale) VALUES (:nom_etablissement, :adresse, :telephone_contact, :email_officiel, :mot_de_passe, :statut_systeme, :code_ecole, :province_education, :devise_principale)'
        );
        return $stmt->execute([
            'nom_etablissement' => $data['nom_etablissement'],
            'adresse' => $data['adresse'],
            'telephone_contact' => $data['telephone_contact'],
            'email_officiel' => $data['email_officiel'],
            'mot_de_passe' => $data['mot_de_passe'] ?? null,
            'statut_systeme' => $data['statut_systeme'] ?? 'En_Attente',
            'code_ecole' => $data['code_ecole'] ?? null,
            'province_education' => $data['province_education'] ?? null,
            'devise_principale' => $data['devise_principale'] ?? 'USD',
        ]);
    }
}
