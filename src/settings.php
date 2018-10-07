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
        
        'doctrine' => [
            
            // if true, metadata caching is forcefully disabled
            'dev_mode' => true,

            // path where the compiled metadata info will be cached
            // make sure the path exists and it is writable
            'cache_dir' => APP_ROOT . '/var/doctrine',

            // you should add any other path containing annotated entity classes
            'metadata_dirs' => [APP_ROOT."/../App/Http/Models/Entity/"],
            
            'connection' =>  [
              'driver' => 'pdo_sqlite',
              'path' =>APP_ROOT.'/../db.sqlite',
            ]
        ],
        //Validation
        'validator' =>[
            'validate' => new \App\Validation\Validator, 
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : APP_ROOT . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
    ],
];
