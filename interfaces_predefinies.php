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
                        
                        public function current() {
                            return $this->_array[$this->_positionInArray];
                        }
                        
                        public function key() {
                            return $this->_positionInArray;
                        }
                        
                        public function next() {
                            ++$this->_positionInArray;
                        }
                        
                        public function rewind() {
                            $this->_positionInArray = 0;
                        }
                        
                        public function valid() {
                            return isset($this->_array[$this->_positionInArray]);
                        }
                    }
                    
                    $obj = new Test_Iterator;
                    
                    foreach ($obj as $key => $value) {
                        echo $key, ' => ', $value, '<br>';
      
                    }
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>