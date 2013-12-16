<?php
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/bootstrap.php';

$app->get('/', function () use ($app) {
    
    return $app['twig']->render('index.html.twig', array(
        'ready'  => 'ok'
    ));
});

$app->mount('/demo', include __DIR__.'/../src/controller/demoController.php');

return $app;
