<?php
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__.'/bootstrap.php';

$app->get('/', function () use ($app) {
    
    return $app['twig']->render('index.html.twig', array(
        'ready'  => 'ok'
    ));
})->bind('home');


$app->mount('/login', include __DIR__.'/../src/Login/LoginController.php');
$app->mount('/cms', include __DIR__.'/../src/Cms/CmsController.php');
$app->mount('/admin/cms', include __DIR__.'/../src/Cms/CmsAdminController.php');


return $app;
