<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

require __DIR__.'/../src/bootstrap.php';

$settings = require __DIR__ . '/../src/settings.php';

session_start();

// Instantiate the app;
$app = new \Slim\App($settings);
// Set up dependencies
require __DIR__ . '/../src/dependencies.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run app
$app->run();

// use Slim\App;
// use Slim\Container;
// /** @var Container $cnt */
// $cnt = require_once __DIR__ . '/../src/bootstrap.php';
// /** @var App $app */
// $app = $cnt[App::class];

// // Set up dependencies
// require __DIR__ . '/../src/dependencies.php';

// // Register middleware
//  require __DIR__ . '/../src/middleware.php';

// // Register routes
// require __DIR__ . '/../src/routes.php';
// $app->run();

