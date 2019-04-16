<?php

namespace Tests\Functional;

class LoginTest extends BaseTestCase
{
  public function testLoginAuth(){
    // We need a request and response object to invoke the action
    $environment = \Slim\Http\Environment::mock([
        'REQUEST_METHOD' => 'POST',
        'REQUEST_URI' => '/auth',
        'QUERY_STRING'=>''
      ]);

    // instantiate action
    $action = new \Web\Http\Controllers\Auth\AuthController(
       \Slim\Http\Request::createFromEnvironment($environment) ,
       new \Slim\Http\Response(),
       []
    );
    // run the controller action and test it
    $response = $action;
    dump($response);
    $this->assertSame((string)$response);
  }
}
