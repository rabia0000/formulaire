
<?php

class Enterprise
{


    /**
     * Methode permettant de rentrer une entreprise 
     * @param int $enterpriseId Id unique de l'entreprise lors de l'inscription 
     * @param string $name Nom de l'entreprise 
     * @param string $email Email de l'entreprise
     * @param int $siret numero de siret de l'enntreprise 
     * @param string $adress adresse de l'entreprise 
     * @param string $password Password de l'entreprise 
     * @param int $codePostal code postal de l'entreprise 
     * @param string $ville ville de l'entreprise
     * @param string $photo photo de l'entreprise 
     * 
     * @return void
     */


    public static function create(string $name, string $email, int $siret, string $adress, string $password, int $codePostal, string $ville, string $photo)
    {
        //connexion à la bdd
        //on crée un nouvelle objet $bdd selon la classe PDO qui prendra des données 

        //mettre le nom de la base de donnnées lors de la creation d'un utilisateur initialement crée sur phpMyAdmin
        // Dans dbname nom de la base de données, user = admin et password = admin 

        $bdd = new PDO('mysql:host=localhost;dbname=' . DBNAME . ';charset=utf8', DBUSERNAME, DBPASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




        //  value (:value = marqueur nominatif)
        $sql = 'INSERT INTO `enterprise` ( `enterprise_name`, `enterprise_email`, `enterprise_siret`, `enterprise_adress`, `enterprise_password`, `enterprise_zipcode`, `enterprise_city`, `enterprise_photo`) VALUES (:nom, :email, :siret, :adress, :password, :code, :city, :photo)';
        //je prepare ma requete pour eviter les injection sql,  $bdd appelle la methode prepare 
        $query = $bdd->prepare($sql);
        //avec bindValue permet de mettre directement des valeurs sans crée de variable 

        $query->bindValue(':nom', htmlspecialchars($name), PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);
        $query->bindValue(':siret', $siret, PDO::PARAM_INT);
        $query->bindValue(':adress', $adress, PDO::PARAM_STR);
        $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $query->bindValue(':code', $codePostal, PDO::PARAM_INT);
        $query->bindValue(':city', $ville, PDO::PARAM_STR);
        $query->bindValue(':photo', $photo, PDO::PARAM_STR);


        try {
            $query->execute();
            echo 'Entreprise ajouté avec succès !';
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Methode permettant de vérifier si le mail existe dans la base de données de la table Enterprise
     * 
     * @param string $email Adresse mail de l'entreprise
     * 
     * @return bool
     */
    public static function checkMailExists(string $email): bool
    {
        // le try and catch permet de gérer les erreurs, nous allons l'utiliser pour gérer les erreurs liées à la base de données
        try {
            // Création d'un objet $db selon la classe PDO
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `enterprise` WHERE `enterprise_email` = :email";

            // je prepare ma requête pour éviter les injections SQL
            $query = $bdd->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':email', $email, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on vérifie si le résultat est vide car si c'est le cas, cela veut dire que le mail n'existe pas
            if (empty($result)) {
                return false;
            } else {
                return true;
            }
        } catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
            die();
        }
    }
}





?>
