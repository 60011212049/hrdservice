<?php
// Useing namespace
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/meterial', function (Request $request, Response $response, array $args) {
    $database = $GLOBALS['dbconn'];
    $result = $database->select('se_material', '*', []);

    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->post('/parent_login', function (Request $request, Response $response) {
    $dataInput = $request->getBody();
    $data = json_decode($dataInput, true);
    $database = $GLOBALS['dbconn'];

    $result = $database->select("parent",'*', [
        "username" => $data['username'],
        "password" => $data['password'],
    ]);
    if (count($result) == 1) {
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } else {
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
    }

});
