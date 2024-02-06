<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <title>Sign in</title>

    <style>
        /* Définir la hauteur de la page pour centrer le contenu */
        html,
        body {
            height: 100%;
            font-family: 'Josefin Sans', sans-serif;
        }

        /* Centrer le contenu verticalement */
        body {
            background-image: url('../assets/img/fond.jpg');
            background-repeat: no-reapet;
            background-repeat: no-repeat;
            background-size: cover;
            /* Fait en sorte que l'image couvre entièrement l'élément */
            background-position: center;

        }


        .container {
            display: flex;
            justify-content: center;
            /* Centre horizontalement */
            align-items: center;
            /* Centre verticalement */
            height: 100vh;
            /* Hauteur du conteneur (par exemple, toute la hauteur de la vue) */

        }

        .card {
            background-color: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body>

    <form class="row" method="POST" action="../controllers/controller-signin.php" novalidate>
        <div class="container">
            <div class="row">
                <div class="card col s12">
                    <h2 class="center-align indigo-text text-darken-4">PAGE DE CONNEXION</h2>
                    <div class="center-align indigo-text ">
                        <label class="flow-text indigo-text" for="email">Votre Email:</label><br>

                        <input class="flow-text" type="email" id="email" name="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" required>
                        <span class="error">
                            <?php if (isset($errors['email'])) {
                                echo $errors['email'];
                            } ?>


                            <label class="flow-text indigo-text" for="password">Mot de passe:</label><br>
                            <input type="password" id="password" name="password">
                            <span class="error text-danger">
                                <?php if (isset($errors['password'])) {
                                    echo $errors['password'];
                                } ?>
                            </span><br>
                            <br>

                        </span><br>


                        <div class=" ">
                            <input type="submit" value="Me connecter" class="waves-effect waves-light blue accent-3 btn-large ">
                        </div>
                        <br>
                        <div class=''>
                            <a href="../controllers/controller-signup.php">
                                <button type="button" class="waves-effect waves-light blue accent-3 btn-large">Pas encore inscrit ?</button>
                            </a>
                        </div>



                    </div>
                </div>
            </div>

        </div>



        <!-- EMAIL  -->




        <!-- MOTS DE PASSE -->






</body>

</html>