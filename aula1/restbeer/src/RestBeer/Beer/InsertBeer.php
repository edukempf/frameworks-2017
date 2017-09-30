<?php

namespace RestBeer\Beer;

use Zend\Stratigility\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class InsertBeer implements MiddlewareInterface
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function __invoke(Request $request, Response $response, callable $out = null)
    {
        $this->db->exec(
            "create table if not exists 
beer (id INTEGER PRIMARY KEY AUTOINCREMENT, name text not null, style text not null)"
        );

        $data = $request->getParsedBody();
        $stmt = $this->db->prepare('insert into beer (name, style) values (:name, :style)');
        $stmt->bindParam(':name',$data['name']);
        $stmt->bindParam(':style', $data['style']);
        $stmt->execute();
        $data['id'] = $this->db->lastInsertId();
        if ($data['id'] == 0) {
            return $response->withStatus(500, "Erro salvando cerveja");
        }
        $response->getBody()->write($data['id']);

        $response->withStatus(201);
        return $out($request,$response);
    }
}