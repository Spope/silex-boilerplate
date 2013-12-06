<?php

require_once __DIR__.'/../vendor/autoload.php';

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
