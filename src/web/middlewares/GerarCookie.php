<?php 

namespace Web\Middlewares;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response; 
use Dflydev\FigCookies\Cookie;
use Dflydev\FigCookies\FigRequestCookies;
use Dflydev\FigCookies\Cookies;
use Dflydev\FigCookies\SetCookies;

class GerarCookie
{
    public function __invoke(Request $req, Response $resp, callable $next) : Response
    {
        return $next($req , $resp);
    }
}