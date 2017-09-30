<?php

namespace RestBeer\Beer;

use Zend\Stratigility\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class DeleteBeer implements MiddlewareInterface
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        $id = $request->getAttribute('id');
        $stmt = $this->db->prepare('delete from beer where id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $response->getBody()->write('apagado');
        return $out($request, $response);
    }

}