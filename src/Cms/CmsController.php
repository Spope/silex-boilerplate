<?php

use src\Cms\CmsRepository;
use Symfony\Component\HttpFoundation\Request;

$cmsController = $app['controllers_factory'];


$cmsController->get('/{slug}', function (Request $request, $slug) use ($app){

    $repo = new CmsRepository($app['db']);
    $cms = $repo->findOneBySlug($slug);

    return $app['twig']->render('cms/show.html.twig', array(
        'cms' => $cms
    ));
})->bind('cms_show');


return $cmsController;
