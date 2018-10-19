<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Http\Controllers\PessoasController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RepresetanteController;
use App\Http\Controllers\FornecedorController;

// Routes

#tabela Pessoas
$app->get('/pessoas', PessoasController::class.':show');
$app->post('/pessoas', PessoasController::class.':create');
$app->put('/pessoas/{cpf}', PessoasController::class.':update');
$app->delete('/pessoas/{cpf}', PessoasController::class.':drop');

#tabela Produtos
$app->get('/produtos' , ProdutosController::class.':show');
$app->post('/produtos', ProdutosController::class.':create');
$app->delete('/produtos/{code}' , ProdutosController::class.":drop");
$app->put('/produtos/{code}' , ProdutosController::class.":update");

#tabela Users
$app->get('/users' , UsersController::class.':show');
$app->post('/users', UsersController::class.':create');
$app->delete('/users/{user}' , UsersController::class.":drop");
$app->put('/users/{user}' , UsersController::class.":update");

#tabela Representantes
$app->get('/representantes' , RepresetanteController::class.':show');
$app->post('/representantes', RepresetanteController::class.':create');
$app->delete('/representantes/{user}' , RepresetanteController::class.":drop");

