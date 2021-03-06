<?php
namespace Web\Http\Controllers;

use Web\Http\Controllers\Interfaces\IApiDAO;
use Web\Http\Models\Entity\Pessoa;
use Respect\Validation\Validator as V;

class PessoasController extends Controller implements IApiDAO
{
	public function show($request,$response,$args)
	{
		$obj = (object) $request->getParams();
		$p = $this->orm->getRepository(Pessoa::class);
		if(!empty($obj))
		{
			$pessoa = ["pessoa" => $p->findAllPessoas()];
			return $this->response->withJson($pessoa, 200);
		}

		if (!empty($args))
		{
			$obj = (object) $args;
			if(is_numeric($obj->cpf))
			{
				$pessoa = ["pessoa" => $p->findPessoa($obj->cpf)];
				return $this->response->withJson($pessoa,200);
			}
		}

		// $uriParam = $request->getUri()->getQuery();
		// if (!empty($uriParam)) {
		// 	$objeto = (object) $request->getParams();
		// 	if (isset($objeto->nome)){
		// 		$error = $this->validator->validate($request,[
		// 			'nome' => V::Alpha()->notEmpty()
		// 		]);
		//
		// 	}elseif (isset($objeto->sobrenome)) {
		// 		$error = $this->validator->validate($request,[
		// 			'sobrenome' => V::Alpha()->notEmpty()
		// 		]);
		// 	}elseif(isset($objeto->cpf)){
		// 		$error = $this->validator->validate($request,[
		// 			'cpf' => V::numeric()->noWhitespace()->notEmpty()
		// 		]);
		// 	}
		//
		// 	if($error == null ){
		// 		$pessoa = null;
		// 		if (isset($objeto->nome) || isset($objeto->sobrenome)){
		//
		// 			$pessoa = $this->orm->getRepository(Pessoa::class)->findPessoa($objeto);
		//
		// 			$pessoa = $this->orm->getRepository(Pessoa::class)->findCPF($objeto);
		// 		}
		// 		return $this->response->withJson($pessoa,200);
		//
		// 	}else{
		// 		$errors[] = (object) $error;
		// 		return $this->response->withJson($errors,400);
		// 	}
		// }else{
		// 	$pessoa = $this->orm->getRepository(Pessoa::class)->findAllPessoas();
		// 	return $this->response->withJson($pessoa,200);
		// }
	}


	public function create($request,$response,$args)
	{
		$objeto = (object) $request->getParams();
		$error = $this->validator->validate($request,[
			'nome' => V::Alpha()->noWhitespace()->notEmpty(),
			'sobrenome' => V::Alpha()->notEmpty(),
			'cpf' => V::numeric()->notEmpty(),
			'numero' => V::numeric()->notEmpty(),
			'complemento' => V::Alpha(),
			'tel' => V::numeric()->notEmpty(),
			'email' => V::Alpha()->notEmpty()
		]);
		if($error == null ){
			$pessoa = $this->orm->getRepository(Pessoa::class)->salvarPessoa($objeto);
			return $this->response->withStatus($pessoa);
		}else{
			$errors[] = (object) $error;
			return $this->response->withJson($errors);
		}
	}

	public function update($request,$response,$args)
	{
		if (is_numeric($args['cpf']) ) {

			$obj = (object) $args;
			$pessoa = $this->orm->getRepository(Pessoa::class)->atualizarPessoa($obj, $objeto);
			return $this->response->withStatus($pessoa);
		}else{
			return $this->response->withStatus(400);
		}
	}

	public function drop($request,$response,$args)
	{
		if (is_numeric($args['cpf']) ) {
			$obj = (object) $args;
			$pessoa = $this->orm->getRepository(Pessoa::class)->deletarPessoa($obj);
			return $this->response->withStatus($pessoa);
		}else{
			return $this->response->withStatus(405);
		}
	}
}
