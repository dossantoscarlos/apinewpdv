<?php

namespace Web\Middlewares;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class RegisterMethodRoute
{

    public  function __invoke (ServerRequestInterface $request, ResponseInterface $response, callable $next) {
        $route = $request->getAttribute("route");
    
        $methods = [];
    
        if (!empty($route)) {
            $pattern = $route->getPattern();
    
            foreach ($this->router->getRoutes() as $route) {
                if ($pattern === $route->getPattern()) {
                    $methods = array_merge_recursive($methods, $route->getMethods());
                }
            }
            //Methods holds all of the HTTP Verbs that a particular route handles.
        } else {
            $methods[] = $request->getMethod();
        }
    
        $response = $next($request, $response);
    
    
        return $response->withHeader("Access-Control-Allow-Methods", implode(",", $methods));
    }
}