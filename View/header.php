<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lets Travel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="override.css">
    <link rel="shortcut icon" href="images/favicon.png">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="10">
    <!--navigation bar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="<?php echo !isset($_SESSION['role']) || $_SESSION['role'] === 'ROLE_USER' ? 'index.php' : ''; ?>">
            <img src="../uploads/logo_jektis.png" alt="JEKTISS Logo" height="30">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbarNavDropdown" class="collapse navbar-collapse">
            <?php if (!isset($_SESSION['role']) || $_SESSION['role'] === 'ROLE_USER') : ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="voyage.php">Voyage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
            <?php endif; ?>
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <?php if ($_SESSION['role'] === 'ROLE_USER') : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Bonjour, <?php echo $_SESSION['name'] . ' ' . $_SESSION['lastName']; ?>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="my_reservations.php">Mes Réservations</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Déconnexion</a>
                            </div>
                        </li>
                    <?php elseif ($_SESSION['role'] === 'ROLE_ADMIN') : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Salut, Admin
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="logout.php">Déconnexion</a>
                            </div>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <span class="nav-link">Bonjour, <?php echo $_SESSION['name'] . ' ' . $_SESSION['lastName']; ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger nav-link" href="logout.php">Déconnexion</a>
                        </li>
                    <?php endif; ?>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="btn  nav-link" href="login.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn  nav-link" href="register.php">Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <br><br><br>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIyk0F2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/animations.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>