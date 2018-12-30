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
        return $response->withHeader('Access-Control-Allow-Origin', '*' )
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With,XMLHttpRequest, Content-Type, Accept, Origin, Authorization,crossDomain')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }
}