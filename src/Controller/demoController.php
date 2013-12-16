<?php

use src\Repository\DemoRepository;

$demoController = $app['controllers_factory'];


$demoController->get('/', function () use ($app){

    $repo = new DemoRepository($app['db']);
    $demos = $repo->findAll();

    return $app['twig']->render('index.html.twig', array(
        'ready'  => 'demo ok',
        'demos'  => $demos
    ));
});



return $demoController;
