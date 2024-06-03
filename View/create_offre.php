<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../Controller/OffreController.php';
    $offreController = new OffreController();
    $remise = $_POST['remise'];
    $travel_id = $_POST['travel_id'];
    if ($offreController->createOffre($remise, $travel_id)) {
        echo "<div class='alert alert-success mt-3'>Offre ajoutée avec succès!</div>";
        header('Location: view_offre.php');
        exit();
    } else {
        echo "<div class='alert alert-danger mt-3'>Échec de l'ajout de l'offre.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ajouter Offre</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
            <div class="container">
                <h2 class="mt-5">Ajouter Offre</h2>
                <form action="create_offre.php" method="POST">
                    <div class="form-group">
                        <label for="travel_id">Voyage</label>
                        <select class="form-control" id="travel_id" name="travel_id" required>
                            <option value="">Sélectionnez un voyage</option>
                            <?php
                            require_once '../Controller/TravelController.php';
                            $travelController = new TravelController();
                            $travels = $travelController->getAllTravels();
                            foreach ($travels as $travel) {
                                echo "<option value='{$travel['id']}'>{$travel['title']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="remise">Remise (%)</label>
                        <input type="number" class="form-control" id="remise" name="remise" min="5" max="95" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <a class="btn btn-warning" href="view_offre.php">Retour</a>
                </form>
            </div>
        </main>
    </div>
</body>

</html>