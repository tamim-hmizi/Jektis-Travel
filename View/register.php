<?php
require_once '../Controller/UserController.php';

$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $userId = $controller->register(
            $_POST['name'],
            $_POST['lastName'],
            $_POST['email'],
            $_POST['phoneNumber'],
            $_POST['age'],
            $_POST['password']
        );
        header('Location: login.php');
        echo '<div class="alert alert-success" role="alert">Inscription réussie ! ID utilisateur : ' . $userId . '</div>';
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert">Échec de l\'inscription : ' . $e->getMessage() . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription d'utilisateur</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url(../uploads/francesca-tirico-9G9vxsMzi18-unsplash.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Inscription d'utilisateur</h3>
                    </div>
                    <div class="card-body">

                        <form method="post">
                            <div class="form-group">
                                <label for="name">Prénom :</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Nom de famille :</label>
                                <input type="text" class="form-control" name="lastName" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Numéro de téléphone :</label>
                                <input type="text" class="form-control" name="phoneNumber" required>
                            </div>
                            <div class="form-group">
                                <label for="age">Âge :</label>
                                <input type="number" class="form-control" name="age" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe :</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>

                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                            <a href="index.php" class="btn btn-warning">Retour</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>