<?php 
namespace Web\Http\Controllers;

use Web\Http\Controllers\Interfaces\IApiDAO;
use Web\Http\Models\Entity\Representante;
use Respect\Validation\Validator as V;

class RepresentantesController extends Controller implements IApiDAO
{
	public function show($request, $response, $args)
	{
		$objQuery = $request->getUri()->getQuery();		
		if (!empty($objQuery)) {
			$obj = (object)$request->getParams();
			$error = $this->validator->validate($request, [
				'crachar' => V::Alnum()->noWhitespace()->notEmpty()
			]);

			if ($error == null) {
				$result = $this->orm->getRepository(Representante::class)->findCracharRepresentante($obj);
			} else {
				$errors[] = (object)$error;
				return $this->response->withJson($errors);
			}

		} else {
			$representantes = $this->orm->getRepository(Representante::class)->findAllRepresentantes();
			return $this->response->withJson($representantes);
		}
	}

	public function create($request, $response, $args)
	{
		$obj = (object)$request->getParams();
		if (!empty($obj)) {
			$error = $this->validator->validate($request, [
				'crachar' => V::Alnum()->noWhitespace()->notEmpty(),
				'nome' => V::alpha()->noWhitespace()->notEmpty(),
				'sobrenome' => V::alpha()->notEmpty()
			]);

			if ($error == null) {
				$result = $this->orm->getRepository(Representante::class)->salvarRepresentante($obj);
				return $this->response->withStatus($result);
			} else {
				$errors[] = (object)$error;
				return $this->response->withJson($errors);
			}
		} else {
			return $this->response->withStatus(302);
		}
	}

	public function drop($request, $response, $args)
	{
		$obj = (object) $args;
		if (isset($args)) {
			$result = $this->orm->getRepository(Representante::class)->removerRepresentante($obj);
			return $this->response->withStatus($result);
		} else {
			return $this->response->withStatus(302);
		}
	}

	public function update($request, $response, $args)
	{
		return $this->response->withStatus(204);
	}
}
