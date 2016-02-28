<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="Exemples POO en PHP - Annexes - L'opérateur instanceof - PHP-POO OpenClassrooms et PHP Manual - Adaptation Christophe Malo">
        <meta name="keywords" content="POO, PHP, Bootstrap, generateurs">
        <meta name="author" content="Christophe Malo">

        <title>POO en PHP - Annexes - L'opérateur instanceof</title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

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
                <h1 class="text-center">POO en PHP - Annexes - L'opérateur instanceof</h1>
                <p>L'opérateur instanceof permet de vérifier si un objet est une instance d'une classe</p>
                <p>C'est un opérateur qui s'utilise dans des conditions</p>
                
                <!-- opérateur instanceof
                ================================================== -->
                <h2>Présentation de l'opérateur</h2>
                <p class="col-sm-12">
                <?php
                    class A
                    {

                    }

                    class B
                    {

                    }

                    $monObjet = new A;

                    if ($monObjet instanceof A) // Si $monObjet est une instance de A
                    { 
                        echo '$monObjet est une instance de A<br>';
                    }
                    else
                    {
                        echo '$monObjet n\'est pas une instance de A<br>';
                    }

                    if ($monObjet instanceof B) // Si $monObjet est une instance de B.
                    {
                        echo '$monObjet est une instance de B<br>';
                    }
                    else
                    {
                        echo '$monObjet n\'est pas une instance de B<br>';
                    }
                    ?>
                </p>
                
                <p class="col-sm-12">
                <?php
                    class D
                    {
                        
                    }

                    class E
                    {
                        
                    }

                    $monObjet = new D;

                    $classeD = 'D';
                    $classeE = 'E';

                    if ($monObjet instanceof $classeD) {
                        echo '$monObjet est une instance de ' . $classeD . '<br>';
                    } else {
                        echo '$monObjet n\'est pas une instance de ' . $classeD . '<br>';
                    }

                    if ($monObjet instanceof $classeE) {
                        echo '$monObjet est une instance de ' . $classeE . '<br>';
                    } else {
                        echo '$monObjet n\'est pas une instance de ' . $classeE . '<br>';
                    }
                ?>
                </p>
                
                <p class="col-sm-12">
                <?php
                    class F
                    {
                        
                    }
                    class G
                    {
                        
                    }

                    $f  = new F;
                    $f2 = new F;
                    $h  = new G;

                    if ($f instanceof $f2)
                    {
                        echo '$f et $f2 sont des instances de la même classe<br>';
                    }
                    else
                    {
                        echo '$f et $2 ne sont pas des instances de la même classe<br>';
                    }

                    if ($f instanceof $h)
                    {
                        echo '$f et $g sont des instances de la même classe<br>';
                    }
                    else
                    {
                        echo '$f et $g ne sont pas des instances de la même classe<br>';
                    }
                ?>
                </p>
                
                <h2>instanceof et l'héritage</h2>
                <p class="col-sm-12">
                <?php
                    class I { }
                    class J extends I { }
                    class K extends J { }

                    $j = new J;

                    if ($j instanceof I)
                    {
                        echo '$j est une instance de I ou $j instancie une classe qui est une fille de I<br>';
                    }
                    else
                    {
                        echo '$j n\'est pas une instance de I et $j instancie une classe qui n\'est pas une fille de I<br>';
                    }

                    if ($j instanceof K)
                    {
                        echo '$j est une instance de K ou $j instancie une classe qui est une fille de K<br>';
                    }
                    else
                    {
                        echo '$j n\'est pas une instance de K et $j instancie une classe qui n\'est pas une fille de K<br>';
                    }
                ?>
                </p>
                
                <h2>instanceof et les interfaces</h2>
                <p class="col-sm-12">
                <?php
                    interface iM { }
                    class M implements iM { }
                    class N { }

                    $m = new M;
                    $n = new N;

                    if ($m instanceof iM)
                    {
                        echo 'Si iM est une classe, alors $m est une instance de iM ou $m instancie une classe qui est une fille de iM. Sinon, $m instancie une classe qui implémente iM.<br>';
                    }
                    else
                    {
                        echo 'Si iM est une classe, alors $m n\'est pas une instance de iM et $m n\'instancie aucune classe qui est une fille de iM. Sinon, $m instancie une classe qui n\'implémente pas iM.<br>';
                    }

                    if ($n instanceof iM)
                    {
                        echo 'Si iM est une classe, alors $n est une instance de iM ou $n instancie une classe qui est une fille de iM. Sinon, $n instancie une classe qui implémente iM.<br>';
                    }
                    else
                    {
                        echo 'Si iM est une classe, alors $n n\'est pas une instance de iM et $n n\'instancie aucune classe qui est une fille de iM. Sinon, $n instancie une classe qui n\'implémente pas iM.<br>';
                    }
                ?>
                </p>
                
                <p class="col-sm-12">
                    <?php
                        interface iParent { }
                        interface iFille extends iParent { }
                        class P implements iFille { }

                        $p = new P;

                        if ($p instanceof iParent)
                        {
                          echo 'Si iParent est une classe, alors $p est une instance de iParent ou $p instancie une classe qui est une fille de iParent. Sinon, $p instancie une classe qui implémente iParent ou une fille de iParent.<br>';
                        }
                        else
                        {
                          echo 'Si iParent est une classe, alors $p n\'est pas une instance de iParent et $p n\'instancie aucune classe qui est une fille de iParent. Sinon, $p instancie une classe qui n\'implémente ni iParent, ni une de ses filles.<br>';
                        }
                    ?>
                </p>
            </section>
        </div>
    </body>
</html>