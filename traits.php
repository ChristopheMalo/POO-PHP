<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Exemples POO en PHP - Poo avancée - Les traits - PHP-POO OpenClassrooms et PHP Manual - Adaptation Christophe Malo">
        <meta name="keywords" content="POO, PHP, Bootstrap, Résolution statique">
        <meta name="author" content="Christophe Malo">
            
        <title>POO avancée en PHP - Les traits</title>

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
                <h1 class="text-center">POO avancée en PHP - Les traits</h1>
                <!-- Exceptions
                ================================================== -->
                <h2>Le principe - Les traits</h2>
                <p class="col-sm-12">
                    <strong><em>Le trait permet l'utilisation du code d'une méthode dans plusieurs classes indépendantes. Rappel une classe enfant ne peut hériter que d'une seule classe mère. Le trait permet "d'étendre" le principe d'héritage.</em></strong><br>
                    <?php
                    // Exemple 1
                    trait MyHTMLFormater
                    {
                        public function format($text)
                        {
                            return '<p>Date : ' . date('d/m/Y') . '</p>' . "\n" .
                                   '<p>' . nl2br($text) . '</p>';
                        }
                    }
                    
                    trait MyTextFormater
                    {
                        public function format($text)
                        {
                            return 'Date : ' . date('d/m/Y') . "\n" . $text;
                        }
                    }
                    
                    trait AfficheSimpleText
                    {
                        protected $string = 'Bonjour !<br>';
                        
                        public function showString()
                        {
                            echo $this->string;
                        }
                    }
                    
                    trait ToIncludeInOther
                    {
                        public function SayToIncludeInOther()
                        {
                            echo 'Je suis un trait de base à inclure dans un autre trait.<br>';
                        }
                    }
                    
                    trait UseAnOtherTrait
                    {
                        use ToIncludeInOther;
                        
                        public function SaySomethingToo()
                        {
                            echo 'je suis le trait UseAnOtherTrait.<br>';
                        }
                    }
                    
                    class My_Writer
                    {
                        use MyHTMLFormater, MyTextFormater
                        {
                            MyHTMLFormater::format insteadof MyTextFormater;
                        }
                        
                        public function write($text)
                        {
                            file_put_contents('txt/fichier.txt', $this->format($text));
                        }
                    }
                    
                    class My_Mailer
                    {
                        use MyHTMLFormater;
                        
                        public function send($text)
                        {
                            mail('christof.malo@gmail.com', 'Test Traits', $this->format($text));
                        }
                    }
                    
                    class Affiche_Text
                    {
                        use AfficheSimpleText;
                    }
                    
                    class UseTraitInTrait
                    {
                        use UseAnOtherTrait;
                    }
                    
                    $objWriter = new My_Writer;
                    $objWriter->write('Hello world!');
                    
                    $objMailer = new My_Mailer;
                    $objMailer->send('Hello world!');
                    
                    $objAfficheText = new Affiche_Text();
                    $objAfficheText->showString();
                    
                    $objTraitInTrait = new UseTraitInTrait;
                    $objTraitInTrait->SayToIncludeInOther();
                    $objTraitInTrait->SaySomethingToo();
                    
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>