<?php
namespace RestBeer;

use Zend\Stratigility\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Auth implements MiddlewareInterface
{
    private $validToken = 'cerveja';

    private $whiteList = array('login');

    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        $valores = explode('/',$request->getUri());
        $url = $valores[count($valores)-1];

        if(in_array($url,$this->whiteList)){
        return $out($request, $response);
    }

        if(! $request->hasHeader('authorization')){
            return $response->withStatus(401);
        }

        if (!$this->isValid($request)) {
            return $response->withStatus(403);
        }

        return $out($request, $response);
    }

    private function isValid(Request $request)
    {
        $token = $request->getHeader('authorization');

        return $token[0] == $this->validToken;
    }
}
