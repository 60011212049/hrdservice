<?php
// Useing namespace
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;


$app->get('/employee/{id}', function (Request $request, Response $response,  array $args) {
    $dataInput = $request->getBody();
    $paramId = $args['id'];
    $data = json_decode($dataInput, true);
    $database = $GLOBALS['dbconn'];

    $result = $database->select("emppersonal", '*', [
        "empno" => intval($paramId),
    ]);
    if (count($result) == 1) {
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } else {
        $response->getBody()->write("don't have user");
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
    }

});
