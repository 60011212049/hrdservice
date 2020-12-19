<?php
// Useing namespace
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/teacher', function (Request $request, Response $response, array $args) {
    $database = $GLOBALS['dbconn'];
    $result = $database->select('teacher', '*', []);

    return $response->withJson($result, 200);
});

$app->get('/teacher_profile/{id}', function (Request $request, Response $response, array $args) {
    $id = $args['id'];
    $database = $GLOBALS['dbconn'];
    $result = $database->select('teacher', '*', [
        "id" => $id
    ]);

    return $response->withJson($result, 200);
});

$app->post('/teacher_login', function (Request $request, Response $response) {
    $dataInput = $request->getBody();
    $data = json_decode($dataInput, true);
    $database = $GLOBALS['dbconn'];

    $result = $database->select("teacher",'*', [
        "username" => $data['username'],
        "password" => $data['password'],
    ]);
    if (count($result) == 1) {
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } else {
        $response->getBody()->write("Data not found !");
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
    }

});
