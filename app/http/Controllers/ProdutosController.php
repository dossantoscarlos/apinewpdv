<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Interfaces\IApiDAO;
use Respect\Validation\Validator as V;
use App\Http\Models\Entity\Produto;

class ProdutosController extends Controller implements IApiDAO
{
	
	public function show ($request, $response, $args){
		$uriGetParam = $request->getUri()->getQuery();

		if (empty($uriGetParam))
		{
			$result = $this->orm->getRepository(Produto::class)->findProdutosAll();
			return $this->response->withStatus(200)->withJson($result);

		}else{
			$objeto = (object) $request->getParams();
			$error = null;
			if (isset($objeto->nome)){
				$error = $this->validator->validate($request,[
					'nome' => V::Alpha()->notEmpty(),
				]);
			}elseif(isset($objecto->code)){
				$error = $this->validator->validate($request,[
					'code' => V::numeric()->noWhitespace()->notEmpty(),
				]);
			}
			if($error == null)
			{
				if(isset($objeto->nome) || isset($objeto->code) ){
					$result = $this->orm->getRepository(Produto::class)->findProdutos($objeto); 
					return $response->withJson($result);
				} 
			}else{
				$errors[] = (object) $error;
				return $this->response->withJson($errors);
			}
		}
	}
	

	public function create ($request, $response, $args){
		$objeto = (object) $request->getParams();
		$error = $this->validator->validate($request,[
			'nome' => V::Alpha()->notEmpty(),
			'tipo' => V::Alpha()->noWhitespace()->notEmpty(),
			'code' => V::numeric()->noWhitespace()->notEmpty(),
			'kilo' => V::numeric()->noWhitespace()->notEmpty(),
			'unidade' => V::numeric()->noWhitespace()->notEmpty(),
			'valor' => V::numeric()->noWhitespace()->notEmpty()
		]);
		if($error == null){
			$result = $this->orm->getRepository(Produto::class)->createProduto($objeto);
			return $this->response->withStatus($result);			
		}else {
			$errors[] = (object) $error;
			return $this->response->withJson($errors,301);
		}

	}

	public function drop ($request, $response, $args){
		if(is_numeric($args['code'])){
			$obj = (object) $args;
			$result = $this->orm->getRepository(Produto::class)->deletarProduto($obj);
			return $this->response->withStatus($result);
		}else{
			return $this->response->withJson(['code' => 'Codigo so pode ser numerico'],400);
		}	
	}

	public function update ($request, $response, $args){
		if(is_numeric($args['id'])){

			$objeto = (object) $request->getParams();
			$obj = (object) $args;
			$error = $this->validator->validate($request,[
				'valor' => V::numeric()->noWhitespace()->notEmpty()
			]);
			if ($error == null){
				$result = $this->orm->getRepository(Produto::class)->updateProduto($obj,$objeto);
				return $this->response->withStatus($result);
			}else {
				$errors[] = (object) $error;
				return $this->response->withJson($errors,301);
			}
		}else{
			return $this->response->withJson(['code' => 'Codigo so pode ser numerico'],400);
		}	
	}
}