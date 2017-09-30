<?php

namespace RestBeer\Beer;

use Zend\Stratigility\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ListStyle implements MiddlewareInterface
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        // $response->getBody()->write(serialize($beers['brands']));
        $response->getBody()->write(implode(',', $this->db['styles']));
        // return $response;
        return $out($request, $response);
    }
}