<?php
class Offre
{
    private $id;
    private $remise;
    private $travel_id;

    // Constructor
    public function __construct($remise = null, $travel_id = null)
    {

        $this->remise = $remise;
        $this->travel_id = $travel_id;
    }

    // Getter and Setter for id
    public function getId()
    {
        return $this->id;
    }

    // Getter and Setter for remise
    public function getRemise()
    {
        return $this->remise;
    }

    public function setRemise($remise)
    {
        $this->remise = $remise;
    }

    // Getter and Setter for travel_id
    public function getTravelId()
    {
        return $this->travel_id;
    }

    public function setTravelId($travel_id)
    {
        $this->travel_id = $travel_id;
    }
}
