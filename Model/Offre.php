<?php
class Offre
{
    private $id;
    private $remise;
    private $travel_id;

   
    public function __construct($remise = null, $travel_id = null)
    {

        $this->remise = $remise;
        $this->travel_id = $travel_id;
    }

    
    public function getId()
    {
        return $this->id;
    }

    
    public function getRemise()
    {
        return $this->remise;
    }

    public function setRemise($remise)
    {
        $this->remise = $remise;
    }

    public function getTravelId()
    {
        return $this->travel_id;
    }

    public function setTravelId($travel_id)
    {
        $this->travel_id = $travel_id;
    }
}
