<?php

use Symfony\Component\HttpFoundation\Request;

use src\Cms\CmsRepository;
use src\Cms\FormCmsType;

$adminController = $app['controllers_factory'];

$adminController->get('/', function (Request $request) use ($app){

    $repo = new CmsRepository($app['db']);
    $pages = $repo->findAll();

    return $app['twig']->render('cms/admin/list.html.twig', array(
        'pages' => $pages
    ));
})->bind('adminCms');


$adminController->get('/{id}', function (Request $request, $id) use ($app){

    $repo = new CmsRepository($app['db']);
    $cms = $repo->find($id);

    $form = createEditForm($cms, $app);

    return $app['twig']->render('cms/admin/edit.html.twig', array(
        'cms'  => $cms,
        'form' => $form->createView()
    ));
})->bind('adminEditCms');


$adminController->post('/{id}', function (Request $request, $id) use ($app){

    $repo = new CmsRepository($app['db']);

    $cms = $repo->find($id);

    $form = createEditForm($cms, $app);
    $form->handleRequest($request);
    if ($form->isValid()) {

        $data = $form->getData();

        $cms['title'] = $data['title'];
        $cms['content'] = $data['content'];
        $cms['is_visible'] = $data['is_visible'];

        $repo->update($id, $cms);
    }

    return $app->redirect($app['url_generator']->generate('adminCms'));
});


function createEditForm($entity, $app){
    $form = $app['form.factory']->create(new FormCmsType(), $entity, array(
        'action' => $app['url_generator']->generate('adminEditCms', array(
            'id'           => $entity['id']
        )),
        'method' => 'post'
    ));

    return $form;
}

return $adminController;
