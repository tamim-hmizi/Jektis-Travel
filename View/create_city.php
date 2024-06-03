<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create City</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h2 class="mt-5">Ajouter Ville</h2>
        <form action="create_city.php" method="post">
            <div class="form-group">
                <label for="name">Nom Ville</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a href="view_cities.php" class="btn btn-warning">
                Retourner</a>
        </form>
    </div>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once '../Controller/CityController.php';
    $controller = new CityController();
    $controller->create($_POST['name']);
    header('Location: view_cities.php');
}
?>