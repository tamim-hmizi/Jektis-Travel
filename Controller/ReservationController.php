<?php
require_once '../Config/Connexion.php';
require_once '../Model/Reservation.php';

class ReservationController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connexion::getPDO();
    }

    public function create($nb_passengers, $accommodation, $meal, $time, $cost, $travel_id, $user_id)
    {
        $stmt = $this->pdo->prepare('INSERT INTO reservation (nb_passengers, accommodation, meal, time, cost, travel_id, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$nb_passengers, $accommodation, $meal, $time, $cost, $travel_id, $user_id]);
        return $this->pdo->lastInsertId();
    }

    public function read($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM reservation WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $nb_passengers, $accommodation, $meal, $time, $cost, $travel_id, $user_id)
    {
        $stmt = $this->pdo->prepare('UPDATE reservation SET nb_passengers = ?, accommodation = ?, meal = ?, time = ?, cost = ?, travel_id = ?, user_id = ? WHERE id = ?');
        $stmt->execute([$nb_passengers, $accommodation, $meal, $time, $cost, $travel_id, $user_id, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM reservation WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function getAllReservations()
    {
        $stmt = $this->pdo->query('SELECT * FROM reservation');
        return $stmt->fetchAll();
    }
    public function getAllReservationsByUser($userId)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM reservation WHERE user_id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }
}
