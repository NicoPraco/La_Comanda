<?php
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;

    require __DIR__ . '/../vendor/autoload.php';

    $app = AppFactory::create();

    $app->get('/hello/', function (Request $request, Response $response, array $args) {
        $response->getBody()->write("¡Hola, mundo!");
        return $response;
    });

    $app->run();
