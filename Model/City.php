<?php
class City
{
    private $id;
    private $name;

    public function __construct($name)
    {
        $this->setName($name);
    }

   
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

  
    public function setName($name)
    {
        $this->name = $name;
    }
}
