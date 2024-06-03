<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Voyageons</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            /* Changement de couleur de fond en blanc */
            background-image: url(../uploads/annie-spratt-qyAka7W5uMY-unsplash.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-link {
            font-size: 1.2rem;
        }

        .nav-item .btn {
            font-size: 1.2rem;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <div class="container mt-5">
        <?php if (isset($_GET['id']) && !empty($_GET['id'])) {
            require_once '../Controller/TravelController.php';
            require_once '../Controller/CityController.php';

            $travelController = new TravelController();
            $cityController = new CityController();

            $travel_id = $_GET['id'];

            $travel = $travelController->getTravelById($travel_id);
            $cities = $travelController->getTravelCities($travel_id);
            $cityNames = array_map(function ($city) use ($cityController) {
                $cityData = $cityController->read($city['city_id']);
                return $cityData['name'];
            }, $cities);
        ?>
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <img src="<?php echo $travel['image']; ?>" class="card-img-top" alt="Image du voyage">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $travel['title']; ?></h5>
                            <p class="card-title">Description : <?php echo $travel['description']; ?></p>
                            <p class="card-text">Prix de base : <?php echo $travel['basePrice']; ?></p>
                            <p class="card-text">Date de début : <?php echo $travel['startDate']; ?></p>
                            <p class="card-text">Date de fin : <?php echo $travel['endDate']; ?></p>
                            <p class="card-text">Nom du guide : <?php echo $travel['guideName']; ?></p>
                            <p class="card-text">Contact du guide : <?php echo $travel['guideContact']; ?></p>
                            <?php if ($travel['type'] === "OUTSIDE") : ?>
                                <p class="card-text">Type : Extérieure </p>
                            <?php endif; ?>
                            <?php if ($travel['type'] === "INSIDE") : ?>
                                <p class="card-text">Type : Intérieure </p>
                            <?php endif; ?>
                            <?php if ($travel['type'] === "GROUP") : ?>
                                <p class="card-text">Type : Groupe </p>
                            <?php endif; ?>

                            <h6>Villes :</h6>
                            <ul>
                                <?php foreach ($cityNames as $cityName) { ?>
                                    <li><?php echo $cityName; ?></li>
                                <?php } ?>
                            </ul>

                            <?php if (isset($_SESSION['user_id'])) : ?>
                                <a href="create_reservation.php?id=<?php echo $travel['id']; ?>" class="btn btn-success">Faire une réservation</a>
                                <a href="create_feedback.php?id=<?php echo $travel['id']; ?>" class="btn btn-primary">Publier un commentaire</a>
                            <?php endif; ?>
                            <a class="btn btn-warning" href="voyage.php">Retour</a>

                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <!-- Affichage des listes de voyages -->
            <div class="row">
                <?php
                require_once '../Controller/TravelController.php';
                require_once '../Controller/CityController.php';

                $travelController = new TravelController();
                $cityController = new CityController();

                $travels = $travelController->getAllTravels();

                foreach ($travels as $travel) {
                    $cities = $travelController->getTravelCities($travel['id']);
                    $cityNames = array_map(function ($city) use ($cityController) {
                        $cityData = $cityController->read($city['city_id']);
                        return $cityData['name'];
                    }, $cities);
                ?>
                    <div class="col-md-4 mb-4">
                        <div class="card" onclick="window.location.href='?id=<?php echo $travel['id']; ?>'">
                            <img src="<?php echo $travel['image']; ?>" class="card-img-top" alt="Image du voyage">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $travel['title']; ?></h5>
                                <p class="card-text"><?php echo implode(', ', $cityNames); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <?php include 'footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>