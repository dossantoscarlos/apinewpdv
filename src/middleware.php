<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Csrf\Guard;
use Web\Model\Entity\User;
use Web\Middlewares\RouterSeparator;
use Web\Middlewares\RegisterMediaType;
use Web\Middlewares\AccessApi;
use Web\Middlewares\RegisterMethodRoute;

//token
$app->add(new Guard);

//remove a / do final da url
$app->add( new RouterSeparator);


$app->add(new RegisterMediaType);

//Responsavel por liberar o compartilhamento das informacoes do restfull
$app->add(new AccessApi);

//responsavel por registrar os  metodos as rotas
$app->add(new RegisterMethodRoute);

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

//
