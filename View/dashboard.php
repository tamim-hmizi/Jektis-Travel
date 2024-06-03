<?php
require_once '../Controller/FeedbackController.php';
require_once '../Controller/UserController.php';
require_once '../Controller/TravelController.php';

$feedbackController = new FeedbackController();
$userController = new UserController();
$travelController = new TravelController();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Lets Travel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-link {
            font-size: 1.2rem;
        }

        .sidebar {
            background-color: #343a40;
            padding-top: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            margin-left: 35px;
            margin-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 1.2rem;
            color: #fff;
            display: block;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            padding: 20px;
            margin-top: -350px;
        }

        .table {
            border-radius: 10px;
            background-color: #fff;
            color: #495057;
        }

        .table th,
        .table td {
            border: none;
        }

        .table thead th {
            background-color: #343a40;
            color: #fff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Commentaires</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_cities.php">Ville</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_travel.php">Voyage</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_reservation.php">Réservation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="view_offre.php">Offre</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
                <div class="container">
                    <h2 class="mt-5">Commentaires</h2>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Titre du voyage</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $feedbacks = $feedbackController->getAllFeedback();
                            foreach ($feedbacks as $feedback) {
                                $user = $userController->getUserById($feedback['user_id']);
                                $travel = $travelController->getTravelById($feedback['travel_id']);
                                echo "<tr>
                                    <td>{$user['name']}</td>
                                    <td>{$user['lastName']}</td>
                                    <td>{$travel['title']}</td>
                                    <td>{$feedback['message']}</td>
                                    <td>
                                        <a href='delete_feedback.php?id={$feedback['id']}' class='btn btn-danger btn-sm'>Supprimer</a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>