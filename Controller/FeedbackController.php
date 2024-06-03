<?php
require_once '../Config/Connexion.php';

class FeedbackController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connexion::getPDO();
    }

    public function addFeedback($userId, $travelId, $message)
    {
        $stmt = $this->pdo->prepare('INSERT INTO feedback (user_id, travel_id, message) VALUES (?, ?, ?)');
        $stmt->execute([$userId, $travelId, $message]);
    }

    public function updateFeedback($feedbackId, $userId, $travelId, $message)
    {
        $stmt = $this->pdo->prepare('UPDATE feedback SET user_id = ?, travel_id = ?, message = ? WHERE id = ?');
        $stmt->execute([$userId, $travelId, $message, $feedbackId]);
    }

    public function deleteFeedback($feedbackId)
    {
        $stmt = $this->pdo->prepare('DELETE FROM feedback WHERE id = ?');
        $stmt->execute([$feedbackId]);
    }

    public function getFeedbackById($feedbackId)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM feedback WHERE id = ?');
        $stmt->execute([$feedbackId]);
        return $stmt->fetch();
    }

    public function getAllFeedback()
    {
        $stmt = $this->pdo->prepare('SELECT * FROM feedback');
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
