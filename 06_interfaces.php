<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Exemples POO en PHP - Poo avancée - Les interfaces - PHP-POO OpenClassrooms et PHP Manual - Adaptation Christophe Malo">
        <meta name="keywords" content="POO, PHP, Bootstrap, Résolution statique">
        <meta name="author" content="Christophe Malo">
            
        <title>POO avancée en PHP - Les interfaces</title>

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
                <h1 class="text-center">POO avancée en PHP - Les interfaces</h1>
                <h2>Exemple 1</h2>
                <p>L'interface sert à décrire le comportement d'un objet (se déplacer par exemple)</p>
                <p class="col-sm-12">
                    <?php
                    // Exemple 1
                    interface InterfaceName1
                    {
                        const MY_CONSTANT = 'Ma constante de test';
                        public function functionName1($param);
                    }
                    
                    echo 'Test d\'affichage de la constante dès la création de l\'interface : ' . InterfaceName1::MY_CONSTANT;
                    
                    interface InterfaceName2
                    {
                        public function functionName2($param);
                    }
                        
                    class My_Class implements InterfaceName1, InterfaceName2
                    {
                        public function functionName1($param)
                        {
                            echo 'Toto<br>';
                        }
                        
                        public function functionName2($param)
                        {
                            echo 'Tutu<br>';
                        }
                    }
                    
                    $obj = new My_Class;
                    $obj->functionName1($param);
                    $obj->functionName2($param);
                    
                    echo 'Test d\'affichage de la constante après création d\'instance : ' . $obj::MY_CONSTANT;
                    ?>
                </p>
                
                
                <h2>Exemple 2 - Héritage</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 2
                    interface InterfaceName3
                    {
                        public function functionName1();
                    }
                    
                    interface InterfaceName3B
                    {
                        public function functionName1B();
                    }
                    
                    // L'interface peut hériter de plusieurs interfaces
                    interface InterfaceName4 extends InterfaceName3, InterfaceName3B
                    {
                        //public function functionName1($param1, $param2); // Génère une erreur fatale - L''héritage d'une interface interdit la réécriture
                        public function functionName1();
                        public function functionName1B();
                    }
                    
                    class My_class2 implements InterfaceName4 {
                        public function functionName1()
                        {
                            echo 'Implements via Extends<br>';
                        }
                        
                        public function functionName1B()
                        {
                            echo 'Héritage multiple<br>';
                        }
                        
                        public function functionName2()
                        {
                            echo 'Function perso directe dans My_Class2<br>';
                        }
                    }
                    
                    $obj02 = new My_class2;
                    $obj02->functionName1();
                    $obj02->functionName1B();
                    $obj02->functionName2();
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>