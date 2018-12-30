<?php

use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Csrf\Guard;
use Web\Model\Entity\User;
use Web\Middlewares\RouterSeparator;
use Web\Middlewares\RegisterMediaType;
use Web\Middlewares\AccessApi;
use Web\Middlewares\RegisterMethodRoute;
use Tuupola\Middleware\HttpBasicAuthentication;

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
// $app->add(new HttpBasicAuthentication([
//     "path" => "/",
//     "realm" => "Protected",
//    "users" => [
//         "username" => "carlos",
//         "password" => "1004"
//     ],
//     "error" => function ($response, $arguments) {
//         $data = [];
//         $data["status"] = "error";
//         $data["message"] = $arguments["message"];
//         return $response->write(json_encode($data, JSON_UNESCAPED_SLASHES));
//     },
//     "done" => function ($response, $arguments){
//         return redirect('/users');
//     }
// ]));
