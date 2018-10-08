<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IApiDAO;
use App\Cripto\BcryptCustom;
use Respect\Validation\Validator as V;
use App\Http\Models\Entity\User;

class UsersController extends Controller implements IApiDAO
{
	
	public function show ($request, $response, $args){
		$uri = $request->getUri()->getQuery();

		if (!empty($uri)){
			$obj = (object) $request->getParams();
			
			if(isset($obj->user)){
				$error = $this->validator->validate($request,[
					'user' => V::Alnum()->noWhitespace()->notEmpty(),
				]);
				if ($error==null){
					$users = $this->orm->getRepository(User::class)->findUser($obj);
					return $this->response->withJson($users);
				}else{
					$errors[] = (object) $error;
					return $this->response->withJson($errors);
				}
			}else{
				return $this->response->withStatus(204);
			}
		}else {
			return $this->response->withJson($this->orm->getRepository(User::class)->findUserAll());
		}
	}

	public function select ($request, $response, $args){
		return $this->response->withStatus(200);
	}

	public function create ($request, $response, $args){
		$uri = $request->getUri()->getQuery();
		if (!empty($uri)){
			$objeto = (object) $request->getParams();
			$error = $this->validator->validate($request,[
					'user' => V::Alnum()->noWhitespace()->notEmpty(),
					'passw' => V::Alnum()->noWhitespace()->notEmpty(),
				]);
			if ($error == null){	
				$bcryptCustom = new BcryptCustom();			
				$value = $bcryptCustom->cryptHash($objeto->passw);
				$objeto->passw = $value;
				$result = $this->orm->getRepository(User::class)->salvarUser($objeto);
				return $this->response->withStatus($result);
			}else{
				$erros[] = (object) $error;
				return $this->response->withJson($erros,302);
			}
		}else {
			return $this->response->withStatus(303);
		}

	}

	public function drop ($request, $response, $args){
		return $this->response->withStatus(200);
	}

	public function update ($request, $response, $args){
		return $this->response->withStatus(200);
	}
}