<?php
require_once '../Config/Connexion.php';
require_once '../Model/City.php';

class CityController
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connexion::getPDO();
    }

    public function create($name)
    {
        $stmt = $this->pdo->prepare('INSERT INTO city (name) VALUES (?)');
        $stmt->execute([$name]);
        return $this->pdo->lastInsertId();
    }

    public function read($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM city WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $name)
    {
        $stmt = $this->pdo->prepare('UPDATE city SET name = ? WHERE id = ?');
        $stmt->execute([$name, $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM city WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function searchByName($name)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM city WHERE name LIKE ?');
        $stmt->execute(['%' . $name . '%']);
        return $stmt->fetchAll();
    }

    public function getAllCities()
    {
        $stmt = $this->pdo->query('SELECT * FROM city');
        return $stmt->fetchAll();
    }
}
