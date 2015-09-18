<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Exemples POO en PHP - Abstraction et finalisation - basés sur le MOOC POO - PHP OpenClassrooms et PHP Manual - Adaptation Christophe Malo">
        <meta name="keywords" content="POO, PHP, Bootstrap, Résolution statique">
        <meta name="author" content="Christophe Malo">
            
        <title>POO en PHP - Abstraction et finalisation</title>

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
                <h1 class="text-center">POO en PHP - Abstraction et finalisation</h1>
                <h2>Exemple 1 - Abstraction - Classe et Méthode</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 1
                    abstract class A { // Classe A abstraite
                        abstract public function A1($param);
                        
                        public function A2() {
                            // Instructions
                        }
                    }

                    class B extends A { // Classe B héritant de A
                        public function A1($param) {
                            // Instruction
                        }
                    }
                    
                    $classeB = new B; // Pas d'erreur, la classe B n'est pas abstraite
                    // $classeA = new A; // Erreur fatale car la classe A est abstraire et ne peut-être instanciée
                    
                    ?>
                </p>
                
                
                <h2>Exemple 2 - Finalisation - Classe et Méthode</h2>
                <p class="col-sm-12">
                    <?php
                    // Exemple 2
                    abstract class C {
                        public function A1($param) {
                            // Instructions
                        }
                        
                        // Empêche l'accès aux classes filles
                        final public function A2() {
                            // Instructions
                        }
                        
                    }
                    
                    final class D extends C {
                        public function A1($param) {
                            // Instructions
                        }
                        
                        // Erreur fatale car cette méthode est finale dasn la classe parente
                        public function A2() {
                            // Instructions
                        }
                    }
                    
                    // Génère une erreur fatale car la classe E ne peut hériter de la class D car D est final
                    class E extends D {
                        
                    }
                    
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>