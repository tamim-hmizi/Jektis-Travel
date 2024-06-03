<?php
require_once '../Controller/FeedbackController.php';
$feedbackController = new FeedbackController();
$feedbackController->deleteFeedback($_GET['id']);
header('Location: dashboard.php');
