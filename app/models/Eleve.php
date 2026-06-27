<?php
// app/models/Eleve.php

class Eleve {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // Retourne la liste des élèves pour un parent (inclut nom_classe via la table inscriptions)
    public function getElevesByParent($parentId) {
        $sql = "SELECT e.*, (
            SELECT cl.nom_classe
            FROM inscriptions ins
            JOIN classes cl ON ins.classe_id = cl.id
            WHERE ins.eleve_id = e.id
            ORDER BY ins.id DESC
            LIMIT 1
        ) AS nom_classe
        FROM eleves e
        WHERE e.parent_id = :parent_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['parent_id' => $parentId]);
        return $stmt->fetchAll();
    }

    // Récupère le compte élève (solde débiteur)
    public function getCompteByEleve($eleveId) {
        $stmt = $this->db->prepare('SELECT * FROM comptes_eleves WHERE eleve_id = :eleve_id ORDER BY id DESC LIMIT 1');
        $stmt->execute(['eleve_id' => $eleveId]);
        $compte = $stmt->fetch();
        if ($compte) {
            $compte['reste_a_payer'] = isset($compte['solde_debiteur']) ? (float)$compte['solde_debiteur'] : 0.0;
        } else {
            $compte = ['reste_a_payer' => 0.0];
        }
        return $compte;
    }

    // Récupère une synthèse discipline (points retirés et conduite simplifiée)
    public function getDisciplineSummary($eleveId) {
        $stmt = $this->db->prepare('SELECT COALESCE(SUM(retrait_points),0) as PointsRetires, GROUP_CONCAT(faute SEPARATOR " | ") as fautes FROM discipline_eleves WHERE eleve_id = :eleve_id');
        $stmt->execute(['eleve_id' => $eleveId]);
        $row = $stmt->fetch();
        $points = isset($row['PointsRetires']) ? intval($row['PointsRetires']) : 0;
        $conduite = 'Excellente';
        if ($points > 5) $conduite = 'Médiocre';
        elseif ($points > 2) $conduite = 'Avertissement';

        return [
            'PointsRetires' => $points,
            'fautes' => $row['fautes'] ?? '',
            'conduite' => $conduite
        ];
    }

    // Calcul basique du taux de présence pour un mois donné (par défaut mois courant)
    public function getPresenceRate($eleveId, $year = null, $month = null) {
        $year = $year ?? date('Y');
        $month = $month ?? date('n');
        $stmt = $this->db->prepare("SELECT
            SUM(CASE WHEN statut = 'Présent' THEN 1 ELSE 0 END) as presents,
            COUNT(*) as total
            FROM presences_eleves
            WHERE eleve_id = :eleve_id AND YEAR(date_jour) = :y AND MONTH(date_jour) = :m");
        $stmt->execute(['eleve_id' => $eleveId, 'y' => $year, 'm' => $month]);
        $row = $stmt->fetch();
        $presents = intval($row['presents'] ?? 0);
        $total = intval($row['total'] ?? 0);
        if ($total === 0) return 0.0;
        return ($presents / $total) * 100.0;
    }

    // Récupère les dernières notes de l'élève
    public function getNotesByEleve($eleveId, $limit = 20) {
        $sql = "SELECT c.nom_cours, ev.type_evaluation, ev.date_evaluation, ev.ponderation_max, n.note_obtenue
                FROM notes n
                JOIN evaluations ev ON n.evaluation_id = ev.id
                JOIN attribution_cours ac ON ev.attribution_cours_id = ac.id
                JOIN cours c ON ac.cours_id = c.id
                WHERE n.eleve_id = :eleve_id
                ORDER BY ev.date_evaluation DESC
                LIMIT :lim";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue('eleve_id', $eleveId, PDO::PARAM_INT);
        $stmt->bindValue('lim', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function countElevesByEcole($ecoleId) {
        $stmt = $this->db->prepare('SELECT COUNT(*) as total FROM eleves e JOIN parents p ON e.parent_id = p.id WHERE p.ecole_id = :ecole_id');
        $stmt->execute(['ecole_id' => $ecoleId]);
        $row = $stmt->fetch();
        return intval($row['total'] ?? 0);
    }
}
