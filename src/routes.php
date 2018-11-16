<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Web\Http\Controllers\PessoasController;
use Web\Http\Controllers\ProdutosController;
use Web\Http\Controllers\UsersController;
use Web\Http\Controllers\RepresentantesController;
use Web\Http\Controllers\FuncionariosController;
use Web\Http\Controllers\FornecedoresController;
// Routes

#tabela Pessoas
$app->get('/pessoas', PessoasController::class.':show');
$app->post('/pessoas', PessoasController::class.':create');
$app->put('/pessoas/{cpf}', PessoasController::class.':update');
$app->delete('/pessoas/{cpf}', PessoasController::class.':drop');

//tabela Produtos
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
$app->get('/representantes' , RepresentantesController::class.':show');
$app->post('/representantes', RepresentantesController::class.':create');
$app->delete('/representantes/{crachar}' , RepresentantesController::class.":drop");

#tabela fornecedores
$app->get('/fornecedores' , FornecedoresController::class.':show');
$app->post('/fornecedores', FornecedoresController::class.':create');
$app->put('/fornecedore/{cnpj}' , FornecedoresController::class.':update');
$app->delete('/fornecedores/{cnpj}' , FornecedoresController::class.":drop");

#tabela Funcionarios
$app->get('/funcionarios[/{matr}]' , FuncionariosController::class.':show');
$app->post('/funcionarios', FuncionariosController::class.':create');
$app->put('/funcionarios/{matr}' , FuncionariosController::class.':update');
$app->delete('/funcionarios/{matr}' , FuncionariosController::class.":drop");

