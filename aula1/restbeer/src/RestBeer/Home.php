<?php

namespace RestBeer;
use Zend\Stratigility\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Home implements MiddlewareInterface
{
    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        // $response->getBody()->write(serialize($beers['brands']));
        $response->getBody()->write('Hello, world!');
        // return $response;
        return $out($request, $response);

    }
}