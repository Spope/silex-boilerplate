<?php

use Symfony\Component\HttpFoundation\Request;

$loginController = $app['controllers_factory'];


$loginController->get('/', function (Request $request) use ($app){

    return $app['twig']->render('login/login.html.twig', array(
        'error' => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
    ));
});



return $loginController;
