<?php

namespace RestBeer\Beer;

use Zend\Stratigility\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GetBeer implements MiddlewareInterface
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        $id = $request->getAttribute('id');
        if (!isset($this->db['brands'][$id])) {
            return $response->withStatus(404);
        }

        $response->getBody()->write($this->db['brands'][$id]);

        return $out($request, $response);
    }
}