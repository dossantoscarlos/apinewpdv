<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

$conatiner['notAllowedHandler'] = function ($c) {
    return function ($request, $response, $methods) use ($c) {
        return $c['response']
            ->withStatus(405)
            ->withHeader('Allow', implode(', ', $methods))
            ->withHeader('Content-type', 'text/html')
            ->write('Method must be one of: ' . implode(', ', $methods));
    };
};

//ORM
$container['orm'] = function ($c){
    $settings = $c->get('settings')['orm'];
    return $settings['db'];
};
//Twig
$container['view'] = function ($c) {
    $settings= $c->get('settings')['view'];
    $view = new \Slim\Views\Twig($settings['template_twig']);
    // Instantiate and add Slim specific extension
    $router = $c->get('router');
    $uri =  \Slim\Http\Uri::createFromEnvironment(new \Slim\Http\Environment($_SERVER));
    $view->addExtension(new \Slim\Views\TwigExtension($router, $uri));
    //$view->addExtension(new \App\Extensions\SlimCsrfExtension($c['csrf']));
    return $view;
};

//Validator
$container['validator'] = function ($c){
    $settings = $c->get('settings')['validator'];
    return $settings['validate'];
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
