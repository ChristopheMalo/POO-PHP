<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Exemples POO en PHP - basé sur le MOOC POO - PHP OpenClassrooms">
        <meta name="keywords" content="POO, PHP, Bootstrap">
        <meta name="author" content="Christophe Malo">
            
        <title>POO en PHP</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Section Contenu
        ================================================== -->
        <section class="container">

            <section class="row">
                <h1 class="text-center">Exemples POO - PHP</h1>
                <h2>Personnage</h2>
                <p class="col-sm-12">
                    <?php
                    /*
                     * require 'classes/Personnage.php';             // Inclure la classe
                     * OU
                     * Fonction auto-chargement de l'ensemble des classes du projet
                     * 
                     * La fonction charge toutes les classes nécessaire au projet
                     * si les classes sont placées dans le dossier classes
                     */
                    function chargerMaClasse($classe) {
                        require 'classes/' . $classe . '.php';
                    }
                    
                    spl_autoload_register('chargerMaClasse');
                    
                    //$perso1 = new Personnage(60, 0);                      // Création de l'objet Personnage - Création d'une instance de la classe Personnage
                    //$perso2 = new Personnage(100, 10);                    // Création d'un 2ème personnage
                    $perso1 = new Personnage(Personnage::FORCE_MOYENNE, 0); // Création de l'objet personnage gràace à une constante
                    $perso2 = new Personnage(Personnage::FORCE_GRANDE, 10); // Création d'un 2ème personnage
                    
                    //$perso1->setForce(10);
                    //$perso1->setExperience(2);
                    
                    //$perso2->setForce(90);
                    //$perso2->setExperience(58);
                    
                    //$perso1->parler();    // Appel de la méthode test parler()
                    Personnage::parler();   // Appel de la méthode statique parler()
                    
                    echo '<strong>Avant le combat :</strong><br>';
                    echo 'Le personnage 1 a ' . $perso1->experience() . ' d\'expérience<br>';
                    echo 'Le personnage 2 a ' . $perso2->experience() . ' d\'expérience<br>';
                    echo 'Le personnage 1 a ' . $perso1->force() . ' de force et le personnage 2 a ' . $perso2->force() . ' de force.<br>';
                   
                    
                    echo '<strong>Le combat démarre...</strong><br>';
                    echo 'Le personnage 1 frappe le personnage 2...<br>';
                    echo 'Le personnage 1 gagne de l\'expérience...<br>';
                    
                    $perso1->frapper($perso2);                      // Le personnage 1 frappe le personnage 2
                    $perso1->gagnerExperience();                    // Le personnage 1 gagne de l'expérience
                    
                    echo 'Le personnage 2 frappe le personnage 1...<br>';
                    echo 'Le personnage 2 gagne de l\'expérience...<br>';
                    
                    $perso2->frapper($perso1);                      // Le personnage 2 frappe le personnage 1
                    $perso2->gagnerExperience();                    // Le personnage 2 gagne de l'expérience
                    
                    echo '<strong>Après le combat :</strong><br>';
                    echo 'Le personnage 1 a ' . $perso1->experience() . ' d\'expérience et le personnage 2 a ' . $perso2->experience() . ' d\'expérience.<br />';
                    echo 'Le personnage 1 a ' . $perso1->degats() . ' de dégâts contrairement au personnage 2 qui a ' . $perso2->degats() . ' de dégâts.<br>';
                    ?>
                </p>
                <h2>Compteur</h2>
                <p>
                    <?php
                    // Instanciation de 3 tests compteur
                    $test1 = new Compteur;
                    $test2 = new Compteur;
                    $test3 = new Compteur;
                    
                    echo 'La classe est instanciée : ' . Compteur::getCompteur() . ' fois.';
                    ?>
                </p>
                <h2>Manipuler les données d'une BDD</h2>
                <p>
                    <?php
                    include_once 'configuration/configurationPDO.php';
                    $req = $bdd->query('SELECT id, nom, forcePerso, degats, niveau, experience
                                          FROM PersonnagesTable');
                    
                    // Afficher chaque donnée des personnages dans un array
                    while ($datas = $req->fetch(PDO::FETCH_ASSOC)) {
                        $perso = new PersonnageTable($datas);
                        
                        echo '<pre>';
                            print_r($datas);
                            print_r($perso);
                        echo '</pre>';
                        
                        echo $perso->getNom() . ' a ' .
                             $perso->getForcePerso() . ' de force, ' .
                             $perso->getDegats() . ' de dégâts, ' .
                             $perso->getExperience() . ' d\'expérience et est au niveau ' .
                             $perso->getNiveau();
                    }
                    ?>
                </p>
            </section>

        </section>
    </body>
</html>
