<?php
require_once '../Controller/CityController.php';
$controller = new CityController();
$controller->delete($_GET['id']);
header('Location: view_cities.php');
