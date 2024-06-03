<?php
require_once '../Controller/UserController.php';

$controller = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        var_dump($controller->login($_POST['email'], $_POST['password']));
        if ($_SESSION['role'] === 'ROLE_ADMIN') {
            header('Location: dashboard.php');
        } else {
            header('Location: index.php');
        }
        exit;
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert">Échec de connexion : ' . $e->getMessage() . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connexion</title>
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header">
                        <h2 class="text-center">Connexion</h2>
                    </div>
                    <div class="card-body">
                        <form method="post" class="mt-3">
                            <div class="form-group">
                                <label for="email">Email :</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Mot de passe :</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Connexion</button>
                            <a href="index.php" class="btn btn-warning">Retour</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>