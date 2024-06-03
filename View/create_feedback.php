<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (isset($_SESSION['user_id']) && isset($_POST['message'])) {
        $userId = $_SESSION['user_id'];
        $travelId = $_POST['travel_id'];
        $message = $_POST['message'];

        require_once '../Controller/FeedbackController.php';

        $feedbackController = new FeedbackController();
        $feedbackController->addFeedback($userId, $travelId, $message);

        // Rediriger vers la page de détails du voyage
        header("Location: travel_desciption.php?id=$travelId");

        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poster un commentaire</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            /* Changer la couleur de fond en blanc */
            background-image: url(../uploads/jeshoots-com-mSESwdMZr-A-unsplash.jpg);
            /* Ajouter une image de fond */
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
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Poster un commentaire</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <input type="hidden" name="travel_id" value="<?php echo $_GET['id']; ?>">
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer le commentaire</button>
                            <a class="btn btn-warning" href="travel_desciption.php?id=<?php echo $_GET['id'] ?>">Retour</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <?php include 'footer.php' ?>
</body>

</html>