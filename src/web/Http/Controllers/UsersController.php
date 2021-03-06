<?php

namespace Web\Http\Controllers;

use Web\Http\Controllers\Interfaces\IApiDAO;
use Respect\Validation\Validator as V;
use Web\Http\Models\Entity\User;

class UsersController extends Controller implements IApiDAO
{
	public function show($request, $response, $args)
	{
		$uri = $request->getUri()->getQuery();
		$userRepo = $this->orm->getRepository(User::class);

		if (!empty($uri)) {
			$obj = (object)$request->getParams();

			if (isset($obj->user)) {
				$error = $this->validator->validate($request, [
					'user' => V::Alnum()->noWhitespace()->notEmpty(),
				]);

				if ($error == null) {
					$users = $userRepo->findUser($obj);
					$user = ['users' => $users];
					return $this->response->withJson($user);

				} else {
					$errors[] = (object) $error;
					return $this->response->withJson($errors);
				}

			} else {
				return $this->response->withStatus(302);
			}

		} else {
			$user = $userRepo->findUserAll();
			return $this->response->withJson(["users" => $user],200);
		}
	}

	public function create($request, $response, $args)
	{
		$uri = $request->getUri()->getQuery();
		if (!empty($uri)) {
			$objeto = (object)$request->getParams();
			$error = $this->validator->validate($request, [
				'user' => V::Alnum()->noWhitespace()->notEmpty(),
				'passw' => V::Alnum()->noWhitespace()->notEmpty(),
			]);
			if ($error == null) {
				$result = $this->orm->getRepository(User::class)->salvarUser($objeto);
				return $this->response->withStatus($result);
			} else {
				$erros[] = (object)$error;
				return $this->response->withJson($erros, 302);
			}
		} else {
			return $this->response->withStatus(303);
		}
	}

	public function drop($request, $response, $args)
	{
		$obj = (object)$args;

		if (isset($obj->user)) {
			$user = $this->orm->getRepository(User::class)->removeUser($obj);
			return $this->response->withStatus($user);
		} else {
			return $this->response->withStatus(400);
		}
	}

	public function update($request, $response, $args)
	{
		$uri = $request->getUri()->getQuery();
		dump($uri);

		if (isset($uri)) {

			$obj = (object)$request->getParams();
			$objArgs = (object)$args;

			$error = $this->validator->validate($request, [
				'passw' => V::Alnum()->noWhitespace()->notEmpty(),
			]);
			if ($error == null) {
				$user = $this->orm->getRepository(User::class)->atualizarUser($objArgs, $obj);
				return $this->response->withStatus($user);
			} else {
				$errors[] = (object)$error;
				return $this->response->withJson($errors);
			}
		} else {
			return $this->response->withStatus(500);
		}
	}

	public function teste($arfd)
	{
		return $arfd;
	}
}
