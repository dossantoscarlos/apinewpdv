<?php
namespace Web\Http\Controllers;

use Web\Http\Controllers\Interfaces\IApiDAO;
use Web\Http\Models\Entity\Beneficio;

class BeneficiosController extends Controller implements IApiDAO
{
  public function show($request, $response, $args)
  {
    $bnc = $this->orm->getRepository(Beneficio::class);
    $param = $request->getParams();
    if (!empty($param)) {

      $error = $this->validator->validate($request,[
        'matricula' => V::Alpha()->noWhitespace()->notEmpty(),
        'tipo' => V::Alpha()->notEmpty() ]);

      if ($error!=null){
          $errors[] = (object) $error;
          return $this->response->withJson(['beneficio'=> $errors]);
      }
      return $this->response->withJson(['beneficio' => $bnc->findEntity($param)]);
    }
    return $this->response->withJson(['beneficio' => $bnc->show()]);
  }

  public function drop($request, $response, $args) {
    return $this->response->withStatus(200);
  }

  public function update($request, $response, $args) {
    $bnc = $this->orm->getRepository(Beneficio::class);
    $param = $request->getParams();
    if (!empty($param)) {

      $error = $this->validator->validate($request,[
        'matricula' => V::Alpha()->noWhitespace()->notEmpty(),
        'tipo' => V::Alpha()->notEmpty()
      ]);

      if ($error!=null){
          $errors[] = (object) $error;
          return $this->response->withJson($errors);
      }

      $bnc->update($param);

      return $this->response->withStatus(204);
  }
}

  public function create($request, $response, $args) {
    return $this->response->withStatus(200);
  }
}
