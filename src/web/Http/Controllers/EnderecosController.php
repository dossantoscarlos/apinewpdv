<?php

namespace Web\Http\Controllers;

use Web\Http\Controllers\Interfaces\IApiDao;

class EnderecosController extends Controllers  extends IApiDao
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
