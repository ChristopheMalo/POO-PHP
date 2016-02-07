<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Exemples POO en PHP - Résolution statique à la volée - basés sur le MOOC POO - PHP OpenClassrooms et PHP Manual - Adaptation Christophe Malo">
        <meta name="keywords" content="POO, PHP, Bootstrap, Résolution statique">
        <meta name="author" content="Christophe Malo">
            
        <title>POO en PHP - Résolution statique à la volée</title>

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
                <h1 class="text-center">POO en PHP - Résolution statique à la volée</h1>
                <h2>Exemple 1 - Self</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 1
                    class A {
                        public static function whoIs() {
                            echo __CLASS__;
                        }

                        public static function lancerTest() {
                            self::whoIs();
                        }
                    }

                    class B extends A {
                        public static function whoIs() {
                            echo __CLASS__;
                        }
                    }
                    
                    B::lancerTest(); // Return A
                    
                    ?>
                </p>
                
                
                <h2>Exemple 2 - Static</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 2
                    class C {
                        public static function whoIs() {
                            echo __CLASS__;
                        }

                        public static function lancerTest() {
                            static::whoIs();
                        }
                    }

                    class D extends C {
                        public static function whoIs() {
                            echo __CLASS__;
                        }
                    }

                    D::lancerTest(); // Return D
                    
                    ?>
                </p>
                
                
                <h2>Exemple 3</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 3
                    class E {
                        public static function whoIs() {
                            echo __CLASS__;
                        }
                    }

                    class F extends E {
                        public static function whoIs() {
                            echo __CLASS__;
                        }
                        
                        public static function lancerTest() {
                            parent::whoIs();
                        }
                    }
                    
                    class G extends F {
                        public static function whoIs() {
                            echo __CLASS__;
                        }
                    }

                    G::lancerTest(); // Return E
                    
                    ?>
                </p>
                
                
                <h2>Exemple 4</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 4
                    class H {
                        public static function whoIs() {
                            echo __CLASS__;
                        }
                        
                        public static function callWhoIs() {
                            static::whoIs();
                        }
                    }

                    class I extends H {
                        public static function whoIs() {
                            echo __CLASS__;
                        }
                        
                        public static function lancerTest() {
                            parent::callWhoIs();
                        }
                    }
                    
                    class J extends I {
                        public static function whoIs() {
                            echo __CLASS__;
                        }
                    }

                    J::lancerTest(); // Return J
                    
                    ?>
                </p>
                
                
                <h2>Exemple 5</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 5
                    class myParent {
                      public function __construct() {
                        static::whoIs();
                      }

                      public static function whoIs() {
                        echo __CLASS__;
                      }
                    }

                    class myChild extends myParent
                    {
                      public function __construct() {
                        static::whoIs();
                      }

                      public function lancerTest() {
                        $oneChild = new Parent();
                      }

                      public static function whoIs() {
                        echo __CLASS__;
                      }
                    }

                    $oneChild = new myChild;
                    $oneChild->lancerTest();
                    // Return myChildmyParent
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>