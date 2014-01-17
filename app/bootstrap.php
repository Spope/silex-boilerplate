<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;

require_once __DIR__.'/../vendor/autoload.php';
$loader = new UniversalClassLoader();
$loader->registerNamespace('src', __DIR__.'/..');
$loader->register();

$config = require_once __DIR__.'/config/config.php';

$app = new Silex\Application();
$app['debug'] = DEBUG;


/**
 * Services
 */
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => $config['db']
));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new Silex\Provider\SessionServiceProvider());

$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^/admin',
            'form'    => array('login_path' => '/login', 'check_path' => '/admin/connect'),
            'logout'  => array('logout_path' => '/admin/disconnect'),
            'users'   => $app->share(function() use($app) {

                return new src\User\UserProvider($app['db']);
            })
        )
    ),
    'security.access_rules' => array(
        array('^/admin$', 'ROLE_ADMIN')
    )
));
