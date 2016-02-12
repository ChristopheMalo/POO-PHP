<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="Exemples POO en PHP - Poo avancée - Les générateurs - Les coroutines - PHP-POO OpenClassrooms et PHP Manual - Adaptation Christophe Malo">
        <meta name="keywords" content="POO, PHP, Bootstrap, generateurs">
        <meta name="author" content="Christophe Malo">

        <title>POO avancée en PHP - Les générateurs - Les coroutines</title>

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
                <h1 class="text-center">POO avancée en PHP - Les générateurs - Les coroutines</h1>

                <!-- Les générateurs - Les coroutines
                     Ou générateurs inverses
                     pour prendre des valeurs et non en retourner
                ================================================== -->
                <h2>La méthode send()</h2>
                <p><strong>envoyer des données au générateur</strong></p>
                <p class="col-sm-12">
                    <?php

                    function generator() {
                        echo yield;
                    }

                    $generator = generator();
                    $generator->send('<p>Hello world depuis la variable <code>$generator</code>!!!</p>');

                    function generator2() {
                        echo (yield 'Hello world !');
                        echo yield;
                        // echo yield; // Pour tester affichage du message3
                    }

                    $generator2 = generator2();

                    // On envoie « Message 1 »
                    // PHP va donc l'afficher grâce au premier echo du générateur
                    $generator2->send('<p>Message 1</p>');

                    // On envoie « Message 2 »
                    // PHP reprend l'exécution du générateur et affiche le message grâce au 2ème echo
                    $generator2->send('<p>Message 2</p>');

                    // On envoie « Message 3 »
                    // La fonction générateur s’était déjà terminée, donc rien ne se passe
                    $generator2->send('<p>Message 3</p>');
                    ?>
                </p>


                <h2>Un exemple multitâche</h2>
                <p><strong>envoyer des données au générateur</strong></p>
                <p class="col-sm-12">
                <?php

                class TaskRunner {

                    protected $tasks;

                    public function __construct() {
                        // On initialise la liste des tâches
                        $this->tasks = new SplQueue;
                    }

                    public function addTask(Generator $task) {
                        // On ajoute la tâche à la fin de la liste
                        $this->tasks->enqueue($task);
                    }

                    public function run() {
                        // Tant qu’il y a toujours au moins une tâche à exécuter
                        while (!$this->tasks->isEmpty()) {
                            // On enlève la première tâche et on la récupère au passage
                            $task = $this->tasks->dequeue();

                            // On exécute la prochaine étape de la tâche
                            $task->send('Hello world !');

                            // Si la tâche n’est pas finie, on la replace en fin de liste
                            if ($task->valid()) {
                                $this->addTask($task);
                            }
                        }
                    }

                }
                
                
                // Tester la class
                $taskRunner = new TaskRunner;

                function task1() {
                    for ($i = 1; $i <= 2; $i++) {
                        $data = yield;
                        echo '<p>Tâche 1, itération ' . $i . ', valeur envoyée : ' . $data . '</p>';
                    }
                }

                function task2() {
                    for ($i = 1; $i <= 6; $i++) {
                        $data = yield;
                        echo '<p>Tâche 2, itération ' . $i . ', valeur envoyée : ' . $data . '</p>';
                    }
                }

                function task3() {
                    for ($i = 1; $i <= 4; $i++) {
                        $data = yield;
                        echo '<p>Tâche 3, itération ' . $i . ', valeur envoyée : ' . $data . '</p>';
                    }
                }

                $taskRunner->addTask(task1());
                $taskRunner->addTask(task2());
                $taskRunner->addTask(task3());

                $taskRunner->run();
                ?>  
                </p>
                
                
                <h2>La méthode throw()</h2>
                <p><strong>Lancer une exception à l'emplacement du <code>yield</code> dans le générateur - accepte un seul argument</strong></p>
                <p class="col-sm-12">
                <?php
                // Génére une fatal error - normal - une exception est lancée par PHP
//                function generator3() {
//                    echo "<p>Début</p>";
//                    yield;
//                    echo "<p>Fin</p>";
//                }
//
//                $generator3 = generator3();
//                $generator3->throw(new Exception('<p>Test</p>'));
                
                
                
                function generator4() {
                    // On fait une boucle de 5 yield pour garder quelque chose de simple
                    for ($i = 0; $i < 5; ++$i) {
                        // On indique qu’on vient de rentrer dans la ième itération
                        echo "<p>Début $i</p>";

                        // On essaye « d’attraper » la valeur qu’on nous a donnée
                        try {
                            yield;
                        } catch (Exception $e) {
                            // Si une exception a été levée, on indique son numéro
                            echo "<p>Exception $i</p>";
                        }

                        // Enfin, on indique qu'on vient de finir la ième itération
                        echo "<p>Fin $i</p>";
                    }
                }

                $generator4 = generator4();

                foreach ($generator4 as $i => $val) {
                    // On décide de lancer une exception pour l'itération n°3
                    if ($i == 3) {
                        $generator4->throw(new Exception('<p>Petit test</p>'));
                    }
                }
                ?>
                </p>
                
                
                <h2>Multitâche avec throw</h2>
                <p class="col-sm-12">
                <?php
                class TaskRunner2 {

                    protected $tasks;

                    public function __construct() {
                        // On initialise la liste des tâches
                        $this->tasks = new SplQueue;
                    }

                    public function addTask(Generator $task) {
                        // On ajoute la tâche à la fin de la liste
                        $this->tasks->enqueue($task);
                    }

                    public function run() {
                        $i = 1;

                        // Tant qu’il y a toujours au moins une tâche à exécuter
                        while (!$this->tasks->isEmpty()) {
                            // On enlève la première tâche et on la récupère au passage
                            $task = $this->tasks->dequeue();

                            // Pour l'exemple, on va arrêter la tâche n°2 lors de son 2ème appel
                            if ($i == 5) {
                                $task->throw(new Exception('Tâche interrompue'));
                            }

                            // On exécute la prochaine étape de la tâche
                            $task->send('Hello world !');

                            // Si la tâche n’est pas finie, on la replace en fin de liste
                            if ($task->valid()) {
                                $this->addTask($task);
                            }

                            $i++;
                        }
                    }

                }

                $taskRunner2 = new TaskRunner2;

                function task1a() {
                    for ($i = 1; $i <= 2; $i++) {
                        try {
                            $data = yield;
                            echo '<p>Tâche 1, itération ' . $i . ', valeur envoyée : ' . $data . '</p>';
                        } catch (Exception $e) {
                            echo '<p>Erreur tâche 1 : ' . $e->getMessage() . '</p>';
                            return;
                        }
                    }
                }

                function task2a() {
                    for ($i = 1; $i <= 6; $i++) {
                        try {
                            $data = yield;
                            echo '<p>Tâche 2, itération ' . $i . ', valeur envoyée : ' . $data . '</p>';
                        } catch (Exception $e) {
                            echo '<p>Erreur tâche 2 : ' . $e->getMessage() . '</p>';
                            return;
                        }
                    }
                }

                function task3a() {
                    for ($i = 1; $i <= 4; $i++) {
                        try {
                            $data = yield;
                            echo '<p>Tâche 3, itération ' . $i . ', valeur envoyée : ' . $data . '</p>';
                        } catch (Exception $e) {
                            echo '<p>Erreur tâche 3 : ' . $e->getMessage() . '</p>';
                            return;
                        }
                    }
                }

                $taskRunner2->addTask(task1a());
                $taskRunner2->addTask(task2a());
                $taskRunner2->addTask(task3a());

                $taskRunner2->run();
                ?>
                </p>
            </section>
        </div>
    </body>
</html>