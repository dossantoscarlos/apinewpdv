<?php
namespace Tests\Functional;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ActionRequest
{
    public function __invoke(Request $request, Response $response, $args = [])
    {
        return $response->withJson($request->getQueryParams());
    }
}
