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
                    <strong><em>Cette interface permet de modifier le comportement de l'objet parcouru.</em></strong><br>
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
                    <strong><em>Cette interface hérite de l'interface Itérator et possède une méthode supplémentaire (seek) qui permet d'atteindre une position précise.</em></strong><br>
                    <?php
                    // Exemple 2
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
                
                <h2>Interface ArrayAccess</h2>
                <p class="col-sm-12">
                    <strong><em>Cette interface introduit la gestion des crochets et des clés à la suite de l'objet. L'interface est alors accessible comme un vrai objet.</em></strong><br>
                    <?php
                    // Exemple 2
                    class Test_ArrayAccess implements SeekableIterator, ArrayAccess
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
                         * SeekableIterator hérite de Iterator
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
                        
                        /*
                         * Méthodes nécessaires pour l'interface ArrayAccess
                         */
                        // Vérification de l'existence d'un offset
                        public function offsetExists($offset) {
                            return isset($this->_array[$offset]);
                        }
                        
                        // Retourne la valeur de l'offset
                        public function offsetGet($offset) {
                            return $this->_array[$offset];
                        }
                        
                        // Assigne une valeur à l'offset spécifié
                        public function offsetSet($offset, $value) {
                            $this->_array[$offset] = $value;
                        }
                        
                        // Supprime un offset
                        public function offsetUnset($offset) {
                            unset($this->_array[$offset]);
                        }
                    }
                    
                    $obj = new Test_ArrayAccess;
                    echo 'Parcours de l\'objet :<br>';
                    foreach ($obj as $key => $value) {
                        echo $key . ' => ' . $value . '<br>';
                    }
                    
                    echo '<br>Positionnement du curseur sur l\'élément 3 :<br>';
                    $obj->seek(2);
                    echo $obj->current();
                    
                    echo '<br>';
                    
                    echo '<br>Affichage de l\'élément 4 : ' . $obj[3] . '<br>' ;
                    echo 'Modification de l\'élément 4 en cours...<br>';
                    $obj[3] = 'Texte modifié de l\'élément 4';
                    echo 'Nouvelle valeur de l\'élement 4 : ' . $obj[3] . '<br>';
                    
                    echo '<br>';
                    
                    echo 'Destruction du 5ème élément en cours...<br>';
                    unset($obj[4]);
                    if (isset($obj[4])) {
                        echo '$obj[4] existe';
                    } else {
                        echo '$obj[4] est détruit';
                    }
                    
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>