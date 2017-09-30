<?php

namespace RestBeer\Beer;
use Zend\Stratigility\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateBeer implements MiddlewareInterface
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        $id = $request->getAttribute('id');

        parse_str(file_get_contents("php://input"),$data);
        $stmt = $this->db->prepare('update beer set name=:name, style=:style where id=:id');
        $stmt->bindParam(':name',$data['name']);
        $stmt->bindParam(':style', $data['style']);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $response->withStatus(204);
        return $out($request, $response);
    }

}