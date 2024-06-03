<?php
session_start();
require_once '../Config/Connexion.php';
require_once '../Model/Reservation.php';
require_once '../Controller/ReservationController.php';
require_once '../Controller/TravelController.php'; // Add the TravelController

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$reservationController = new ReservationController();
$reservations = $reservationController->getAllReservationsByUser($userId);
$travelController = new TravelController(); // Instantiate TravelController

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_reservation_id'])) {
    $reservationController->delete($_POST['delete_reservation_id']);
    header('Location: my_reservations.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr"> <!-- Set language to French -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        }

        body {
            background-color: white;
            /* Change background color to white */
            background-image: url(../uploads/annie-spratt-qyAka7W5uMY-unsplash.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }

        /* Add any additional styles if needed */
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <h1>Mes Réservations</h1>
        <table class="table table-light table-bordered">
            <thead>
                <tr>
                    <th>Passagers</th>
                    <th>Hébergement</th>
                    <th>Repas</th>
                    <th>Heure</th>
                    <th>Coût</th>
                    <th>Voyage</th> <!-- New column for Travel -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation) : ?>
                    <tr>
                        <td><?php echo $reservation['nb_passengers']; ?></td>
                        <td><?php echo $reservation['accommodation']; ?></td>
                        <td><?php echo $reservation['meal']; ?></td>
                        <td><?php echo $reservation['time']; ?></td>
                        <td><?php echo $reservation['cost']; ?></td>
                        <td><?php
                            // Fetch travel details for each reservation
                            $travel = $travelController->getTravelById($reservation['travel_id']);
                            echo $travel['title']; // Display travel title
                            ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="delete_reservation_id" value="<?php echo $reservation['id']; ?>">
                                <button type="submit" class="btn btn-danger">Annuler</button> <!-- Translate "Cancel" to "Annuler" -->
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php include 'footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>