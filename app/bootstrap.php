<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Silex\Provider\FormServiceProvider;
use Symfony\Component\HttpFoundation\Response;

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
if(!DEBUG) {

    $app->error(function (\Exception $e, $code) {
        return new Response('We are sorry, but something went terribly wrong.');
    });
} else {

    $app->register(new Silex\Provider\MonologServiceProvider(), array(
        'monolog.logfile' => __DIR__.'/development.log',
    ));
}

$app->register(new FormServiceProvider());

$app->register(new Silex\Provider\ValidatorServiceProvider());

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
));

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => $config['db']
));

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new Silex\Provider\SessionServiceProvider());
$app['session']->start();

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale' => 'fr',
    'locale_fallbacks' => array('fr', 'en'),
));

$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'secured' => array(
            'pattern' => '^.*$',
            'anonymous' => true,
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

