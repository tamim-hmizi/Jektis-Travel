<?php
session_start();
require_once '../Controller/ReservationController.php';
require_once '../Controller/TravelController.php';

// Inclure la bibliothèque Stripe PHP
require_once '../vendor/stripe/stripe-php/init.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $travel_id = $_GET['id'];
    $user_id = $_SESSION['user_id']; // Ceci devrait être défini dynamiquement en fonction de l'utilisateur connecté

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nb_passengers = $_POST['nb_passengers'];
        $accommodation = $_POST['accommodation'];
        $meal = $_POST['meal'];
        $time = $_POST['time'];

        // Récupérer les détails du voyage pour obtenir le prix de base
        $travelController = new TravelController();
        $travel = $travelController->getTravelById($travel_id);
        $basePrice = $travel['basePrice'];

        // Calculer le coût total
        $cost = $basePrice * $nb_passengers;
        $cost += ($meal == 'non_vegan') ? 200 : 0;
        $cost += ($accommodation == '3_star') ? 300 : 500; // En supposant que 5_star est la seule autre option

        // Traiter le paiement avec Stripe
        \Stripe\Stripe::setApiKey('sk_test_51PNTtC01f5L2YzQVycQxHnYDMJWzRh5lH7661JRnKdhBCfuu2s652oKAksiyJrRTJpdu7XKhmu100neUE0mj7MQj00KbxQF5KF');

        // Récupérer le jeton soumis par le formulaire
        $token = $_POST['stripeToken'];

        // Facturer la carte de l'utilisateur
        try {
            $charge = \Stripe\Charge::create([
                'amount' => $cost * 100, // Montant en cents
                'currency' => 'usd',
                'source' => $token,
                'description' => 'Paiement de la réservation pour l\'ID du voyage : ' . $travel_id,
            ]);

            // Si le paiement réussit, créer la réservation
            $reservationController = new ReservationController();
            $reservationController->create($nb_passengers, $accommodation, $meal, $time, $cost, $travel_id, $user_id);

            // Rediriger vers la page de description du voyage
            header("Location: travel_desciption.php?id=$travel_id");
            exit;
        } catch (\Stripe\Exception\CardException $e) {
            // Afficher le message d'erreur à l'utilisateur
            echo $e->getError()->message;
        }
    }

    $travelController = new TravelController();
    $travel = $travelController->getTravelById($travel_id);
    $basePrice = $travel['basePrice'];
} else {
    echo 'ID de voyage invalide.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Créer une réservation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            background-image: url(../uploads/jeshoots-com-mSESwdMZr-A-unsplash.jpg);
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
    </style>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4">Créer une réservation pour <?php echo $travel['title']; ?></h2>
                        <form method="post" id="payment-form" action="create_reservation.php?id=<?php echo $travel_id; ?>">
                            <div class="form-group">
                                <label for="nb_passengers">Nombre de passagers</label>
                                <input type="number" class="form-control" id="nb_passengers" name="nb_passengers" value="1" min="1" required>
                            </div>
                            <div class="form-group">
                                <label for="accommodation">Hébergement</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="3_star" name="accommodation" value="3_star" required>
                                    <label class="form-check-label" for="3_star">Hôtel 3 étoiles</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="5_star" name="accommodation" value="5_star" required>
                                    <label class="form-check-label" for="5_star">Hôtel 5 étoiles</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="meal">Repas</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="vegan" name="meal" value="vegan" required>
                                    <label class="form-check-label" for="vegan">Végétalien</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="non_vegan" name="meal" value="non_vegan" required>
                                    <label class="form-check-label" for="non_vegan">Non-végétalien</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="time">Heure</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="day" name="time" value="day" required>
                                    <label class="form-check-label" for="day">Jour</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="night" name="time" value="night" required>
                                    <label class="form-check-label" for="night">Nuit</label>
                                </div>
                                <div class="form-group form-check-inline">
                                    <input class="form-check-input" type="radio" id="any" name="time" value="any" required>
                                    <label class="form-check-label" for="any">N'importe quand</label>
                                </div>
                            </div>
                            <h4 id="cost">Coût total : 0 $</h4>
                            <!-- Inclure l'élément de carte Stripe -->
                            <div class="form-group">
                                <div id="card-element">
                                    <!-- Un élément Stripe sera inséré ici. -->
                                </div>
                                <!-- Utilisé pour afficher les erreurs de formulaire. -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                            <button type="submit" class="btn btn-primary">Payer et Soumettre</button>
                            <a class="btn btn-warning" href="travel_desciption.php?id=<?php echo $travel_id ?>">Retour</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Créer un client Stripe.
        var stripe = Stripe('pk_test_51PNTtC01f5L2YzQVqVjsjewxjxNSuKcec0cE1bFl56gKh5RIucR5EPGMaxleZS43my3ZlEKDh4U05D9RpEneVY5a00bB4a1wkr');


        // Créer une instance d'éléments.
        var elements = stripe.elements();

        // Créer une instance de l'élément de carte.
        var card = elements.create('card');

        // Ajouter une instance de l'élément de carte dans la div `card-element`.
        card.mount('#card-element');

        // Gérer les erreurs de validation en temps réel de l'élément de carte.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Gérer la soumission du formulaire.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Informer l'utilisateur s'il y a eu une erreur.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Envoyer le jeton à votre serveur.
                    stripeTokenHandler(result.token);
                }
            });
        });

        // Soumettre le formulaire avec l'identifiant du jeton.
        function stripeTokenHandler(token) {
            // Insérer l'identifiant du jeton dans le formulaire pour qu'il soit soumis au serveur
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Soumettre le formulaire
            form.submit();
        }

        function calculateCost() {
            var basePrice = <?php echo $basePrice; ?>;
            var nbPassengers = document.getElementById('nb_passengers').value;
            var accommodation = document.querySelector('input[name="accommodation"]:checked').value;
            var meal = document.querySelector('input[name="meal"]:checked').value;

            var cost = basePrice * nbPassengers;
            if (meal === 'non_vegan') {
                cost += 200;
            }
            if (accommodation === '3_star') {
                cost += 300;
            } else {
                cost += 500;
            }

            document.getElementById('cost').innerText = 'Coût total : ' + cost + ' $';
        }

        // Call the function initially and whenever the form inputs change
        document.addEventListener("DOMContentLoaded", calculateCost);
        document.getElementById("nb_passengers").addEventListener("change", calculateCost);
        document.querySelectorAll('input[name="accommodation"]').forEach(item => {
            item.addEventListener("change", calculateCost);
        });
        document.querySelectorAll('input[name="meal"]').forEach(item => {
            item.addEventListener("change", calculateCost);
        });
    </script>
</body>

</html>