<?php
  namespace Web\Http\Controllers\Auth;

  use Web\Http\Controllers\Controller;

  class AuthController extends Controller
  {
    public function select($req, $res, $args)
    {
      $auth = new Auth();
      $ath = ['auth' => $auth->Authentication('valor','teste')];
      return $this->res->withJson($ath);
    }
  }
