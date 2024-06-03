<?php
require_once '../Controller/TravelController.php';
$controller = new TravelController();
$controller->deleteTravel($_GET['id']);
header('Location: view_travel.php');
