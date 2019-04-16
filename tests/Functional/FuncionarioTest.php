<?php

namespace Tests\Functional;

class FuncionarioTest extends BaseTestCase
{
  public function testAtrributosFuncionario()
  {
    $response = $this->runApp('GET', 'adm/users');
    
    $this->assertEquals(404, $response->getStatusCode());
  }
}
