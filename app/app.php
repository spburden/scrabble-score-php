<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/ScrabbleScore.php";
    date_default_timezone_set('America/Los_Angeles');
    // session_start();
    // if (empty($_SESSION['list_of_albums'])) {
    //     $_SESSION['list_of_albums'] = array();
    // }
    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));
    $app->get("/", function() use ($app) {
        return $app['twig']->render('home.html.twig');
    });

    $app->post("/result", function() use ($app) {
        $newScrabbleScore = new ScrabbleScore();
        $score = $newScrabbleScore->getWordScore($_POST['input_word']);
        return $app['twig']->render('home.html.twig', array('score' => $score));
    });

    return $app;
?>
