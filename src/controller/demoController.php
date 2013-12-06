<?php

$demoController = $app['controllers_factory'];
$demoController->get('/', function () use ($app){

    return $app['twig']->render('index.html.twig', array(
        'ready'  => 'demo ok'
    ));
});

return $demoController;
