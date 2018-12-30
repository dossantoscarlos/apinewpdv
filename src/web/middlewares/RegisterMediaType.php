<?php
namespace Web\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class RegisterMediaType
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
    public function __invoke (ServerRequestInterface $request, ResponseInterface $response, callable $next) {
        // add media parser
        $request->registerMediaTypeParser(
            "text/javascript",
            function ($input) {
                return json_decode($input, true);
            }
          );
        return $next($request, $response);
    }
}
