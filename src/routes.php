<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Psr\Http\Message\ResponseInterface;
use Web\Http\Controllers\PessoasController;
use Web\Http\Controllers\ProdutosController;
use Web\Http\Controllers\RepresentantesController;
use Web\Http\Controllers\FuncionariosController;
use Web\Http\Controllers\FornecedoresController;
use Web\Http\Controllers\UsersController;
use Web\Http\Controllers\HomesController;
use Web\Http\Controllers\Auth\AuthController;

// Routes

//home
$app->get('/' ,function (Request $request, Response $response , $args){
  return $response->withRedirect('/lojista');
});

$app->group('/lojista', function (App $app) {
  #tabela Pessoas
  $app->get('/pessoas', PessoasController::class.':show');
  $app->post('/pessoas', PessoasController::class.':create');
  //tabela Produtos
  $app->get('/produtos' , ProdutosController::class.':show');
  #tabela Users
  $app->get('/users', UsersController::class.':show');
  #tabela Representantes
  $app->get('/representantes' , RepresentantesController::class.':show');
  #tabela fornecedores
  $app->get('/fornecedores' , FornecedoresController::class.':show');
  #tabela Funcionarios
  $app->get('/funcionarios[/{matr}]' , FuncionariosController::class.':show');
});

$app->group('/adm', function (App $app){
  $app->put('/pessoas/{cpf}', PessoasController::class.':update');
  $app->delete('/pessoas/{cpf}', PessoasController::class.':drop');
  $app->post('/produtos', ProdutosController::class.':create');
  $app->delete('/produtos/{code}' , ProdutosController::class.":drop");
  $app->put('/produtos/{code}' , ProdutosController::class.":update");
  $app->post('/users', UsersController::class.':create');
  $app->delete('/users/{user}', UsersController::class.":drop");
  $app->put('/users/{user}', UsersController::class.":update");
  $app->post('/representantes', RepresentantesController::class.':create');
  $app->delete('/representantes/{crachar}' , RepresentantesController::class.":drop");
  $app->post('/fornecedores', FornecedoresController::class.':create');
  $app->put('/fornecedore/{cnpj}' , FornecedoresController::class.':update');
  $app->delete('/fornecedores/{cnpj}' , FornecedoresController::class.":drop");
  $app->post('/funcionarios', FuncionariosController::class.':create');
  $app->put('/funcionarios/{matr}' , FuncionariosController::class.':update');
  $app->delete('/funcionarios/{matr}' , FuncionariosController::class.":drop");
});

#Auth
$app->post('/auth', AuthController::class.':auth');
