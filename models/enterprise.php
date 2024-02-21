
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
        $query->bindValue(':siret', $siret, PDO::PARAM_STR);
        $query->bindValue(':adress', $adress, PDO::PARAM_STR);
        $query->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $query->bindValue(':code', $codePostal, PDO::PARAM_STR);
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
     * Methode permettant de vérifier si le numero de siret existe dans la base de données de la table Enterprise
     * 
     * @param string $siret de l'entreprise
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

    /**
     * Methode permettant de vérifier si le numero de siret existe dans la base de données de la table Enterprise
     * 
     * @param string $siret siret de l'entreprise
     * 
     * @return bool
     */
    public static function checkSiretExist(string $siret): bool
    {
        // le try and catch permet de gérer les erreurs, nous allons l'utiliser pour gérer les erreurs liées à la base de données
        try {
            // Création d'un objet $db selon la classe PDO
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `enterprise` WHERE `enterprise_siret` = :siret";

            // je prepare ma requête pour éviter les injections SQL
            $query = $bdd->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':siret', $siret, PDO::PARAM_STR);

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


    /**
     * Methode permettant de vérifier si le nom existe deja dans la base de données de la table Enterprise
     * 
     * @param string $siret siret de l'entreprise
     * 
     * @return bool
     */
    public static function checkNameExits(string $name): bool
    {
        // le try and catch permet de gérer les erreurs, nous allons l'utiliser pour gérer les erreurs liées à la base de données
        try {
            // Création d'un objet $db selon la classe PDO
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `enterprise` WHERE `enterprise_name` = :nom";

            // je prepare ma requête pour éviter les injections SQL
            $query = $bdd->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':nom', $name, PDO::PARAM_STR);

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
    /**
     * Methode permettant de récupérer les infos d'une entreprise avec son mail comme paramètre
     * 
     * @param string $email Adresse mail de l'entreprise
     * 
     * @return string Tableau associatif contenant les infos de l'entreprise
     */
    public static function getInfos(string $email): string
    {
        try {
            // Création d'un objet $bdd selon la classe PDO
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM `enterprise` WHERE `enterprise_email` = :mail";

            // je prepare ma requête pour éviter les injections SQL
            $query = $bdd->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':mail', $email, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);

            // on retourne un JSON avec le status succes et les données récuperées, ou un tableau vide si aucun resultat 
            return json_encode([
                'status' => 'success',
                'data' => $result ?? [] // si aucun resultat return un tableau vide
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'status' => 'error',
                'message' => 'Erreur : ' . $e->getMessage()

            ]);
        }
    }
    /**
     * Methode permettant de récupérer le nombre total d'utilisateur appartenant a l'entreprise avec entreprise_id comme paramètre
     * 
     * @param int $enterprise_id  id de l'entreprise
     * 
  
     */
    public static function countUser(int $enterprise_id)
    {
        try {
            // Création d'un objet $bdd selon la classe PDO
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT COUNT(user_id) AS user_count FROM userprofil WHERE enterprise_id = :enterprise_id";

            // je prepare ma requête pour éviter les injections SQL
            $query = $bdd->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':enterprise_id', $enterprise_id, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);
            // var_dump($result);
            // on retourne un JSON avec le status succes et les données récuperées, ou un tableau vide si aucun resultat 
            return json_encode([
                'status' => 'success',
                'data' => $result ?? [] // si aucun resultat return un tableau vide
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'status' => 'error',
                'message' => 'Erreur : ' . $e->getMessage()

            ]);
        }
    }


    public static function countActifUser(int $enterprise_id)
    {
        try {
            // Création d'un objet $bdd selon la classe PDO
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT COUNT(DISTINCT userprofil.user_id) AS user_count FROM userprofil INNER JOIN ride ON userprofil.user_id = ride.user_id WHERE userprofil.enterprise_id = :enterprise_id";

            // je prepare ma requête pour éviter les injections SQL
            $query = $bdd->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':enterprise_id', $enterprise_id, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);
            // var_dump($result);
            // on retourne un JSON avec le status succes et les données récuperées, ou un tableau vide si aucun resultat 
            return json_encode([
                'status' => 'success',
                'data' => $result ?? [] // si aucun resultat return un tableau vide
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'status' => 'error',
                'message' => 'Erreur : ' . $e->getMessage()

            ]);
        }
    }

    public static function countTotalRide(int $enterprise_id)
    {
        try {
            // Création d'un objet $bdd selon la classe PDO
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT COUNT(DISTINCT userprofil.user_id) AS total_ride FROM ride INNER JOIN userprofil WHERE enterprise_id = :enterprise_id";

            // je prepare ma requête pour éviter les injections SQL
            $query = $bdd->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':enterprise_id', $enterprise_id, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);
            // var_dump($result);
            // on retourne un JSON avec le status succes et les données récuperées, ou un tableau vide si aucun resultat 
            return json_encode([
                'status' => 'success',
                'data' => $result['total_ride'] ?? [] // si aucun resultat return un tableau vide
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'status' => 'error',
                'message' => 'Erreur : ' . $e->getMessage()

            ]);
        }
    }

    public static function displayLastUser(int $enterprise_id)
    {
        try {
            // Création d'un objet $bdd selon la classe PDO
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT user_photo, user_pseudo FROM userprofil 
            WHERE enterprise_id = :enterprise_id
            ORDER BY user_id DESC LIMIT 5";

            // je prepare ma requête pour éviter les injections SQL
            $query = $bdd->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':enterprise_id', $enterprise_id, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($result);
            // on retourne un JSON avec le status succes et les données récuperées, ou un tableau vide si aucun resultat 
            return json_encode([
                'status' => 'success',
                'data' => $result ?? [] // si aucun resultat return un tableau vide
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'status' => 'error',
                'message' => 'Erreur : ' . $e->getMessage()

            ]);
        }
    }
    public static function displayLastFiveRides(int $enterprise_id)
    {
        try {
            // Création d'un objet $bdd selon la classe PDO
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT ride_date, ride_distance, user_name, enterprise_id FROM ride INNER JOIN userprofil WHERE enterprise_id = :enterprise_id ORDER BY ride_id DESC LIMIT 5";

            // je prepare ma requête pour éviter les injections SQL
            $query = $bdd->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':enterprise_id', $enterprise_id, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            // on retourne un JSON avec le status succes et les données récuperées, ou un tableau vide si aucun resultat 
            return json_encode([
                'status' => 'success',
                'data' => $result ?? [] // si aucun resultat return un tableau vide
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'status' => 'error',
                'message' => 'Erreur : ' . $e->getMessage()

            ]);
        }
    }
    public static function totalUser(int $enterprise_id)
    {
        try {
            // Création d'un objet $bdd selon la classe PDO
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            // stockage de ma requete dans une variable
            $sql = "SELECT * FROM userprofil 
            WHERE enterprise_id = :enterprise_id
            ORDER BY user_id";

            // je prepare ma requête pour éviter les injections SQL
            $query = $bdd->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':enterprise_id', $enterprise_id, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($result);
            // on retourne un JSON avec le status succes et les données récuperées, ou un tableau vide si aucun resultat 
            return json_encode([
                'status' => 'success',
                'data' => $result ?? [] // si aucun resultat return un tableau vide
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'status' => 'error',
                'message' => 'Erreur : ' . $e->getMessage()

            ]);
        }
    }



    //cree une methode pour validate
    /**
     * Methode qui permet de bloquer un utilisateur 
     * @param INT $userId id de l'utilisateur 
     * @return Boolean 
     * 
     * 
     */

    public static function unvalidate(int $userId): bool
    {
        try {
            // Création d'un objet $bdd selon la classe PDO
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);


            $sql = "UPDATE `userprofil` SET `user_validate` = 0 WHERE `user_id` = :user_id";
            //eviter de faire des injection sql 'prepare'
            $query = $bdd->prepare($sql);
            // permet d'accepter que des integer BindValue
            $query->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $query->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    /**
     * Methode qui permet valider/debloquer un utilisateur
     *   
     * @param INT $userId recupere l'id de l'utilisateur
     * 
     * @return BOOL 
     */
    public static function validate(INT $userId): bool
    {
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            $sql = "UPDATE userprofil SET user_validate = 1 WHERE user_id = :user_id";
            $query = $bdd->prepare($sql);
            $query->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $query->execute();

            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Methode qui affiche tout les infos de l'utilisateur selon son id
     * @param INT $userId recupere l'id de l'utilisateur
     */

    public static function displayUser(INT $userId)
    {
        // Création d'un objet $bdd selon la classe PDO

        try {
            $bdd = new PDO("mysql:host=localhost;dbname=" . DBNAME, DBUSERNAME, DBPASSWORD);

            $sql = "SELECT * FROM `userprofil` WHERE `user_id` = :user_id";

            // je prepare ma requête pour éviter les injections SQL
            $query = $bdd->prepare($sql);

            // on relie les paramètres à nos marqueurs nominatifs à l'aide d'un bindValue
            $query->bindValue(':user_id', $userId, PDO::PARAM_STR);

            // on execute la requête
            $query->execute();

            // on récupère le résultat de la requête dans une variable
            $result = $query->fetch(PDO::FETCH_ASSOC);
            // var_dump($result);
            // on retourne un JSON avec le status succes et les données récuperées, ou un tableau vide si aucun resultat 
            return json_encode([
                'status' => 'success',
                'data' => $result ?? [] // si aucun resultat return un tableau vide
            ]);
        } catch (PDOException $e) {
            return json_encode([
                'status' => 'error',
                'message' => 'Erreur : ' . $e->getMessage()

            ]);
        }
    }
}
