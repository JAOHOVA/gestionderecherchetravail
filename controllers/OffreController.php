<?php
require_once('../models/Offre.php');

class OffreController {
    private $offreModel;

    public function __construct($db) {
        $this->offreModel = new Offre($db);
    }

    public function getAllOffres() {
        // Appeler la méthode du modèle pour récupérer tous les offres
        $offres = $this->offreModel->getAllOffres();
        // Traiter les données récupérées, les envoyer en tant que réponse JSON
        header('Content-Type: application/json');
        echo json_encode($offres);
    }

    public function getOffreById($offreId) {
        $offre = $this->offreModel->getOffreById($offreId);
        header('Content-Type: application/json');
        echo json_encode($offre);
    }

    public function createOffre($offreData) {
        $newOffreId = $this->offreModel->createOffre($offreData);
        if ($newOffreId !== null) {
            echo json_encode(array("message" => "Offre créé avec l'ID : " . $newOffreId));
        } else {
            echo json_encode(array("message" => "Erreur lors de la création de l'offre"));
        }
    }

    public function updateOffre($offreId, $newOffreData) {
        // Appeler la méthode du modèle pour mettre à jour une offre
        $success = $this->offreModel->updateUser($offreId, $newOffreData);
        if ($success) {
            echo json_encode(array("message" => "Offre mis à jour avec succès"));
        } else {
            echo json_encode(array("message" => "Erreur lors de la mise à jour de l'offre"));
        }
    }

    public function deleteOffre($offreId) {
        // Appeler la méthode du modèle pour supprimer une offre
        $success = $this->offreModel->deleteOffre($offreId);
        if ($success) {
            echo json_encode(array("message" => "Offre supprimé avec succès"));
        } else {
            echo json_encode(array("message" => "Erreur lors de la suppression de l'Offre"));
        }
    }
}