<?php
// Useing namespace
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/student', function (Request $request, Response $response, array $args) {
    $database = $GLOBALS['dbconn'];
    $result = $database->select('student', '*', []);

    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->get('/student_fromparent/{id}', function (Request $request, Response $response, array $args) {

    $id = $args['id'];
    $database = $GLOBALS['dbconn'];

    $result = $database->select("student", [
        "[>]relation_parent" => ["id" => "student_id"],
    ], '*', ["relation_parent.parent_id" => $id]);

    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(200);

});
