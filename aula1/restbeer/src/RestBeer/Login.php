<?php

namespace RestBeer;

use Zend\Stratigility\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Login implements MiddlewareInterface
{
    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        $data = $request->getParsedBody();

        if($data['login'] != 'unicesumar' || $data['senha'] != '123'){
            return $response->withStatus(401);
        }

        $response->getBody()->write("cerveja");

        return $out($request,$response);
    }
}