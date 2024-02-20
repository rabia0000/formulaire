<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Tableau de Bord</title>
    <!-- Materialize CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
        .background-nav {
            background-image: url('../assets/img/montage.jpg');
            /* Remplacez chemin_vers_votre_image.jpg par le chemin réel de votre image */
            background-size: cover;
            /* Couvre toute la barre de nav sans perdre les proportions */
            background-position: center;
            /* Centre l'image dans la barre de navigation */
        }

        .side-nav {
            width: 16rem;
        }

        .image {
            width: 10rem;
            height: 10rem;
        }
    </style>
</head>


<body>
    <nav>
        <div class="nav-wrapper background-nav" style="display: flex; justify-content: flex-end;">
            <a class="waves-effect waves-light btn blue" href="../controllers/controller-users.php"><i class="material-icons left"></i>Utilisateur</a>
            <a class="waves-effect waves-light btn red" href="../controllers/controller-deconnexion.php"><i class="material-icons left"></i>Déconnexion</a>
        </div>
    </nav>

    </nav>
    <!-- barre de navigation laterale gauche  -->
    <div class="row black ">
        <div class="col s12 m4 l2">
            <ul id="slide-out" class="sidenav sidenav-fixed grey darken-3 side-nav">
                <li class="white-text center-align"> Coordonnée de l'entreprise : </li>
                <li class="white-text"> Nom : <?= $_SESSION['enterprise']['enterprise_name'] ?></li>
                <li class="white-text">Email : <?= $_SESSION['enterprise']['enterprise_email'] ?></li>
                <li class="white-text">Siret :<?= $_SESSION['enterprise']['enterprise_siret']  ?></li>
                <li class="white-text">Adresse : <?= $_SESSION['enterprise']['enterprise_adress']  ?></li>
                <li class="white-text">code postal : <?= $_SESSION['enterprise']['enterprise_zipcode']  ?></li>
                <li class="white-text">Ville : <?= $_SESSION['enterprise']['enterprise_city']  ?> </li>
            </ul>
        </div>


        <div class="col center-align offset-l2"> <!-- Contenu principal -->
            <h4 class='white-text'>Bienvenue sur votre tableau de bord</h4>

            <!-- Carte 1 -->
            <div class="row">
                <div class="col s4 ">
                    <div class="card blue darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Total des utilisateurs</span>
                            <p class='flow-text'> <?= $nbTotalUtilisateur ?></p>
                        </div>
                        <div class="card-action">
                            <a href="#">Voir plus</a>

                        </div>
                    </div>
                </div>

                <!-- Carte 2 -->
                <div class="col s4 ">
                    <div class="card deep-purple darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Total des utilisateurs actif</span>
                            <p class='flow-text'> <?= $nbTotalUtilisateurActif ?></p>
                        </div>
                        <div class="card-action">
                            <a href="#">Détails</a>
                        </div>
                    </div>
                </div>
                <!-- Carte 3 -->
                <div class="col s4 ">
                    <div class="card purple darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Total des trajets</span>
                            <p class='flow-text'> <?= $nbTotalRide ?></p>
                        </div>
                        <div class="card-action">
                            <a href="#">Détails</a>
                        </div>
                    </div>
                </div>
                <!-- 
                carte 4  -->

                <div class="col s6 ">
                    <div class="card teal darken-1">
                        <div class="card-content white-text">
                            <span class="card-title">Les 5 derniers utilisateurs avec comme infos : </span>
                            <?php foreach ($displayUsertotal as $user) : ?>
                                <div>
                                    <img class="image" src="http://afpaform.test/assets/photo/<?= $user['user_photo'] ?>" alt="User Photo">
                                    <?= $user['user_pseudo'] ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-action">
                            <a href="#">Détails</a>
                        </div>
                    </div>
                </div>
                <div class="col s6 ">
                    <div class="card brown">
                        <div class="card-content white-text">
                            <span class="card-title">Stats Hebdo (a venir)</span>
                            <p>A venir...</p>
                        </div>
                        <div class="card-action">
                            <a href="#">Détails</a>
                        </div>
                    </div>
                </div>
                <div class="col s12 ">
                    <div class="card light-blue darken-4">
                        <div class="card-content white-text">
                            <span class="card-title">Total des 5 derniers trajets</span>
                            <?php foreach ($displaytotalride as $ride) : ?>
                                <div>
                                    <p class="flow-text"> <?= '<strong> UTILISATEUR : </strong> ' ?><?php echo $ride['user_name']; ?> <?= '<strong> DATE : </strong> ' ?> <?php echo $ride['ride_date']; ?> <?= '<strong> DISTANCE : </strong> ' ?> <?= $ride['ride_distance'] ?> <?= " km" ?> </p>
                                    <hr>

                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="card-action">
                            <a href="#" class='white-text'>Détails</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>




    <!-- Materialize JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>