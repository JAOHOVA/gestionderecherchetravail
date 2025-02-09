<?php

require_once('../config/database.php');

class Offre {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllOffres() {
        // Récupérer tous les utilisateurs depuis la base de données
        try {
            $query = "SELECT * FROM offres";
            $statement = $this->db->query($query);
            $offres = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $offres;
        } catch (PDOException $e) {
            // Gérer les erreurs de requête
            return array();
        }
    }

    public function getOffreById($offreId) {
        // Récupérer une offre par son ID depuis la base de données
        try {
            $query = "SELECT * FROM offres WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $offreId);
            $statement->execute();
            $offre = $statement->fetch(PDO::FETCH_ASSOC);
            return $offre;
        } catch (PDOException $e) {
            return array();
        }
    }

    public function createOffre($offreData) {
        // Créer une nouvelle offre dans la base de données avec les données fournies
        try {
            $query = "INSERT INTO offres (titre, created_at, description, 
            statut, entreprise, lieu) VALUES (:titre, :created_at, :description,
            statut, :entreprise, :lieu)";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':titre', $offreData['titre']);
            $statement->bindParam(':created_at', $offreData['created_at']);
            $statement->bindParam(':description', $offreData['description']);
            $statement->bindParam(':statut', $offreData['statut']);
            $statement->bindParam(':entreprise', $offreData['entreprise']);
            $statement->bindParam(':lieu', $offreData['lieu']);
            $statement->execute();
            
            // Renvoyer l'ID du nouvel utilisateur créé
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            // Gérer les erreurs de requête
            return null;
        }
    }

    public function updateOffre($offreId, $newOffreData) {
        // Mettre à jour les informations d'une offre spécifique dans la base de données
        try {
            $query = "UPDATE offres SET titre = :titre, url = :url, created_at = :created_at,
            description = :description, statut = :statut, entreprise = :entreprise,
            lieu = :lieu WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $offreId);
            $statement->bindParam(':titre', $newOffreData['titre']);
            $statement->bindParam(':created_at', $newOffreData['created_at']);
            $statement->bindParam(':description', $newOffreData['description']);
            $statement->bindParam(':statut', $newOffreData['statut']);
            $statement->bindParam(':entreprise', $newOffreData['entreprise']);
            $statement->bindParam(':lieu', $newOffreData['lieu']);
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de requête
            return false;
        }
    }

    public function deleteOffre($offreId) {
        // Supprimer une offre de la base de données
        try {
            $query = "DELETE FROM offres WHERE id = :id";
            $statement = $this->db->prepare($query);
            $statement->bindParam(':id', $offreId);
            $statement->execute();

            return true;
        } catch (PDOException $e) {
            // Gérer les erreurs de requête
            return false;
        }
    }
}