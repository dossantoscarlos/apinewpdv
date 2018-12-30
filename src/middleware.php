<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Csrf\Guard;
use Web\Model\Entity\User;

$app->add(new Guard);

$app->add(function (Request $request, Response $response, callable $next) {
    $uri = $request->getUri();
    $path = $uri->getPath();
    if ($path != '/' && substr($path, -1) == '/') {
        // permanently redirect paths with a trailing slash
        // to their non-trailing counterpart
        $uri = $uri->withPath(substr($path, 0, -1));

        if($request->getMethod() == 'GET') {
            return $response->withRedirect((string)$uri, 301);
        }
        else {
            return $next($request->withUri($uri), $response);
        }
    }
    return $next($request, $response);
});

$app->add(function ($request, $response, $next) {
    // add media parser
    $request->registerMediaTypeParser(
        "text/javascript",
        function ($input) {
            return json_decode($input, true);
        }

      );
    return $next($request, $response);
});


$auth = function () use($app) {
    if (!isset($_SESSION['user']) or !is_array($_SESSION['user']))
        $app->redirect('/login');
};

//basic-http-auth
//
// $app->add(new Tuupola\Middleware\HttpBasicAuthentication([
//     "path" => "/",
//     "realm" => "Protected",
//    "users" => [
//         "username" => "t00r",
//         "password" => "passw0rd"
//     ],
//     "error" => function ($response, $arguments) {
//         $data = [];
//         $data["status"] = "error";
//         $data["message"] = $arguments["message"];
//         return $response->write(json_encode($data, JSON_UNESCAPED_SLASHES));
//     }
// ]));

//Responsavel por liberar o compartilhamento das informacoes do restfull
$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*' )
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With,XMLHttpRequest, Content-Type, Accept, Origin, Authorization,crossDomain')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});


//responsavel por registrar os  metodos as rotas
$app->add(function($request, $response, $next) {
    $route = $request->getAttribute("route");

    $methods = [];

    if (!empty($route)) {
        $pattern = $route->getPattern();

        foreach ($this->router->getRoutes() as $route) {
            if ($pattern === $route->getPattern()) {
                $methods = array_merge_recursive($methods, $route->getMethods());
            }
        }
        //Methods holds all of the HTTP Verbs that a particular route handles.
    } else {
        $methods[] = $request->getMethod();
    }

    $response = $next($request, $response);


    return $response->withHeader("Access-Control-Allow-Methods", implode(",", $methods));
});
