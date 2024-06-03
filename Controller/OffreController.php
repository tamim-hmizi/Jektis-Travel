<?php
require_once '../Config/Connexion.php';
require_once '../Model/Offre.php';
require_once '../Controller/TravelController.php';

class OffreController
{
    private $pdo;
    private $travelController;

    public function __construct()
    {
        $this->pdo = Connexion::getPDO();
        $this->travelController = new TravelController();
    }

    public function createOffre($remise, $travel_id)
    {
        // Check if there are any existing offers for the specified travel ID
        $existing_offres = $this->getOffresByTravelId($travel_id);

        if (empty($existing_offres)) {
            // Get the current travel details
            $travel = $this->travelController->getTravelById($travel_id);

            if ($travel && $travel['basePrice'] != 0) {
                // Create the offer
                $offre = new Offre();
                $offre->setRemise($remise);
                $offre->setTravelId($travel_id);
                $query = "INSERT INTO offre (remise, travel_id) VALUES (?, ?)";
                $stmt = $this->pdo->prepare($query);
                $stmt->execute([$remise, $travel_id]);

                // Apply the discount on the base price
                $discountedPrice = $travel['basePrice'] * ((100 - $remise) / 100);
                // Update the base price of the travel
                $this->travelController->updateTravelBasePrice($travel_id, $discountedPrice);

                return true;
            }
        }

        return false;
    }

    public function deleteOffre($id)
    {
        // Get the offer details before deleting
        $stmt = $this->pdo->prepare('SELECT * FROM offre WHERE id = ?');
        $stmt->execute([$id]);
        $offre = $stmt->fetch();

        if ($offre) {
            $travel_id = $offre['travel_id'];
            $remise = $offre['remise'];

            // Delete the offer
            $stmt = $this->pdo->prepare('DELETE FROM offre WHERE id = ?');
            $stmt->execute([$id]);

            // Get the current travel details
            $travel = $this->travelController->getTravelById($travel_id);

            if ($travel) {
                // Revert the discount on the travel base price if the remise is not zero
                if ($remise != 0) {
                    $originalPrice = $travel['basePrice'] / ((100 - $remise) / 100);
                    $this->travelController->updateTravelBasePrice($travel_id, $originalPrice);
                }
            }

            return true;
        }

        return false;
    }

    public function getAllOffres()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM offre');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getOffresByTravelId($travel_id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM offre WHERE travel_id = ?');
        $stmt->execute([$travel_id]);
        return $stmt->fetchAll();
    }
}
