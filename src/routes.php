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
use  Web\Http\Controllers\BeneficiosController;
// Routes

//home
$app->get('/' ,function (Request $request, Response $response , $args){
  return $response->withRedirect('/lojista');
});

$app->group('/lojista', function (App $app) {
  #tabela Pessoas
  $app->get('/pessoas[/{cpf}]', PessoasController::class.':show');
  
  $app->post('/pessoas', PessoasController::class.':create');

  //tabela Produtos
  $app->get('/produtos[/{code}]' , ProdutosController::class.':show');

  $app->post('/vendas', VendaController::class.':create');

  #tabela Funcionarios
  $app->get('/funcionarios/{matr}' , FuncionariosController::class.':show');
});


$app->group('/adm', function (App $app)
{
  
  //pessoas
  $app->post('/pessoas', PessoasController::class.':create');

  $app->get('/pessoas[/{code}]',PessoasController::class.':show');

  $app->put('/pessoas/{cpf}', PessoasController::class.':update');
  
  $app->delete('/pessoas/{cpf}', PessoasController::class.':drop');
  

  //produtos
  $app->post('/produtos', ProdutosController::class.':create');
  
  $app->get('/produtos[/{code}]' , ProdutosController::class.':show');

  $app->delete('/produtos/{code}' , ProdutosController::class.":drop");
  
  $app->put('/produtos/{code}' , ProdutosController::class.":update");
  
 
  //users
  $app->post('/users', UsersController::class.':create');
  
  $app->get('/users[/{mtr}]', UsersController::class.':show');
  
  $app->delete('/users/{user}', UsersController::class.":drop");
  
  $app->put('/users/{user}', UsersController::class.":update");
  

  //beneficios
  $app->get('/beneficios[/{code}]', BeneficiosController::class.':show');

  $app->post('/beneficios', BeneficiosController::class.':create');
  
  $app->put('/beneficios/{code}', BeneficiosController::class.':update');

  $app->delete('/beneficios/{code}', BeneficiosController::class.':delete');
  
  //representantes  
  $app->post('/representantes', RepresentantesController::class.':create');
  
  $app->get('/representantes[/{mtr}]',RepresentantesController::class.':show');

  $app->put('/representantes/{mtr}', RepresentantesController::class.':update');

  $app->delete('/representantes/{crachar}' , RepresentantesController::class.":drop");


  //administradores
  $app->get('/administradores[/{mtr}]', AdminsitradoresController::class.':show');

  $app->post('/adminsitradores', AdminsitradoresController::class.':create');
  $app->put('/adminsitradores/{mtr}', AdminsitradoresController::class.':update');

  $app->delete('/adminsitradores/{matr}', AdminsitradoresController::class.':drop');


  //Fornecedores
  $app->get('/fornecedores[/{mtr}]',FornecedoresController::class.':show');

  $app->post('/fornecedores', FornecedoresController::class.':create');
  
  $app->put('/fornecedore/{cnpj}' , FornecedoresController::class.':update');

  $app->delete('/fornecedores/{cnpj}' , FornecedoresController::class.":drop");

  //funcionarios
  $app->get('/funcionarios[/{mtr}]', FuncionariosController::class.':show');

  $app->post('/funcionarios', FuncionariosController::class.':create');
  
  $app->put('/funcionarios/{matr}' , FuncionariosController::class.':update');
  
  $app->delete('/funcionarios/{matr}' , FuncionariosController::class.":drop");
});

$app->get('/users', UsersController::class.':show');

#Auth
$app->post('/auth', AuthController::class.':auth');
