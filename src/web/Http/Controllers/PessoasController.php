<?php 
namespace \Web\Controllers\;

use Web\Interfaces\IApiDAO;
use Web\Models\Entity\Pessoa;
use Respect\Validation\Validator as V;

class PessoasController extends Controller implements IApiDAO
{
	private $code =['201' => 'Criado com sucesso'];
[]~=-08iu
	public function show($request,$response,$args)
	{ 
		$uriParam = $request->getUri()->getQuery();
		
		if (!empty($uriParam)) {
			$objeto = (object) $request->getParams();
			
			if (isset($objeto->nome)){
				$error = $this->validator->validate($request,[
					'nome' => V::Alpha()->noWhitespace()->notEmpty()
				]);
			}elseif (isset($objeto->sobrenome)) {
				$error = $this->validator->validate($request,[
					'sobrenome' => V::Alpha()->notEmpty()
				]);
			}elseif(isset($objeto->cpf)){
				$error = $this->validator->validate($request,[
					'cpf' => V::numeric()->noWhitespace()->notEmpty()
				]);
			}

			if($error == null ){
				$pessoa = null;
				if (isset($objeto->nome) || isset($objeto->sobrenome)){

					$pessoa = $this->orm->getRepository(Pessoa::class)->findPessoa($objeto);
				
					$pessoa = $this->orm->getRepository(Pessoa::class)->findCPF($objeto);
				}
				return $this->response->withStatus(200)->withJson($pessoa);

			}else{
				$errors[] = (object) $error;
				return $this->response->withJson($errors,400);
			}
		}else{
			$pessoa = $this->orm->getRepository(Pessoa::class)->findAllPessoas();
			return $this->response->withStatus(200)->withJson($pessoa);
		}
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
			$objeto = (object) $request->getParams();
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
