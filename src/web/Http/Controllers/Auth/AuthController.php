<?php
  namespace Web\Http\Controllers\Auth;

  use Web\Http\Controllers\Controller;
  use Web\Http\Models\Entity\User;

  class AuthController extends Controller
  {
    public function check($req, $res, $args)
    {
      $user = new User();
      $auth = new Auth($user);
      $post =(object) $req->getParams();
      if ($auth->check($post))
      {
        $auth->acess();
        return $this->res->withStatus(200)->withJson($auth->acess());
      }
      return $this->res->withStatus(401);  

    }
  }
