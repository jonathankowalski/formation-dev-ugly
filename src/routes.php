<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {
    return $this->renderer->render($response, 'index.phtml', $args);
});


$app->post('/', function (Request $request, Response $response, array $args) {
    return $this->renderer->render($response, 'bim.phtml', $this->app->run($request->getParsedBody()));
});