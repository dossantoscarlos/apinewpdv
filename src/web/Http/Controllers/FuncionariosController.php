<?php

namespace Web\Http\Controllers;

use Web\Http\Interfaces\IApiDAO;
use Web\Http\Models\Entity\Funcionario;

class FuncionariosController extends Controller implements IApiDAO
{
	public function show ($request, $response, $args){
		$param = (object) $request->getParams();
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
