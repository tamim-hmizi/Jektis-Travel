    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/autoload.php'; // Include PHP Mailer autoloader

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form data
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['telephone'];
        $objet = $_POST['objet'];
        $message = $_POST['message'];

        // Instantiate PHP Mailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'hmizi.tamim@esprit.tn'; // SMTP username
            $mail->Password = 'ocir zdfk hndu rzln'; // SMTP password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('hmizi.tamim@esprit.tn', 'Jektiss'); // Your email address and name
            $mail->addAddress('hmizi.tamim@esprit.tn'); // Recipient's email

            // Content
            $mail->isHTML(true);
            $mail->Subject = $objet;
            $mail->Body    = "Nom: $nom<br>Prenom: $prenom<br>Email: $email<br>Téléphone: $telephone<br>Objet: $objet<br>Message: $message";

            // Send email
            $mail->send();
            echo 'Message has been sent successfully';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Contact</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-image: url(../uploads/mantas-hesthaven-_g1WdcKcV3w-unsplash.jpg);
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

            .card {
                cursor: pointer;
            }

            .card-img-top {
                height: 200px;
                object-fit: cover;
            }

            .contact-info {
                background-color: #f8f9fa;
                padding: 20px;
                margin-top: 20px;
                border-radius: 10px;
                opacity: 0.7;
            }

            .contact-info h3 {
                font-size: 1.5rem;
                margin-bottom: 10px;
            }

            .contact-info p {
                font-size: 1.2rem;
                margin-bottom: 5px;
            }

            .contact-info a {
                color: #007bff;
                text-decoration: none;
                font-weight: bold;
            }

            .contact-info a:hover {
                text-decoration: underline;
            }

            .contact-form {
                background-color: #f8f9fa;
                padding: 20px;
                margin-top: 20px;
                border-radius: 10px;
                opacity: 0.7;
            }

            .contact-form label {
                font-weight: bold;
            }

            .contact-form input[type="text"],
            .contact-form input[type="email"],
            .contact-form textarea {
                width: 100%;
                padding: 10px;
                margin: 5px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            .contact-form input[type="submit"] {
                background-color: #007bff;
                color: #fff;
                border: none;
                padding: 10px 20px;
                cursor: pointer;
                border-radius: 5px;
            }

            .contact-form input[type="submit"]:hover {
                background-color: #0056b3;
            }

            .container {
                display: flex;
                gap: 20px;
                justify-content: space-between;
                align-items: start;
            }

            .contact-form {
                width: 600px;
            }

            @media screen and (max-width: 750px) {
                .container {
                    flex-direction: column;
                }

                .contact-form {
                    max-width: 420px;
                }
            }
        </style>
    </head>

    <body>
        <?php include 'header.php'; ?>

        <div class="container">
            <!-- Contact Information -->
            <div>
                <div class="coordonnes contact-info">
                    <h3>Coordonnées</h3>
                    <p><strong>Adresse (Siège social) :</strong><br> 89 Avenue H Bourguiba, 2ème étage, Ariana</p>
                    <p><strong>Adresse (Branche) :</strong><br> 22 Avenue Abdelaziz Thaalbi, Menzah 9A</p>
                </div>
                <div class="contact contact-info">
                    <h3>Contact</h3>
                    <p><strong>Téléphone (Tourisme Local) :</strong><br> 71706900 (poste 103) / GSM : <a href="tel:+21698755830">98755830</a></p>
                    <p><strong>Email (Tourisme Local) :</strong><br> <a href="mailto:tourisme@jektistravel.com">tourisme@jektistravel.com</a></p>
                    <p><strong>Email (Outgoing) :</strong><br> <a href="mailto:sales@jektistravel.com">sales@jektistravel.com</a></p>
                    <p><strong>Email (Groupes) :</strong><br> <a href="mailto:sales@jektistravel.com">sales@jektistravel.com</a></p>
                    <p><strong>Email (Billetterie) :</strong><br> <a href="mailto:billetterie@jektistravel.com">billetterie@jektistravel.com</a></p>
                    <p><strong>Email (M.I.C.E) :</strong><br> <a href="mailto:sales@jektistravel.com">sales@jektistravel.com</a></p>
                    <p><strong>Email (Finance) :</strong><br> <a href="mailto:finance@jektistravel.com">finance@jektistravel.com</a></p>
                    <p><strong>Email (Ressources Humaines) :</strong><br> <a href="mailto:sales@jektistravel.com">sales@jektistravel.com</a></p>
                </div>

            </div>

            <!-- Contact Form -->
            <div class="contact-form">
                <h3>Formulaire de Contact</h3>
                <form method="post">
                    <div class="form-group">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-control" id="nom" name="nom" required>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Téléphone:</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone">
                    </div>
                    <div class="form-group">
                        <label for="objet">Objet:</label>
                        <input type="text" class="form-control" id="objet" name="objet" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div>
        </div>
        <br>
        <?php include 'footer.php' ?>
        <!-- Bootstrap JS and dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>