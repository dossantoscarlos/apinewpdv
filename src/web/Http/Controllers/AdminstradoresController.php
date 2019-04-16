<?php
namespace Web\Http\Controllers;

use Web\Http\Controllers\Interface\IApiDAO;
use Web\Http\Models\Entity\Administrador;
use Respect\Validation\Validator as V;

class AdministradoresControllers extends Controller implements IApiDAO
{
  public function show($request, $response, $args)
  {

    $query = (object)) $args;
    
    $find =  $this->orm->getRepository(Administrador::class);

    if(!empty($query->mtr) && is_numeric($guery->mtr))
    {
      
      return $this->response->withJson($find->findEntity($query->mtr),200);
    
    }else{
    
      return $this->response->withJson($find->show(),200);
    }

    return $this->response->withStatus(302);
  }

  public function drop($request, $response, $args)
  {

    if(!empty($args->mtr) && is_numeric($args->mtr))
    {
      $query = (object) $args;

      $find = $this->orm->getRepository(Administrador::class)->drop($query->mtr);

      return $this->response->withStatus(204);
    }     

    return $this->response->withStatus(400);
  }

  public function update($request, $response, $args)
  {
      if(!empty($args->mtr) && is_numeric($args->mtr)) {
        
        $query = (object) $args;

        $find = $this->orm->getRepository(Administrador::class)->update($query->mtr);

        return $this->response->withStatus(204);
      }     

    return $this->response->withStatus(400);  
  }

  public function create($request, $response, $args)
  {
    $error = $this->Validator->validate($request,[
      'mtr' = V::Alnum()->noWitespace()->notEmpity(),
    ]);

    if($error != null ) {

        $errors[] = (Object) $error;
        return  $this->response->withJson($errors);
    } else {

      $param = (object) $request;

      $find = $this->orm->getRepository(Administrador::class)->create( $param);
      return $this->response->withJson($find);
    }

    return $this->response->withStatus(200);
  }
}
