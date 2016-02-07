<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Exemples POO en PHP - Poo avancée - Les exceptions - PHP-POO OpenClassrooms et PHP Manual - Adaptation Christophe Malo">
        <meta name="keywords" content="POO, PHP, Bootstrap, Résolution statique">
        <meta name="author" content="Christophe Malo">
            
        <title>POO avancée en PHP - Les exceptions</title>

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
                <h1 class="text-center">POO avancée en PHP - Les exceptions</h1>
                <!-- Exceptions
                ================================================== -->
                <h2>Gestions des erreurs - Les exceptions</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 1
                    function calculSomme($nombre1, $nombre2)
                    {
                        if (!is_numeric($nombre1) || !is_numeric($nombre2)) {
                            // Lancer exception en instanciant un objet de la classe Exception
                            throw new Exception('Les 2 paramètres doivent être des nombres.<br>');
                        }
                        
                        return $nombre1 + $nombre2;
                    }
                    
                    // Tentative de réaliser les instructions
                    try
                    {
                        echo calculSomme(18, 3) . '<br>';
                        echo calculSomme('clavier', 54) . '<br>';
                        echo calculSomme(10, 25) . '<br>';
                    }
                    
                    // Attraper (Catch) les exceptions si présence d'une exception
                    catch (Exception $exception)
                    {
                        echo 'Message d\'erreur : ' . $exception->getMessage();
                    }
                    
                    echo 'Fin du script';
                    
                    ?>
                </p>
                
                
                <!-- Exceptions personnalisées
                ================================================== -->
                <h2>Gestions des erreurs - Les exceptions personnalisées</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 2
                    class PersonnalException extends Exception
                    {
                        public function __construct($message, $code = 0)
                        {
                            parent::__construct($message, $code);
                        }
                        
                        public function __toString()
                        {
                            return $this->message;
                        }
                    }
                    
                    function calculSomme2($nombre1, $nombre2)
                    {
                        if (!is_numeric($nombre1) || !is_numeric($nombre2)) {
                            // Lancer exception personnalisée
                            throw new PersonnalException('Les 2 paramètres doivent être des nombres.<br>');
                        }
                        
                        return $nombre1 + $nombre2;
                    }
                    
                    // Tentative de réaliser les instructions
                    try
                    {
                        echo calculSomme2(18, 3) . '<br>';
                        echo calculSomme2('clavier', 54) . '<br>';
                        echo calculSomme2(10, 25) . '<br>';
                    }
                    
                    // Attraper (Catch) les exceptions si présence d'une exception
                    catch (PersonnalException $exception)
                    {
                        echo 'Message d\'erreur : ' . $exception . '<br>';
                    }
                    
                    echo 'Fin du script';
                    
                    ?>
                </p>
                
                
                <!-- Exceptions personnalisées - Plusieurs Catch
                ================================================== -->
                <h2>Gestions des erreurs - Les exceptions personnalisées - Plusieurs Catch</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 3
                    class PersonnalException2 extends Exception
                    {
                        public function __construct($message, $code = 0)
                        {
                            parent::__construct($message, $code);
                        }
                        
                        public function __toString()
                        {
                            return $this->message;
                        }
                    }
                    
                    function calculSomme3($nombre1, $nombre2)
                    {
                        if (!is_numeric($nombre1) || !is_numeric($nombre2)) {
                            // Lancer exception personnalisée
                            throw new PersonnalException2('Les 2 paramètres doivent être des nombres.<br>');
                        }
                        
                        if (func_num_args() > 2) {
                            // Lancer une exception Exception
                            throw new Exception('Uniquement 2 arguments.<br>');
                        }
                        
                        return $nombre1 + $nombre2;
                    }
                    
                    // Tentative de réaliser les instructions
                    try
                    {
                        echo calculSomme3(18, 3) . '<br>';
                        echo calculSomme3(18, 54, 45) . '<br>';
                        echo calculSomme3(10, 25) . '<br>';
                    }
                    
                    // Attraper (Catch) les exceptions si présence d'une exception
                    catch (PersonnalException2 $exception)
                    {
                        echo 'Message d\'erreur [PersonnalException2] : ' . $exception . '<br>';
                    }
                    
                    catch (Exception $exception)
                    {
                        echo 'message d\'erreur [Exception] : ' . $exception->getMessage() . '<br>';
                    }
                    
                    echo 'Fin du script';
                    
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>