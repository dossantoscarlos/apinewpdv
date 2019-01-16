<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Csrf\Guard;
use Web\Model\Entity\User;
use Web\Middlewares\RouterSeparator;
use Web\Middlewares\Autentication;
use Web\Middlewares\RegisterMediaType;
use Web\Middlewares\AccessApi;
use Web\Middlewares\RegisterMethodRoute;
use Tuupola\Middleware\HttpBasicAuthentication;
use Web\Middlewares\GerarCookie;

//token
//$app->add(new Guard);

$app->add(new GerarCookie);

//remove a / do final da url
$app->add(new RouterSeparator);

$app->add(new RegisterMediaType);

//Responsavel por liberar o compartilhamento das informacoes do restfull
$app->add(new AccessApi);

//responsavel por registrar os  metodos as rotas
$app->add(new RegisterMethodRoute);

//basic-http-auth
// $app->add(new HttpBasicAuthentication([
//     "path" => "/",
//     "realm" => "Protected",
//     "secure" => false,
//     "relaxed" => ['localhost'],
//     "users" => [
//         "username" => "carlos",
//         "password" => "1004"
//     ],
//     "error" => function ($response, $arguments) {
//         $data = [];
//         $data["status"] = "error";
//         $data["message"] = $arguments["message"];
//         return $response->write(json_encode($data, JSON_UNESCAPED_SLASHES));
//     }
// ]));

// $app->add(new Tuupola\Middleware\JwtAuthentication([
//     "secret" => "supersecretkeyyoushouldnotcommittogithub",
//     "secure" => true,
//     "relaxed" => ["localhost"],
//     "rules" => [
//         new Tuupola\Middleware\JwtAuthentication\RequestPathRule([
//             "path" => "/",
//             "ignore" => []
//         ]),
//     ],    "error" => function ($response, $arguments) {
//         $data["status"] = "error";
//         $data["message"] = $arguments["message"];
//         return $response
//             ->withHeader("Content-Type", "application/json")
//             ->getBody()->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
//     }
// ]));
$app->add(new \Tuupola\Middleware\JwtAuthentication([
    "path" => ["/lojista", "/adm"], /* or ["/api", "/admin"] */
    "attribute" => "decoded_token_data",
    "secret" => "supersecretkeyyoushouldnotcommittogithub",
    "algorithm" => ["HS256"],
    "error" => function ($response, $arguments) {
        $data["status"] = "error";
        $data["message"] = $arguments["message"];
        return $response
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
]));
