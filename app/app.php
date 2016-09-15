<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/ScrabbleScore.php";
    session_start();
    if (empty($_SESSION['list_of_albums'])) {
        $_SESSION['list_of_albums'] = array();
    }
    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));
    $app->get("/", function() use ($app) {
        return $app['twig']->render('home-list.html.twig', array('user_albums' => Album::getAll()));
    });
    $app->get("/albumform", function() use ($app) {
        return $app['twig']->render('add-album.html.twig');
    });
    $app->post("/addalbum", function() use ($app) {
        $newAlbum = new Album($_POST['artist'], $_POST['title']);
        $newAlbum->save();
        return $app['twig']->render('home-list.html.twig', array('user_albums' => Album::getAll()));
    });
    $app->get("/clearlist", function() use ($app) {
        Album::deleteAll();
        return $app['twig']->render('home-list.html.twig');
    });
    return $app;
?>
