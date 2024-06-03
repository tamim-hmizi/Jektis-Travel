<?php

class Feedback
{
    private $id;
    private $userId;
    private $travelId;
    private $message;

    public function __construct($userId, $travelId, $message)
    {
        $this->userId = $userId;
        $this->travelId = $travelId;
        $this->message = $message;
    }

    
    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getTravelId()
    {
        return $this->travelId;
    }

    public function setTravelId($travelId)
    {
        $this->travelId = $travelId;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }
}
