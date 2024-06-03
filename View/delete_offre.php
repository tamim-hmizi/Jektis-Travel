<?php
require '../Controller/OffreController.php';
$OffreController = new OffreController();
$OffreController->deleteOffre($_GET['id']);
header('Location: view_offre.php');
