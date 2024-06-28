<?php
class Travel
{
    private $id;
    private $title;
    private $image;
    private $basePrice;
    private $itinerary;
    private $startDate;
    private $endDate;
    private $guideName;
    private $guideContact;
    private $type;
    private $description; 

    public function __construct($title, $image, $basePrice, $itinerary, $startDate, $endDate, $guideName, $guideContact, $type, $description)
    {
        $this->setTitle($title);
        $this->setImage($image);
        $this->setBasePrice($basePrice);
        $this->setItinerary($itinerary);
        $this->setStartDate($startDate);
        $this->setEndDate($endDate);
        $this->setGuideName($guideName);
        $this->setGuideContact($guideContact);
        $this->setType($type);
        $this->setDescription($description); 
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getBasePrice()
    {
        return $this->basePrice;
    }

    public function getItinerary()
    {
        return $this->itinerary;
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getGuideName()
    {
        return $this->guideName;
    }

    public function getGuideContact()
    {
        return $this->guideContact;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getDescription()
    {
        return $this->description;
    }

    // Setters
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setBasePrice($basePrice)
    {
        $this->basePrice = $basePrice;
    }

    public function setItinerary($itinerary)
    {
        $this->itinerary = $itinerary;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }

    public function setGuideName($guideName)
    {
        $this->guideName = $guideName;
    }

    public function setGuideContact($guideContact)
    {
        $this->guideContact = $guideContact;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function setDescription($description)
    {
        $this->description = $description; 
    }
}
