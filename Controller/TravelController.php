<?php
require_once '../Config/Connexion.php';
require_once '../Model/Travel.php';

class TravelController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connexion::getPDO();
    }

    private function uploadFile($file)
    {
        $uploadsDirectory = '../uploads/'; // Path to your uploads directory

        // Check if the file was uploaded without errors
        if ($file['error'] === UPLOAD_ERR_OK) {
            $fileName = basename($file['name']);
            $destination = $uploadsDirectory . $fileName;

            // Move the uploaded file to the destination directory
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                // File uploaded successfully
                return $destination;
            } else {
                // Failed to move file
                return false;
            }
        } else {
            // File upload error occurred
            return false;
        }
    }


    public function addTravel($data, $files, $cities, $start_city_id)
    {
        if (!in_array($data['type'], ['GROUP', 'OUTSIDE', 'INSIDE'])) {
            throw new Exception('Invalid travel type.');
        }

        $image = $this->uploadFile($files['image']);
        $itinerary = $this->uploadFile($files['itinerary']);

        $stmt = $this->pdo->prepare('INSERT INTO travel (title, image, basePrice, itinerary, startDate, endDate, guideName, guideContact, type, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $data['title'],
            $image,
            $data['basePrice'],
            $itinerary,
            $data['startDate'],
            $data['endDate'],
            $data['guideName'],
            $data['guideContact'],
            $data['type'],
            $data['description'] // Add description here
        ]);

        $travel_id = $this->pdo->lastInsertId();
        $this->addTravelCities($travel_id, $cities, $start_city_id);

        return $travel_id;
    }

    public function updateTravel($id, $data, $files, $cities, $start_city_id)
    {
        if (!in_array($data['type'], ['GROUP', 'OUTSIDE', 'INSIDE'])) {
            throw new Exception('Invalid travel type.');
        }

        $travel = $this->getTravelById($id);

        if ($files['image']['error'] == UPLOAD_ERR_OK) {
            $image = $this->uploadFile($files['image']);
        } else {
            $image = $travel['image'];
        }

        if ($files['itinerary']['error'] == UPLOAD_ERR_OK) {
            $itinerary = $this->uploadFile($files['itinerary']);
        } else {
            $itinerary = $travel['itinerary'];
        }

        $stmt = $this->pdo->prepare('UPDATE travel SET title = ?, image = ?, basePrice = ?, itinerary = ?, startDate = ?, endDate = ?, guideName = ?, guideContact = ?, type = ?, description = ? WHERE id = ?');
        $stmt->execute([
            $data['title'],
            $image,
            $data['basePrice'],
            $itinerary,
            $data['startDate'],
            $data['endDate'],
            $data['guideName'],
            $data['guideContact'],
            $data['type'],
            $data['description'], // Update description here
            $id
        ]);

        $this->updateTravelCities($id, $cities, $start_city_id);
    }

    public function deleteTravel($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM travel_city WHERE travel_id = ?');
        $stmt->execute([$id]);
        $stmt = $this->pdo->prepare('DELETE FROM travel WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function getTravelById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM travel WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAllTravels()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM travel');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    private function addTravelCities($travel_id, $cities, $start_city_id)
    {
        foreach ($cities as $city_id) {
            $start_city = $city_id == $start_city_id ? true : false;
            $stmt = $this->pdo->prepare('INSERT INTO travel_city (travel_id, city_id, start_city) VALUES (?, ?, ?)');
            $stmt->execute([$travel_id, $city_id, $start_city]);
        }
    }

    private function updateTravelCities($travel_id, $cities, $start_city_id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM travel_city WHERE travel_id = ?');
        $stmt->execute([$travel_id]);

        $this->addTravelCities($travel_id, $cities, $start_city_id);
    }

    public function getTravelCities($travel_id)
    {
        $stmt = $this->pdo->prepare('SELECT city_id FROM travel_city WHERE travel_id = ?');
        $stmt->execute([$travel_id]);
        $result = $stmt->fetchAll();

        return $result;
    }
    public function getTravelStartCity($travel_id)
    {
        $stmt = $this->pdo->prepare('SELECT city_id FROM travel_city WHERE travel_id = ? AND start_city = 1');
        $stmt->execute([$travel_id]);
        $result = $stmt->fetchAll();

        return $result;
    }
    public function updateTravelBasePrice($id, $basePrice)
    {
        $stmt = $this->pdo->prepare('UPDATE travel SET basePrice = ? WHERE id = ?');
        $stmt->execute([$basePrice, $id]);
    }
}
