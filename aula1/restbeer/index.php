<?php
use Zend\Expressive\AppFactory;

$loader = require 'vendor/autoload.php';
$loader->add('RestBeer', __DIR__.'/src');
$beers = [
    'brands' => ['Heineken', 'Guinness', 'Skol', 'Colorado'],
    'styles' => ['Pilsen' , 'Stout']
];
$db = new PDO('sqlite:beers.db');

$app = AppFactory::create();

$app->get('/', new \RestBeer\Home());

$app->get('/brands', new RestBeer\Beer\ListBrands($beers));

$app->get('/styles', new RestBeer\Beer\ListStyle($beers));

$app->get('/beer/{id}', new \RestBeer\Beer\GetBeer($beers));

$app->get('/beers', new \RestBeer\Beer\ListBeer($db));

$app->post('/beer', new \RestBeer\Beer\InsertBeer($db));

$app->post('/login', new \RestBeer\Login());

$app->put('/beer/{id}', new \RestBeer\Beer\UpdateBeer($db));

$app->delete('/beer/{id}', new \RestBeer\Beer\DeleteBeer($db));

$app->pipe(new RestBeer\Auth());
$app->pipeRoutingMiddleware();
$app->pipeDispatchMiddleware();
$app->pipe(new RestBeer\Format\Json());
$app->pipe(new RestBeer\Format\Html());
$app->run();
