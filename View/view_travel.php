<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Let's Travel</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-link {
            font-size: 1.2rem;
        }

        .nav-item .btn {
            font-size: 1.2rem;
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
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
                    <h2 class="mt-5">Voyages <a href="create_travel.php" style="float: right;"><button class="btn btn-primary nav-link">Ajouter</button></a></h2>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Prix de base</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Nom du guide</th>
                                <th>Contact du guide</th>
                                <th>Type</th>
                                <th>Villes</th>
                                <th>Ville de départ</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../Controller/TravelController.php';
                            $controller = new TravelController();
                            $travels = $controller->getAllTravels();
                            foreach ($travels as $travel) : ?>
                                <tr>
                                    <td><?= $travel['title'] ?></td>
                                    <td><?= $travel['description'] ?></td>
                                    <td><?= $travel['basePrice'] ?></td>
                                    <td><?= $travel['startDate'] ?></td>
                                    <td><?= $travel['endDate'] ?></td>
                                    <td><?= $travel['guideName'] ?></td>
                                    <td><?= $travel['guideContact'] ?></td>
                                    <td><?= $travel['type'] ?></td>
                                    <td>
                                        <?php
                                        require_once '../Controller/CityController.php';
                                        $cityController = new CityController();
                                        $cities = $controller->getTravelCities($travel['id']);
                                        foreach ($cities as $city_id) {
                                            $city = $cityController->read($city_id['city_id']);
                                            echo $city['name'] . ', ';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $startCity = $controller->getTravelStartCity($travel['id']);
                                        if (!empty($startCity)) {
                                            $startCityName = $cityController->read($startCity[0]['city_id']);
                                            echo $startCityName['name'];
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="update_travel.php?id=<?= $travel['id'] ?>" class="btn btn-primary btn-sm">Modifier</a>
                                        <a href="delete_travel.php?id=<?= $travel['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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