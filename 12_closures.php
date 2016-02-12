<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="Exemples POO en PHP - Poo avancée - Les closures - PHP-POO OpenClassrooms et PHP Manual - Adaptation Christophe Malo">
        <meta name="keywords" content="POO, PHP, Bootstrap, generateurs">
        <meta name="author" content="Christophe Malo">

        <title>POO avancée en PHP - Les closures</title>

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
        <div class="container">
            <section class="row">
                <h1 class="text-center">POO avancée en PHP - Les closures</h1>
                <p>Un moyen de créer des fonctions à la volée - fonctions anonymes</p>
                <p>Utilisées en tant que fonctions de rappels</p>
                
                <!-- Les closures
                ================================================== -->
                <h2>Création de closures</h2>
                <p class="col-sm-12">
                <?php
                // Déclaration d'un closure (fonction anonyme)
                function() { // N'affiche rien - pas d'intérêt
                    echo 'Hello world !';
                };
                
                $maFonction = function() {
                    echo '<p>Hello world2 !</p>';
                };
                
                var_dump($maFonction); // Retourne un objet de type closure
                
                $maFonction(); // Retourne Hello world2 !
                
                
                // Exemple d'utilisation
                $addition = function($nombre) {
                    return $nombre + 5;
                };
                
                $listeNombres = [1, 2, 3, 4, 5];
                
                var_dump($listeNombres);
                echo '<br>';
                
                $listeNombres = array_map($addition, $listeNombres);
                
                var_dump($listeNombres);
                echo '<br>';
                
                
                // Utilisation de variables extérieures
                // La variable ne peut être modifiée par la suite
                // car importée dans la closure dès la crétation
                $quantite = 5;
                $additionneur = function($nbr) use($quantite) {
                    return $nbr + $quantite;
                };

                $listeNbr = [1, 2, 3, 4, 5];

                $listeNbr = array_map($additionneur, $listeNbr);

                var_dump($listeNbr); // retroune le tableau [6, 7, 8, 9, 10]
                echo '<br>';
                
                // Donc ce code suivant n'est pas possible - erreur de calcul
//                $quantite = 5;
//                $additionneur = function($nbr) use($quantite)
//                {
//                  return $nbr + $quantite;
//                };
//
//                $listeNbr = [1, 2, 3, 4, 5];
//
//                $listeNbr = array_map($additionneur, $listeNbr);
//                var_dump($listeNbr);
//                // On a : $listeNbr = [6, 7, 8, 9, 10]
//
//                $quantite = 4;
//
//                $listeNbr = array_map($additionneur, $listeNbr);
//                var_dump($listeNbr);
//                // On a : $listeNbr = [11, 12, 13, 14, 15] au lieu de [10, 11, 12, 13, 14]
                
                
                // Il faut procéder par le passage par une fonction avec 1 argument
                function creerAdditionneur($quantite) {
                    return function($nbr) use($quantite) {
                        return $nbr + $quantite;
                    };
                }

                $listeNbr2 = [1, 2, 3, 4, 5];

                $listeNbr2 = array_map(creerAdditionneur(5), $listeNbr2);
                var_dump($listeNbr2);
                // Retourne $listeNbr2 = [6, 7, 8, 9, 10]
                echo '<br>';

                $listeNbr2 = array_map(creerAdditionneur(4), $listeNbr2);
                var_dump($listeNbr2);
                // Retourne $listeNbr = [10, 11, 12, 13, 14]
                echo '<br>';
                ?>
                </p>
                
                
                <h2>Lier une closure à un objet</h2>
                <p class="col-sm-12">
                <?php
                $additionneur2 = function() {
                    $this->_nbr += 5;
                };

                class MaClasse {

                    private $_nbr = 0;

                    public function nbr() {
                        return $this->_nbr;
                    }

                }

                $obj = new MaClasse;

                // On obtient une copie de notre closure qui sera liée à notre objet $obj
                // Cette nouvelle closure sera appelée en tant que méthode de MaClasse
                // On aurait tout aussi bien pu passer $obj en second argument
                $additionneur2 = $additionneur2->bindTo($obj, 'MaClasse');
                $additionneur2();

                echo $obj->nbr(); // Affiche bien 5
                echo '<br>';
                ?>
                </p>
                
                
                <h2>Lier une closure à une classe</h2>
                <p class="col-sm-12">
                <?php 
                // Nous déclarons ici une closure statique
                $additionneur3 = static function() {
                    self::$_nbr += 5;
                };

                class MaClasse3 {

                    private static $_nbr = 0;

                    public static function nbr3() {
                        return self::$_nbr;
                    }

                }

                $additionneur3 = $additionneur3->bindTo(null, 'MaClasse3');
                $additionneur3();

                echo MaClasse3::nbr3();
                echo '<br>';
                ?>
                </p>
                
                
                <h2>Liaisons automatiques - Méthode non statique</h2>
                <p class="col-sm-12">
                <?php
                // Méthode non statique
                class MaClasse4 {

                    private $_nbr = 0;

                    public function getAdditionneur4() {
                        return function() {
                            $this->_nbr += 5;
                        };
                    }

                    public function nbr() {
                        return $this->_nbr;
                    }

                }

                $obj4 = new MaClasse4;

                $additionneur4 = $obj4->getAdditionneur4();
                $additionneur4();

                echo $obj4->nbr();
                // Affiche bien 5 car notre closure est bien liée à $obj depuis MaClasse4
                echo '<br>';
                ?>
                </p>
                
                
                <h2>Liaisons automatiques - Contexte statique</h2>
                <p class="col-sm-12">
                <?php
                // Méthode non statique
                class MaClasse5 {

                    private static $_nbr = 0;

                    public static function getAdditionneur5() {
                        return function() {
                            self::$_nbr += 5;
                        };
                    }

                    public static function nbr() {
                        return self::$_nbr;
                    }

                }

                $additionneur5 = MaClasse5::getAdditionneur5();
                $additionneur5();

                echo MaClasse5::nbr(); // Affiche bien 5
                echo '<br>';
                ?>
                </p>
                
                
                <h2>Implémentation du pattern Observer</h2>
                <p class="col-sm-12">
                <?php
                // La classe observée
                class Observed implements SplSubject {

                    protected $name;
                    protected $observers = [];

                    public function attach(SplObserver $observer) {
                        $this->observers[] = $observer;
                        return $this;
                    }

                    public function detach(SplObserver $observer) {
                        if (is_int($key = array_search($observer, $this->observers, true))) {
                            unset($this->observers[$key]);
                        }
                    }

                    public function notify() {
                        foreach ($this->observers as $observer) {
                            $observer->update($this);
                        }
                    }

                    public function name() {
                        return $this->name;
                    }

                    public function setName($name) {
                        $this->name = $name;
                        $this->notify();
                    }

                }
                
                // La classe Observateur dont les objets seront des instances
                class Observer implements SplObserver {

                    protected $name;
                    protected $closure;

                    public function __construct(Closure $closure, $name) {
                        // On lie la closure à l'objet actuel et on lui spécifie le contexte à utiliser
                        // (Ici, il s'agit du même contexte que $this)
                        $this->closure = $closure->bindTo($this, $this);
                        $this->name = $name;
                    }

                    public function update(SplSubject $subject) {
                        // En cas de notification, on récupère la closure et on l'appelle
                        $closure = $this->closure;
                        $closure($subject);
                    }

                }
                
                
                // Tester le code
                $o = new Observed;

                $observer1 = function(SplSubject $subject) {
                    echo '<p>' . $this->name . ' a été notifié ! Nouvelle valeur de name : ' . $subject->name() . '</p>';
                };

                $observer2 = function(SplSubject $subject) {
                    echo '<p>' . $this->name . ' a été notifié ! Nouvelle valeur de name : ' . $subject->name() . '</p>';
                };

                $o->attach(new Observer($observer1, 'Observer1'))
                        ->attach(new Observer($observer2, 'Observer2'));

                $o->setName('Christophe');
                // Ce qui affiche :
                // Observer1 a été notifié ! Nouvelle valeur de name : Christophe
                // Observer2 a été notifié ! Nouvelle valeur de name : Christophe
                ?>
                </p>
            </section>
        </div>
    </body>
</html>