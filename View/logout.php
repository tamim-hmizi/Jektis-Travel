<?php
require_once '../Controller/UserController.php';

$controller = new UserController();
$controller->logout();

header('Location: index.php');
exit;
