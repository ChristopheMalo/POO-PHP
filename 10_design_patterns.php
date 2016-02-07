<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Exemples POO en PHP - Poo avancée - Les design patterns - PHP-POO OpenClassrooms et PHP Manual - Adaptation Christophe Malo">
        <meta name="keywords" content="POO, PHP, Bootstrap, Résolution statique">
        <meta name="author" content="Christophe Malo">
            
        <title>POO avancée en PHP - Les design patterns</title>

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
                <h1 class="text-center">POO avancée en PHP - Les design patterns</h1>
                <p>Un design pattern est un moyen de conception répondant à un problème récurrent.</p>
                <p>Le pattern factory a pour but de laisser des classes usine créer les instances à votre place.</p>
                <p>Le pattern observer permet de lier certains objets à des « écouteurs » eux-mêmes chargés de notifier les objets auxquels ils sont rattachés.</p>
                <p>Le pattern strategy sert à délocaliser la partie algorithmique d'une méthode afin de le permettre réutilisable, évitant ainsi la duplication de cet algorithme.</p>
                <p>Le pattern singleton permet de pouvoir instancier une classe une seule et unique fois, ce qui présente quelques soucis au niveau des dépendances entre classes.</p>
                <p>Le pattern injection de dépendances a pour but de rendre le plus indépendantes possible les classes.</p>
                <!-- Pattern Factory
                ================================================== -->
                <h2>Le pattern Factory</h2>
                <p>Grâce à ce pattern, terminés les soucis d'instanciations de classes</p>
                <p class="col-sm-12">
                    <?php
                    class DBFactory {

                        public static function load($sgbdr) {
                            $classe = 'SGBDR_' . $sgbdr;

                            if (file_exists($chemin = $classe . '.class.php')) {
                                require $chemin;
                                return new $classe;
                            } else {
                                throw new RuntimeException('La classe <strong>' . $classe . '</strong> n\'a pu être trouvée !');
                            }
                        }

                    }
                    ?>
                    
                    <?php // Utilisation dans un script
                    try {
                        $mysql = DBFactory::load('MySQL');
                    } catch (RuntimeException $e) {
                        echo $e->getMessage();
                    }
                    ?>
                </p>
                
                
                <p<strong>Un exemple concret :</strong> créer une classe qui va distribuer les objets PDO facilement. Plusieurs BDD avec différents identifiants. Il faut centraliser l'ensemble dans une classe</p>
                <p class="col-sm-12">
                    <?php
                    class PDOFactory {

                        public static function getMysqlConnexion() {
                            $db = new PDO('mysql:host=localhost;dbname=tests', 'root', '');
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            return $db;
                        }

                        public static function getPgsqlConnexion() {
                            $db = new PDO('pgsql:host=localhost;dbname=tests', 'root', '');
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            return $db;
                        }

                    }
                    ?>
                </p>
                
                
                <!-- Pattern Observer
                ================================================== -->
                <h2>Le pattern Observer</h2>
                <p>Écouter les objets</p>
                <p class="col-sm-12">
                    <?php
                    // Classe dont seront issus les objets observés
                    class Observee implements SplSubject {

                        // Ceci est le tableau qui va contenir tous les objets qui nous observent.
                        protected $observers = [];
                        // Dès que cet attribut changera on notifiera les classes observatrices.
                        protected $nom;

                        public function attach(SplObserver $observer) {
                            $this->observers[] = $observer;
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

                        public function getNom() {
                            return $this->nom;
                        }

                        public function setNom($nom) {
                            $this->nom = $nom;
                            $this->notify();
                        }

                    }
                    
                    // 2 classes dont les objets issus seront observateurs
                    class Observer1 implements SplObserver {

                        public function update(SplSubject $obj) {
                            echo __CLASS__, ' a été notifié ! Nouvelle valeur de l\'attribut <strong>nom</strong> : ', $obj->getNom();
                        }

                    }

                    class Observer2 implements SplObserver {

                        public function update(SplSubject $obj) {
                            echo __CLASS__, ' a été notifié ! Nouvelle valeur de l\'attribut <strong>nom</strong> : ', $obj->getNom();
                        }

                    }
                    
                    // Tester les classes
                    $o = new Observee;
                    $o->attach(new Observer1); // Ajout d'un observateur.
                    $o->attach(new Observer2); // Ajout d'un autre observateur.
                    $o->setNom('Victor'); // On modifie le nom pour voir si les classes observatrices ont bien été notifiées.
                    
                    // Autre méthode - rapide
//                    $o = new Observee;
//
//                    $o->attach(new Observer1)
//                      ->attach(new Observer2)
//                      ->attach(new Observer3)
//                      ->attach(new Observer4)
//                      ->attach(new Observer5);
//
//                    $o->setNom('Victor'); // On modifie le nom pour voir si les classes observatrices ont bien été notifiées.
                    
                    
                    ?>
                </p>
                
                <p><strong>Un exemple concret :</strong> intercepter les erreurs</p>
                <p class="col-sm-12">
                    <?php
                    // Dans le cadre d'un projet -> un fichier par classe - un autoloader de classe
                    // ErrorHandler : classe gérant les erreurs
                    class ErrorHandler implements SplSubject {

                        // Ceci est le tableau qui va contenir tous les objets qui nous observent.
                        protected $observers = [];
                        // Attribut qui va contenir notre erreur formatée.
                        protected $formatedError;

                        public function attach(SplObserver $observer) {
                            $this->observers[] = $observer;
                            return $this;
                        }

                        public function detach(SplObserver $observer) {
                            if (is_int($key = array_search($observer, $this->observers, true))) {
                                unset($this->observers[$key]);
                            }
                        }

                        public function getFormatedError() {
                            return $this->formatedError;
                        }

                        public function notify() {
                            foreach ($this->observers as $observer) {
                                $observer->update($this);
                            }
                        }

                        public function error($errno, $errstr, $errfile, $errline) {
                            $this->formatedError = '[' . $errno . '] ' . $errstr . "\n" . 'Fichier : ' . $errfile . ' (ligne ' . $errline . ')';
                            $this->notify();
                        }

                    }
                    
                    
                    // MailSender : classe s'occupant d'envoyer les mails
                    class MailSender implements SplObserver {

                        protected $mail;

                        public function __construct($mail) {
                            if (preg_match('`^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$`', $mail)) {
                                $this->mail = $mail;
                            }
                        }

                        public function update(SplSubject $obj) {
                            mail($this->mail, 'Erreur détectée !', 'Une erreur a été détectée sur le site. Voici les informations de celle-ci : ' . "\n" . $obj->getFormatedError());
                        }

                    }
                    
                    
                    // BDDWriter : classe s'occupant de l'enregistrement en BDD
                    class BDDWriter implements SplObserver {

                        protected $db;

                        public function __construct(PDO $db) {
                            $this->db = $db;
                        }

                        public function update(SplSubject $obj) {
                            $q = $this->db->prepare('INSERT INTO erreurs SET erreur = :erreur');
                            $q->bindValue(':erreur', $obj->getFormatedError());
                            $q->execute();
                        }

                    }
                    
                    
                    // Tester le code
                    $o = new ErrorHandler; // Nous créons un nouveau gestionnaire d'erreur.
                    $db = PDOFactory::getMysqlConnexion();

                    $o->attach(new MailSender('login@fai.tld'))
                            ->attach(new BDDWriter($db));

                    set_error_handler([$o, 'error']); // Ce sera par la méthode error() de la classe ErrorHandler que les erreurs doivent être traitées.

                    5 / 0; // Générons une erreur
                    ?>
                </p>
                
                
                <!-- Pattern Strategy
                ================================================== -->
                <h2>Le pattern Strategy</h2>
                <p>Séparer les algorithmes</p>
                <p class="col-sm-12">
                    <?php
                    // Création de l'interface
                    interface Formater {

                        public function format($text);
                    }
                    
                    
                    // Création de la classe abstraite writer
                    abstract class Writer {

                        // Attribut contenant l'instance du formateur que l'on veut utiliser.
                        protected $formater;

                        abstract public function write($text);

                        // Nous voulons une instance d'une classe implémentant Formater en paramètre.
                        public function __construct(Formater $formater) {
                            $this->formater = $formater;
                        }

                    }
                    
                    
                    // 2 classes qui héritent de Writer : FileWriter et DBWriter
                    class FileWriter extends Writer {

                        // Attribut stockant le chemin du fichier.
                        protected $file;

                        public function __construct(Formater $formater, $file) {
                            parent::__construct($formater);
                            $this->file = $file;
                        }

                        public function write($text) {
                            $f = fopen($this->file, 'w');
                            fwrite($f, $this->formater->format($text));
                            fclose($f);
                        }

                    }

                    class DBWriter extends Writer {

                        protected $db;

                        public function __construct(Formater $formater, PDO $db) {
                            parent::__construct($formater);
                            $this->db = $db;
                        }

                        public function write($text) {
                            $q = $this->db->prepare('INSERT INTO lorem_ipsum SET text = :text');
                            $q->bindValue(':text', $this->formater->format($text));
                            $q->execute();
                        }

                    }
                    
                    
                    // Les 3 formateurs
                    class TextFormater implements Formater {

                        public function format($text) {
                            return 'Date : ' . time() . "\n" . 'Texte : ' . $text;
                        }

                    }

                    class HTMLFormater implements Formater {

                        public function format($text) {
                            return '<p>Date : ' . time() . '<br />' . "\n" . 'Texte : ' . $text . '</p>';
                        }

                    }

                    class XMLFormater implements Formater {

                        public function format($text) {
                            return '<?xml version="1.0" encoding="ISO-8859-1"?>' . "\n" .
                                    '<message>' . "\n" .
                                    "\t" . '<date>' . time() . '</date>' . "\n" .
                                    "\t" . '<texte>' . $text . '</texte>' . "\n" .
                                    '</message>';
                        }

                    }
                    
                    
                    // Tester le code
                    function autoload($class) {
                        if (file_exists($path = $class . '.php')) {
                            require $path;
                        }
                    }

                    spl_autoload_register('autoload');

                    $writer = new FileWriter(new HTMLFormater, 'file.html');
                    $writer->write('Hello world !');
                    ?>
                </p>
                
                
                <!-- Pattern Singleton
                ================================================== -->
                <h2>Le pattern Singleton</h2>
                <p>Une classe, une instance - Instancier une classe une seule fois - Ne jamais implémenter un singleton pour l'utiliser comme une variable globale</p>
                <p class="col-sm-12">
                    <?php
                    class MonSingleton {

                        protected static $instance; // Contiendra l'instance de notre classe.

                        protected function __construct() {
                            
                        }

                        // Constructeur en privé - interdire l'accès à la méthode clone

                        protected function __clone() {
                            
                        }

                        // Méthode de clonage en privé aussi.

                        public static function getInstance() {
                            if (!isset(self::$instance)) { // Si on n'a pas encore instancié notre classe.
                                self::$instance = new self; // On s'instancie nous-mêmes. :)
                            }

                            return self::$instance;
                        }

                    }
                    
                    // Utilisation de la classe
                    $obj = MonSingleton::getInstance(); // Premier appel : instance créée.
                    $obj->methode1();
                    ?>
                </p>
                
                
                <!-- Pattern Injection de dépendances
                ================================================== -->
                <h2>Le pattern Injection de dépendances</h2>
                <p>Découpler les classes</p>
                <p class="col-sm-12">
                    <?php
                    // Exemple de code - Singleton - Mauvaise méthode
                    class NewsManager {

                        public function get($id) {
                            // On admet que MyPDO étend PDO et qu'il implémente un singleton.
                            $q = MyPDO::getInstance()->query('SELECT id, auteur, titre, contenu FROM news WHERE id = ' . (int) $id);

                            return $q->fetch(PDO::FETCH_ASSOC);
                        }

                    }
                    
                    // Bonne méthode
                    interface iDB {
                        // Méthode query
                        public function query($query);
                    }
                    
                    interface iResult {

                        public function fetchAssoc();
                    }
                    
                    // Les 4 classes
                    class MyPDO extends PDO implements iDB {

                        public function query($query) {
                            return new MyPDOStatement(parent::query($query));
                        }

                    }

                    class MyPDOStatement implements iResult {

                        protected $st;

                        public function __construct(PDOStatement $st) {
                            $this->st = $st;
                        }

                        public function fetchAssoc() {
                            return $this->st->fetch(PDO::FETCH_ASSOC);
                        }

                    }

                    class MyMySQLi extends MySQLi implements iDB {

                        public function query($query) {
                            return new MyMySQLiResult(parent::query($query));
                        }

                    }

                    class MyMySQLiResult implements iResult {

                        protected $st;

                        public function __construct(MySQLi_Result $st) {
                            $this->st = $st;
                        }

                        public function fetchAssoc() {
                            return $this->st->fetch_assoc();
                        }

                    }
                    
                    // La class NewsManager
                    class NewsManager2 {

                        protected $dao;

                        // On souhaite un objet instanciant une classe qui implémente iDB.
                        public function __construct(iDB $dao) {
                            $this->dao = $dao;
                        }

                        public function get($id) {
                            $q = $this->dao->query('SELECT id, auteur, titre, contenu FROM news WHERE id = ' . (int) $id);

                            // On vérifie que le résultat implémente bien iResult.
                            if (!$q instanceof iResult) {
                                throw new Exception('Le résultat d\'une requête doit être un objet implémentant iResult');
                            }

                            return $q->fetchAssoc();
                        }

                    }
                    
                    // Tester le code
                    $dao = new MyPDO('mysql:host=localhost;dbname=news', 'root', '');
// $dao = new MyMySQLi('localhost', 'root', '', 'news');

                    $manager = new NewsManager($dao);
                    print_r($manager->get(2));
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>