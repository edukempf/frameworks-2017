<?php

namespace RestBeer\Beer;

use Zend\Stratigility\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ListBeer implements MiddlewareInterface
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        $stmt = $this->db->prepare('select name from beer');
        $stmt->execute();
        $data = $stmt->fetchAll(\PDO::FETCH_COLUMN);
        $response->getBody()->write(implode(',',$data));
        return $out($request,$response);
    }
}