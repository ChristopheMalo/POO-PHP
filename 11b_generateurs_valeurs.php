<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Exemples POO en PHP - Poo avancée - Les générateurs - valeurs retournées - PHP-POO OpenClassrooms et PHP Manual - Adaptation Christophe Malo">
        <meta name="keywords" content="POO, PHP, Bootstrap, generateurs">
        <meta name="author" content="Christophe Malo">
            
        <title>POO avancée en PHP - Les générateurs - valeurs retournées</title>

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
                <h1 class="text-center">POO avancée en PHP - Les générateurs - valeurs retournées</h1>
                <p>Retourner des valeurs avec yield</p>
                
                <!-- Les générateurs
                ================================================== -->
                <h2>Retourner des clés avec valeurs</h2>
                <p class="col-sm-12">
                    <?php
                    function generator() {
                        for ($i = 0; $i < 10; $i++) {
                            yield 'Itération n°' . $i;
                        }
                    }
                    
                    foreach (generator() as $key => $val) {
                        echo $key . ' => ' . $val . '<br>';
                    }
                    ?>
                </p>    
                
                    
                <h2>Modifier la clé associée à la valeur</h2>
                <p class="col-sm-12">
                    <?php
                    function generator2() {
                        yield 'a' => 'Itération 1';
                        yield 'b' => 'Itération 2';
                        yield 'c' => 'Itération 3';
                        yield 'd' => 'Itération 4';
                    }
                    
                    foreach (generator2() as $key2 => $val2) {
                        echo $key2 . ' => ' . $val2 . '<br>' ;
                    }
                    ?>
                </p>
                
                
                <h2>Retourner une référence</h2>
                <p class="col-sm-12">
                    <?php
                    class MyClassName {
                        protected $myAttribut;
                        
                        public function __construct() {
                            $this->myAttribut = ['refUn', 'refDeux', 'refTrois', 'refQuatre'];
                        }
                        
                        // Le & avant le nom du générateur indique que les valeurs retournées sont des références
                        public function &generator3() {
                            // On cherche ici à obtenir les références des valeurs du tableau pour les retourner
                            foreach ($this->myAttribut as &$value) {
                                yield $value;
                            }
                        }
                        
                        public function myAttribut() {
                            return $this->myAttribut;
                        }
                    }
                    
                    $object = new MyClassName;
                    
                    // On parcourt notre générateur en récupérant les entrées par référence
                    foreach ($object->generator3() as &$value) {
                        
                        //var_dump($value);
                        
                        // On effectue une opération quelconque sur notre valeur
                        $value = strrev($value);
                        
                    }
                    
                    echo '<pre>';
                        var_dump($object->myAttribut());
                    echo '</pre>';
                    ?>
                </p>
                
            </section>
        </div>
    </body>
</html>