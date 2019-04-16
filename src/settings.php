<?php
//verifica se a constant APP_ROOT ainda nao foi criada
if (!defined('APP_ROOT'))
{
  define('APP_ROOT', __DIR__);
}

//configura os settings do slim 
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Renderer settings
        'renderer' => [
            'template_path' => APP_ROOT . '/../resourcers/',
        ],
        // jwt settings
        "jwt" => [
            'secret' => 'supersecretkeyyoushouldnotcommittogithub'
        ],
        'view' => [
            'template_twig' => APP_ROOT . '/../resourcers/',
            'cache' =>APP_ROOT.'/../cache/',
        ],
        //ORM
        'orm' =>[
            'db' => $entityManager,
         ],

        'validator' =>[
            'validate' => new \Web\Validation\Validator,
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : APP_ROOT . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
