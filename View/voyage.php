<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Voyage</title>
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
        }

        .card {
            cursor: pointer;
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        body {
            background-image: url(../uploads/francesca-tirico-9G9vxsMzi18-unsplash.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }

        form.mb-4 {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        input.form-control,
        select.form-control {
            width: 300px;
            border-radius: 20px 0 0 20px;
            height: 50px;
            /* Rounded border on the left side */

            border: none;
            padding: 10px;
            outline: none;
        }

        select.form-control {
            border-radius: 0;
            /* Rounded border on the right side */
        }

        button.btn.btn-primary {
            border: none;
            outline: none;
            border-radius: 0 20px 20px 0;
            background-color: white;
            color: black;
            /* Rounded border on the right side */
            height: 50px;
            width: 120px;


        }
    </style>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <div class="container mt-5">

        <form action="" method="GET" class="mb-4">
            <input type="text" class="form-control" id="city" name="city" placeholder="Taper Le Nom De Ville ...">
            <select class="form-control" id="category" name="category">
                <option value="">Les Categories</option>
                <option value="GROUP">Groupe</option>
                <option value="OUTSIDE">Extérieure</option>
                <option value="INSIDE">Intérieure</option>
            </select>
            <button class="btn btn-primary" type="submit">Rechercher</button>
        </form>

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

                // Filter based on search and category
                $citySearch = isset($_GET['city']) ? $_GET['city'] : '';
                $categoryFilter = isset($_GET['category']) ? $_GET['category'] : '';

                // Check if city matches the search query
                $cityMatches = $citySearch === '' || preg_grep("/$citySearch/i", $cityNames);

                // Check if category matches the selected filter
                $categoryMatches = $categoryFilter === '' || $travel['type'] === $categoryFilter;

                if ($cityMatches && $categoryMatches) {
            ?>
                    <div class="col-md-4 mb-4">
                        <div class="card" onclick="window.location.href='travel_desciption.php?id=<?php echo $travel['id']; ?>'">
                            <img src="<?php echo $travel['image']; ?>" class="card-img-top" alt="Travel Image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $travel['title']; ?></h5>
                                <p class="card-text"><?php echo $travel['description']; ?></p>
                                <p class="card-text">Prix de Base: <?php echo $travel['basePrice']; ?></p>
                                <p class="card-text"><?php echo implode(', ', $cityNames); ?></p>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
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