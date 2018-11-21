<?php 

namespace Web\Controllers\;

use Web\Interfaces\IApiDAO;
use Web\Models\Entity\Funcionario;

class FuncionariosController extends Controller implements IApiDAO
{
	
	public function show ($request, $response, $args){
		$param = (object) $request->getParams();
		dump($args);
		die();
		if(empty($param) ) : 
			$f = $this->orm->getRepository(Funcionario::class)->findAllFuncionarios();
			return $this->response->withJson($f);
		:else:
			$f = $this->orm->getRepository(Funcionario::class)->findFuncionario($param);
			return $this->response->withJson($f);
		endif;
	}

	public function select ($request, $response, $args){
		return $this->response->withStatus(200);
	}

	public function create ($request, $response, $args){
		return $this->response->withStatus(200);
	}

	public function drop ($request, $response, $args){
		return $this->response->withStatus(200);
	}

	public function update ($request, $response, $args){
		return $this->response->withStatus(200);
	}
}