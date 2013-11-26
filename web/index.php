<?php

require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app['debug'] = true;

//example action
$app->get('hello/{name}', function($name) use($app) {
    return $app['twig']->render('hello.twig', array(
        'name' => $name,
    ));
});


//show patient list
$app->get('/', function() use ($app) {
    //fetch patients from https://patients.apiary.io/patients

    return $app['twig']->render('index.twig');
});

$app->post('/send/mail', function(Request $request) use($app) {
    //example to get post variables
    $message = $request->get('message');

    return $app->escape($message);
});

$app->run();
