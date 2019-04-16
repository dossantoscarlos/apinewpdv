<?php
  namespace Web\Http\Controllers\Auth;

  use Web\Http\Controllers\Controller;
  use Web\Http\Models\Entity\User;
  use Firebase\JWT\JWT;
  use Respect\Validation\Validator as V;

  class AuthController extends Controller
  {

    public function auth($request, $response, $args)
    {

      $login = (object) $request->getParams();

      $error = $this->validator->validate($request, [
				'user' => V::Alnum()->noWhitespace()->notEmpty(),
				'passw' => V::Alnum()->noWhitespace()->notEmpty(),
			]);

      if($error){
        $erros = (object)$error;
				return $this->response->withJson($erros,302);
      }

      $user = $this->orm->getRepository(User::class)->findUserAuth($login);

      if (isset($user["error"])){
        return $this->response->withJson($user);
      }

      $user = (object) $user[0];
      $teste = dump($user);

      return $this->response->withJson($teste);

      if(isset($user->error))
      {
          return $this->response->withJson($user,302);
      }
        // verify password.
      if (!password_verify($login->passw, $user->pass))
      {
        return $this->response->withJson(['error' => true, 'message' => 'Senha Incorreta']);
      }

      $settings = $this->settings; //captura o array existente em settings

      $token = JWT::encode(['id' => $user->id, 'email' => $user->user], $settings['jwt']['secret'], "HS256");

      return $this->response->withJson(['token' => $token]);
    }
  }
