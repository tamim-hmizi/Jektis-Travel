<?php
class User
{
    private $id;
    private $name;
    private $lastName;
    private $email;
    private $phoneNumber;
    private $age;
    private $password;
    private $role;

    public function __construct($name, $lastName, $email, $phoneNumber, $age, $password, $role)
    {
        $this->setName($name);
        $this->setLastName($lastName);
        $this->setEmail($email);
        $this->setPhoneNumber($phoneNumber);
        $this->setAge($age);
        $this->setPassword($password);
        $this->setRole($role);
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }

    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }

    // Setters
    public function setEmail($email)
    {

        $this->email = $email;
    }

    public function setPhoneNumber($phoneNumber)
    {

        $this->phoneNumber = $phoneNumber;
    }

    public function setAge($age)
    {

        $this->age = $age;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRole($role)
    {
        if ($role === "ROLE_USER" || $role === "ROLE_ADMIN") {
            $this->role = $role;
        }
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }


    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
