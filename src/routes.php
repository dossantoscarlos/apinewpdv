<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Http\Controllers\PessoasController;
use App\Http\Controllers\ProdutosController;

// Routes
$app->get('/pessoas', PessoasController::class.':show');
$app->post('/pessoas', PessoasController::class.':create');
$app->put('/pessoas/{cpf}', PessoasController::class.':update');
$app->delete('/pessoas/{cpf}', PessoasController::class.':drop');

$app->get('/produtos' , ProdutosController::class.':show');
$app->post('/produtos', ProdutosController::class.':create');
$app->delete('/produtos/{code}' , ProdutosController::class.":drop");
$app->put('/produtos/{code}' , ProdutosController::class.":update");

// $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
//     $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
//     return $handler($req, $res);
// });


