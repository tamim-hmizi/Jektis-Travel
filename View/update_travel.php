<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../Controller/TravelController.php';
    $controller = new TravelController();
    $controller->updateTravel($_GET['id'], $_POST, $_FILES, $_POST['cities'], $_POST['startCity']);
    header('Location: view_travel.php');
} else {
    require_once '../Controller/TravelController.php';
    require_once '../Controller/CityController.php';
    $controller = new TravelController();
    $cityController = new CityController();
    $travel = $controller->getTravelById($_GET['id']);
    $cities = $cityController->getAllCities();
    $selectedCities = $controller->getTravelCities($_GET['id']);
    $startCity = $controller->getTravelStartCity($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modifier un voyage</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.css" />
</head>

<body>
    <div class="container mt-5">
        <h2>Modifier un voyage</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $travel['id'] ?>">

            <div class="form-group row">
                <label class="col-sm-4">Sélectionner un lieu</label>
                <div class="col-sm-6">
                    <select name="cities[]" multiple class="label ui selection fluid search dropdown" id="tripLocs">
                        <option value="">Sélectionner des lieux</option>
                        <?php foreach ($cities as $city) : ?>
                            <option value="<?= $city['id'] ?>" <?= in_array($city['id'], array_column($selectedCities, 'city_id')) ? 'selected' : '' ?>><?= $city['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4">Sélectionner un lieu de départ</label>
                <div class="col-sm-6">
                    <select class="form-control" id="startCity" name="startCity" required>
                        <?php foreach ($cities as $city) : ?>
                            <option value="<?= $city['id'] ?>" <?= $city['id'] == $startCity[0]['city_id'] ? 'selected' : '' ?>><?= $city['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="title">Titre :</label>
                <input type="text" class="form-control" id="title" name="title" value="<?= $travel['title'] ?>" required>
            </div>
            <div class="form-group">
                <label for="basePrice">Prix de base :</label>
                <input type="number" step="0.01" class="form-control" id="basePrice" name="basePrice" value="<?= $travel['basePrice'] ?>" required>
            </div>
            <div class="form-group">
                <label for="startDate">Date de début :</label>
                <input type="date" class="form-control" id="startDate" name="startDate" value="<?= $travel['startDate'] ?>" required>
            </div>
            <div class="form-group">
                <label for="endDate">Date de fin :</label>
                <input type="date" class="form-control" id="endDate" name="endDate" value="<?= $travel['endDate'] ?>" required>
            </div>
            <div class="form-group">
                <label for="guideName">Nom du guide :</label>
                <input type="text" class="form-control" id="guideName" name="guideName" value="<?= $travel['guideName'] ?>" required>
            </div>
            <div class="form-group">
                <label for="guideContact">Contact du guide :</label>
                <input type="text" class="form-control" id="guideContact" name="guideContact" value="<?= $travel['guideContact'] ?>" required>
            </div>
            <div class="form-group">
                <label for="type">Type :</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="GROUP" <?= $travel['type'] == 'GROUP' ? 'selected' : '' ?>>Groupe</option>
                    <option value="OUTSIDE" <?= $travel['type'] == 'OUTSIDE' ? 'selected' : '' ?>>Extérieur</option>
                    <option value="INSIDE" <?= $travel['type'] == 'INSIDE' ? 'selected' : '' ?>>Intérieur</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" id="description" name="description" required><?= $travel['description'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image :</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="itinerary">Itinéraire :</label>
                <input type="file" class="form-control-file" id="itinerary" name="itinerary">
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
            <a href="view_travel.php" class="btn btn-warning">Retour</a>
        </form>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js"></script>
    <script>
        $(function() {
            $('.label.ui.dropdown').dropdown({
                maxSelections: 5
            });
        });

        $(document).ready(function() {
            $('#tripLocs').change(function() {
                var selectedLocations = $(this).val();
                $('#startCity').empty();
                $.each(selectedLocations, function(index, value) {
                    var optionText = $("#tripLocs option[value='" + value + "']").text();
                    $('#startCity').append(new Option(optionText, value));
                });
            });
        });
    </script>
</body>

</html>