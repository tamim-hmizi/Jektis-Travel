<?php
class Reservation
{
    private $id;
    private $nb_passengers;
    private $accommodation;
    private $meal;
    private $time;
    private $cost;
    private $travel_id;
    private $user_id;

    public function __construct($nb_passengers, $accommodation, $meal, $time, $cost, $travel_id, $user_id)
    {
        $this->setNbPassengers($nb_passengers);
        $this->setAccommodation($accommodation);
        $this->setMeal($meal);
        $this->setTime($time);
        $this->setCost($cost);
        $this->setTravelId($travel_id);
        $this->setUserId($user_id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNbPassengers()
    {
        return $this->nb_passengers;
    }

    public function getAccommodation()
    {
        return $this->accommodation;
    }

    public function getMeal()
    {
        return $this->meal;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function getTravelId()
    {
        return $this->travel_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    
    public function setNbPassengers($nb_passengers)
    {
        $this->nb_passengers = $nb_passengers;
    }

    public function setAccommodation($accommodation)
    {
        $this->accommodation = $accommodation;
    }

    public function setMeal($meal)
    {
        $this->meal = $meal;
    }

    public function setTime($time)
    {
        $this->time = $time;
    }

    public function setCost($cost)
    {
        $this->cost = $cost;
    }

    public function setTravelId($travel_id)
    {
        $this->travel_id = $travel_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
}
