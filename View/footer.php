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
    <style>
        /* Add custom styles here */
        .footer {
            background-color: #343a40;
            height: 300px;
            /* Same color as navbar */
            color: #ffffff;
            /* White text */
            padding: 30px 0;
            margin-bottom: 0;
        }

        

        .footer a {
            color: #ffffff;
            /* White text for links */
        }

        .footer a:hover {
            color: #f8f9fa;
            /* Lighter shade on hover */
            text-decoration: none;
            /* Remove underline */
        }

        @media screen and (max-width : 500px) {
            .footer{
                height: 600px;
            }
        }
    </style>
</head>

<body>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a class="navbar-brand" href="<?php echo !isset($_SESSION['role']) || $_SESSION['role'] === 'ROLE_USER' ? 'index.php' : ''; ?>">
                        <img src="../uploads/logo_jektis.png" alt="JEKTISS Logo" height="70">
                    </a>
                </div>
                
                <div class="col-md-6" >
                    <h4> Liens : </h4>
                    <a href="index.php">Acceuil</a>,
                    <a href="voyage.php">Voyages</a>,
                    <a href="contact.php">Contact</a>
                </div>
                <div class="col-md-6">
                    <h4>Coordonnées</h4>
                    <p><strong>Adresse (Siège social) :</strong><br>89 Avenue H Bourguiba, 2ème étage, Ariana</p>
                    <p><strong>Adresse (Branche) :</strong><br>22 Avenue Abdelaziz Thaalbi, Menzah 9A</p>
                </div>
                <div class="col-md-6">
                    <h4>Contact</h4>
                    <p><strong>Téléphone (Tourisme Local) :</strong><br>71706900 (poste100) : GSM : 98538070</p>
                    <p><strong>Email (Tourisme Local) :</strong><br>sales@jektistravel.com</p>
                </div>
            </div>
        </div>
        </div>
    </footer>

    
</body>

</html>