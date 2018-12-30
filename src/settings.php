<?php
define('APP_ROOT', __DIR__);

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header
        // Renderer settings
        'renderer' => [
            'template_path' => APP_ROOT . '/../resourcers/',
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
