<?php
namespace Web\Http\Controllers;

use Web\Http\Controllers\Interface\IApiDAO;
use Web\Http\Models\Entity\Caixa;

class CaixasController extends Controller implements IApiDAO
{
  public function show($request, $response, $args)
  {
    return $this->response->withStatus(200);
  }

  public function drop($request, $response, $args)
  {
    return $this->response->withStatus(200);
  }

  public function update($request, $response, $args)
  {
      return $this->response->withStatus(200);
  }

  public function create($request, $response, $args)
  {
    return $this->response->withStatus(200);
  }
}
