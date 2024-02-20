<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs</title>
    <!-- Lien vers Materialize CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">
    <style>
        .user-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-photo {
            margin-right: 15px;
            width: 50px;
            /* Ajustez selon le besoin */
            height: 50px;
            /* Ajustez selon le besoin */
            border-radius: 50%;
            /* Pour rendre l'image ronde */
        }

        .action-buttons {
            display: flex;
            align-items: center;
        }

        .action-buttons>button {
            margin-left: 10px;
            /* Espace entre les boutons */
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card teal darken-1">
            <div class="card-content white-text">
                <span class="card-title">Affichage de tout les utilisateur de l'entreprise :</span>
                <?php foreach ($displayUsertotale as $user) : ?>
                    <div class="user-card">
                        <div class="user-info">
                            <img class="user-photo" src="http://afpaform.test/assets/photo/<?= $user['user_photo'] ?>" alt="User Photo">
                            <span><?= htmlspecialchars($user['user_pseudo']) ?></span>
                        </div>
                        <div class="action-buttons">
                            <div class="switch">
                                <label>
                                    Off
                                    <input type="checkbox" class="blockSwitch" data-user-id="<?= $user['user_id'] ?>"> <?= $user['user_validate'] == 1 ? 'checked' : '' ?>>
                                    <span class=" lever"></span>
                                    On
                                </label>
                            </div>
                            <!-- Boutons Valider et Non Valider -->
                            <!-- on cree la variable VALIDATE qui pointe vers notre controller ajax -->
                            <!-- <a href="controller-ajax.php?validate=<?= $user['user_id'] ?>">
                                <button class="btn green">Valider</button>
                            </a>

                            <a href="controller-ajax.php?unvalidate=<?= $user['user_id'] ?>">
                                <button class="btn red">unvalidate</button>

                            </a> -->
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Lien vers Materialize JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        document.addEventListener('click', e => {


            if (e.target.checked == false) {
                console.log('unvalidate');
                fetch(`controller-ajax.php?unvalidate=${e.target.dataset.userId}`)
            } else {
                console.log('validate');
                fetch(`controller-ajax.php?validate=${e.target.dataset.userId}`)
            }



        })
    </script>
</body>

</html>