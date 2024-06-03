<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Jektis</title>
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

        .carousel-img {
            height: 600px;
            /* Adjust the height as needed */
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php include_once 'header.php'; ?>
    <div id="image-slider" class="carousel slide" data-ride="carousel" style="margin-top: -5px;">
        <div class="carousel-inner">
            <!-- You can add your images dynamically here -->
            <div class="carousel-item active">
                <img src="../uploads/ashim-d-silva-pGcqw1ARGyg-unsplash.jpg" class="d-block w-100 carousel-img" alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="../uploads/annie-spratt-qyAka7W5uMY-unsplash.jpg" class="d-block w-100 carousel-img" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="../uploads/francesca-tirico-9G9vxsMzi18-unsplash.jpg" class="d-block w-100 carousel-img" alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="../uploads/jeshoots-com-mSESwdMZr-A-unsplash.jpg" class="d-block w-100 carousel-img" alt="Image 2">
            </div>
            <!-- Add more carousel items as needed -->
        </div>
        <a class="carousel-control-prev" href="#image-slider" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#image-slider" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Offer Section -->
    <div class="container mt-5">
        <?php
        // Include required controllers
        require_once '../Controller/TravelController.php';
        require_once '../Controller/OffreController.php';

        // Create instances of controllers
        $travelController = new TravelController();
        $offreController = new OffreController();

        // Get all offers
        $offres = $offreController->getAllOffres();
        if ($offres) {
            echo '<h2 class="mb-4">Offres Spéciales</h2>
        <div class="row">';
            // Loop through each offer
            foreach ($offres as $offre) {
                // Get travel details
                $travel = $travelController->getTravelById($offre['travel_id']);

                // Calculate discounted price
                $OldPrice = $travel['basePrice'] / ((100 - $offre['remise']) / 100);
        ?>
                <div class="col-md-4 mb-4">
                    <div class="card" onclick="window.location.href='travel_desciption.php?id=<?php echo $travel['id']; ?>'">
                        <img src="<?php echo $travel['image']; ?>" class="card-img-top" alt="Travel Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $travel['title']; ?></h5>
                            <p class="card-text"><?php echo $travel['description']; ?></p>
                            <p class="card-text">Prix de Base: <?php echo $OldPrice ?></p>
                            <p class="card-text">Prix Réduit:<?php echo $travel['basePrice']; ?></p>
                        </div>
                    </div>
                </div>
        <?php }
            echo '</div>';
        } ?>
    </div>

    <!-- All Travels Section -->
    <div class="container mt-5">
        <h2 class="mb-4">Nos Voyages</h2>
        <div class="row">
            <?php
            // Get all travels
            $travels = $travelController->getAllTravels();

            // Display all travels
            foreach ($travels as $travel) {
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card" onclick="window.location.href='travel_desciption.php?id=<?php echo $travel['id']; ?>'">
                        <img src="<?php echo $travel['image']; ?>" class="card-img-top" alt="Travel Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $travel['title']; ?></h5>
                            <p class="card-text">Prix de Base: <?php echo $travel['basePrice']; ?></p>
                            <p class="card-text"><?php echo $travel['description']; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php include 'footer.php' ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>