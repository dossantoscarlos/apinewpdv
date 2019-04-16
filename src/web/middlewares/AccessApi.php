<?php
namespace Web\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class AccessApi
{
    /**
     * Invoke middleware
     *
     * @param  ServerRequestInterface  $request  PSR7 request object
     * @param  ResponseInterface $response PSR7 response object
     * @param  callable          $next     Next middleware callable
     *
     * @return ResponseInterface PSR7 response object
     *
     **/
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $response = $next($request, $response);
        return $response
            ->withAddedHeader('Access-Control-Allow-Origin', '*')
            ->withAddedHeader('Access-Control-Allow-Headers', 'X-Requested-With, crosDomain, XMLHttpRequest ,Content-Type, Accept, Origin, Authorization')
            ->withAddedHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
        }
    }
