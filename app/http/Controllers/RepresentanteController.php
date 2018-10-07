<?php 
namespace  App\Http\Controllers

use App\Http\Controllers\Interfaces\IApiDAO;
 
class RepresentanteController extends Controller implements IApiDAO
{
	public function show ($request, $response, $args){
		return $this->response->withStatus(200);
	}

	public function create ($request, $response, $args){
		return $this->response->withStatus(201);
	}

	public function drop ($request, $response, $args){
		return $this->response->withStatus(200);
	}

	public function update ($request, $response, $args){
		return $this->response->withStatus(200);
	}
}