<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">

    <title>Document</title>
    <style>
        /* Définir la hauteur de la page pour centrer le contenu */
        html,
        body {
            height: 100%;
        }

        /* Centrer le contenu verticalement */
        body {
            /* display: flex;
            align-items: center;
            justify-content: center; */
            font-family: 'Josefin Sans', sans-serif;
            background-image: url('../assets/img/table.jpg');
            background-repeat: no-reapet;
            background-repeat: no-repeat;
            background-size: cover;
            /* Fait en sorte que l'image couvre entièrement l'élément */
            background-position: center;


        }

        .card {
            background-color: rgba(212, 228, 188, 0.13);
        }



        .error {
            color: red;
        }

        .captcha {
            margin: 0 auto;
            width: max-content;
        }
    </style>
</head>

<body class="">

    </div>
    <!-- Header -->

    <form class="row" method="POST" action="../controllers/controller-signup.php" novalidate>

        <div class="container ">
            <div class="row ">
                <?php if ($showform) { ?>
                    <div class="card col s12 center-align ">


                        <h2 class="center-align indigo-text text-darken-4">Inscription de l'entreprise</h2>

                        <form action="controller-signup.php" method="POST" novalidate>

                            <label class="flow-text indigo-text" for="nom">Nom :</label><br>
                            <input class="col-12" type="text" id="nom" name="name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>">

                            <span class="error helper-text">
                                <?php if (isset($errors['name'])) {
                                    echo $errors['name'];
                                } ?>
                            </span><br>

                            <label class="flow-text indigo-text" for="email">Email :</label><br>
                            <input class="col-12" type="email" id="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                            <span class="error">
                                <?php if (isset($errors['email'])) {
                                    echo $errors['email'];
                                } ?>
                            </span><br>


                            <label class="flow-text indigo-text" for="siret">Numero de siret:</label><br>
                            <input class="col-12" type="text" id="prenom" name="siret" value="<?= isset($_POST['siret']) ? htmlspecialchars($_POST['siret']) : '' ?>">
                            <span class="error">
                                <?php if (isset($errors['siret'])) {
                                    echo $errors['siret'];
                                } ?>
                            </span><br>


                            <label class="flow-text indigo-text" for="codePostal">Adresse:</label><br>
                            <input class="col-12" type="text" id="code" name="adress" value="<?= isset($_POST['adress']) ? htmlspecialchars($_POST['adress']) : '' ?>">

                            <span class="error ">
                                <?php if (isset($errors['adress'])) {
                                    echo $errors['adress'];
                                } ?>
                            </span><br>

                            <label class="flow-text indigo-text" for="codePostal">code postal:</label><br>
                            <input class="col-12" type="text" id="code" name="code" value="<?= isset($_POST['code']) ? htmlspecialchars($_POST['code']) : '' ?>">
                            <span class="error">
                                <?php if (isset($errors['code'])) {
                                    echo $errors['code'];
                                } ?>
                            </span><br>

                            <label class="flow-text indigo-text" for="codePostal">Ville:</label><br>
                            <input class="col-12" type="text" id="city" name="city" value="<?= isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '' ?>">
                            <span class="error">
                                <?php if (isset($errors['city'])) {
                                    echo $errors['city'];
                                } ?>
                            </span><br>


                            <label class="flow-text indigo-text" for="password">Mot de passe:</label><br>
                            <input class="col-12" type="password" id="password" name="password">
                            <span class="error text-danger">
                                <?php if (isset($errors['password'])) {
                                    echo $errors['password'];
                                } ?>
                            </span><br>

                            <label class="flow-text indigo-text" for="confirm_password">Confirmer le mot de passe:</label><br>
                            <input class="col-12" type="password" id="confirm_password" name="confirm_password">
                            <span class="error ">
                                <?php if (isset($errors['confirm_password'])) {
                                    echo $errors['confirm_password'];
                                } ?>
                            </span><br><br>


                            <div class="g-recaptcha captcha" data-sitekey="6Lc3bHApAAAAAN0iJ1XIGk3RMyRvnKDyw5X0L381"></div>
                            <span class="error ">
                                <?php if (isset($errors['g-recaptcha-response'])) {
                                    echo $errors['g-recaptcha-response'];
                                } ?>
                            </span>
                            <br>
                            <input type="submit" value="S'enregistrer" class="btn btn-dark mt-3 ">
                            <a href="../controllers/controller-signin.php" class="btn btn-dark mt-3">Déjà inscrit</a>



                            <br><br><br>



                        </form>
                    </div>


                <?php  } else { ?>
                    <div class="container">
                        <div class="d-flex justify-content-center align-items-center vh-100">
                            <div class="col-lg-4">
                                <div class="card shadow-lg">
                                    <div class="card-body text-center text-light ">


                                        <h2>Inscription réussie</h2>
                                        <p><strong><em>Vous pouvez maintenant vous connecter.</em></strong></p>

                                        <a href="../controllers/controller-signin.php" class="btn btn-success">
                                            Connexion</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php   } ?>

            </div>
        </div>
        </div>

        <!-- Footer -->
        <footer>
            <!-- Votre code pour le pied de page -->
        </footer>

        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>