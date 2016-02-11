<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Exemples POO en PHP - Poo avancée - Les générateurs - PHP-POO OpenClassrooms et PHP Manual - Adaptation Christophe Malo">
        <meta name="keywords" content="POO, PHP, Bootstrap, generateurs">
        <meta name="author" content="Christophe Malo">
            
        <title>POO avancée en PHP - Les générateurs</title>

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
                <h1 class="text-center">POO avancée en PHP - Les générateurs</h1>
                <p>Un générateur est une façon simple et rapide d'implémenter un itérateur (résouddre des problèmes de performance ou de code à rallonge).</p>
                
                <!-- Les générateurs
                ================================================== -->
                <h2>Notion de base</h2>
                <p>Étude de cas - Parcourir les lignes d'un fichier</p>
                <p class="col-sm-12">
                    <?php
                    // Création d'un itérateur - pour l'exemple - le code est long
                    class FileReader implements Iterator {

                        protected $file;
                        protected $currentLine;
                        protected $currentKey;

                        public function __construct($file) {
                            if (!$this->file = fopen($file, 'r')) {
                                throw new RuntimeException('Impossible d\’ouvrir "' . $file . '"');
                            }
                        }

                        // Revient à la première ligne
                        public function rewind() {
                            fseek($this->file, 0);
                            $this->currentLine = fgets($this->file);
                            $this->currentKey = 0;
                        }

                        // Vérifie que la ligne actuelle existe bien
                        public function valid() {
                            return $this->currentLine !== false;
                        }

                        // Retourne la ligne actuelle
                        public function current() {
                            return $this->currentLine;
                        }

                        // Retourne la clé actuelle
                        public function key() {
                            return $this->currentKey;
                        }

                        // Déplace le curseur sur la ligne suivante
                        public function next() {
                            if ($this->currentLine !== false) {
                                $this->currentLine = fgets($this->file);
                                $this->currentKey++;
                            }
                        }

                    }
                    ?>
                    
                    
                    <?php
                    // Utilisation de l'itérateur
                    $fileReader = new FileReader('nom_du_fichier.extension');

                    foreach ($fileReader as $line) {
                        // Effectuer une opération sur $line
                    }
                    ?>
                    
                    
                    <?php
                    // Façon générateur
                    // Ecriture d'une seule fonction qui va parcourir les lignes du fichier
                    // Fonction générateur qui retourne une instance de Generator
                    function readLines($fileName) {
                        // Si le fichier est inexistant, on ne continue pas
                        if (!$file = fopen($fileName, 'r')) {
                            return;
                        }

                        // Tant qu'il reste des lignes à parcourir
                        while (($line = fgets($file)) !== false) {
                            // On dit à PHP que cette ligne du fichier fait office de « prochaine entrée du tableau »
                            yield $line; // Grâce à yield => generateur
                        }

                        fclose($file);
                    }
                    ?>
                    
                    <?php
                        //var_dump(redLines('MonFichier'));
                    ?>
                    
                    <?php
                    // Parcourir l'itérateur $generator (la variable)
                        $generator = readLines('nom_du_fichier.extension');

                        foreach ($generator as $line) {
                            // Effectuer une opération sur $line
                        }
                        
                    // ou plus simplement
                        foreach (readLines('MonFichier') as $line) {
                          // Effectuer une opération sur $line
                        }
                    ?>
                </p>
                
                
            </section>
        </div>
    </body>
</html>