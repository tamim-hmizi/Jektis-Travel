<?php
require_once '../Controller/ReservationController.php';
$controller = new ReservationController();
$controller->delete($_GET['id']);
header('Location: view_reservations.php');
