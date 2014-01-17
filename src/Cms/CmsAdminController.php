<?php

use src\Cms\CmsRepository;
use Symfony\Component\HttpFoundation\Request;

$adminController = $app['controllers_factory'];

$adminController->get('/', function (Request $request) use ($app){

    $repo = new src\Cms\CmsRepository($app['db']);
    $pages = $repo->findAll();

    return $app['twig']->render('cms/admin/list.html.twig', array(
        'pages' => $pages
    ));
})->bind('adminCms');


$adminController->get('/{id}', function (Request $request, $id) use ($app){

    $repo = new src\Cms\CmsRepository($app['db']);
    $cms = $repo->find($id);

    return $app['twig']->render('cms/admin/edit.html.twig', array(
        'cms' => $cms
    ));
})->bind('adminEditCms');


$adminController->post('/{id}', function (Request $request, $id) use ($app){

    $repo = new src\Cms\CmsRepository($app['db']);

    $cms = array(
        'title' => $request->get('title'),
        'content' => $request->get('content')
    );

    $repo->update($id, $cms);

    return $app->redirect($app['url_generator']->generate('adminCms'));
});


return $adminController;
