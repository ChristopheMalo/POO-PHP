<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Exemples POO en PHP - Poo avancée - Les interfaces - PHP-POO OpenClassrooms et PHP Manual - Adaptation Christophe Malo">
        <meta name="keywords" content="POO, PHP, Bootstrap, Résolution statique">
        <meta name="author" content="Christophe Malo">
            
        <title>POO avancée en PHP - Les interfaces prédéfinies</title>

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
                <h1 class="text-center">POO avancée en PHP - Les interfaces prédéfinies</h1>
                <h2>Interface Iterator</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 1
                    class Test_Iterator implements Iterator
                    {
                        private $_positionInArray = 0;
                        private $_array = ['position 1', 'Position 2', 'Position 3', 'Position 4', 'Position 5'];
                        
                        /*
                         * Méthode optionnelle
                         */
                        public function __construct() {
                            $this->_positionInArray = 0;
                        }
                        
                        /*
                         * Méthodes nécessaires pour l'interface Iterator
                         */
                        // Retourne l'élément courant
                        public function current()
                        {
                            return $this->_array[$this->_positionInArray];
                        }
                        
                        // Retourne la clé de l'élément courant
                        public function key()
                        {
                            return $this->_positionInArray;
                        }
                        
                        // Déplace l'iterator vers l'élément suivant
                        public function next()
                        {
                            ++$this->_positionInArray;
                        }
                        
                        // Remet l'iterator à la position 0 (premier élément)
                        public function rewind()
                        {
                            $this->_positionInArray = 0;
                        }
                        
                        // Vérifie si la position courante est valide
                        public function valid()
                        {
                            return isset($this->_array[$this->_positionInArray]);
                        }
                    }
                    
                    $obj = new Test_Iterator;
                    
                    foreach ($obj as $key => $value) {
                        echo $key, ' => ', $value, '<br>';
      
                    }
                    ?>
                </p>
                
                <h2>Interface SeekableIterator</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 1
                    class Test_SeekableIterator implements SeekableIterator
                    {
                        private $_positionInArray = 0;
                        private $_array = ['Element 1', 'Element 2', 'Element 3', 'Element 4', 'Element 5'];
                        
                        /*
                         * Méthode optionnelle
                         */
                        public function __construct()
                        {
                            $this->_positionInArray = 0;
                        }
                        
                        /*
                         * Méthodes nécessaires pour l'interface Iterator
                         */
                        public function current()
                        {
                            return $this->_array[$this->_positionInArray];
                        }
                        
                        public function key()
                        {
                            return $this->_positionInArray;
                        }
                        
                        public function next()
                        {
                            ++$this->_positionInArray;
                        }
                        
                        public function rewind()
                        {
                            $this->_positionInArray = 0;
                        }
                        
                        public function valid()
                        {
                            return isset($this->_array[$this->_positionInArray]);
                        }
                        
                        /*
                         * Méthode nécessaire pour l'interface SeekableIterator
                         */
                        public function seek($position)
                        {                        
                            if (!isset($this->_array[$position])) {
                                throw new OutOfBoundsException('La position (' . $position . ') n\'existe pas');
                            }
                            
                            echo 'Position courante (' . $position . ') = ';
                            $this->_positionInArray = $position;
                        }
                    }
                    
                    try {
                        $obj = new Test_SeekableIterator;
                    
//                        foreach ($obj as $key => $value) {
//                            echo $key, ' => ', $value, '<br>';
//                        }
                        
                        echo $obj->current() . '<br>';
                        
                        $obj->seek(2);
                        echo $obj->current() . '<br>';
                        
                        $obj->seek(1);
                        echo $obj->current() . '<br>';
                        
                        $obj->seek(10);
                        
                        
                    } catch (OutOfBoundsException $expression) {
                        echo $expression->getMessage();
                    }
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>