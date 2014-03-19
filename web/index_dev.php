<?php

use Symfony\Component\Debug\Debug;

define('DEBUG', true);

$app = require(__DIR__.'/../app/app.php');

Debug::enable();

$app->run();
