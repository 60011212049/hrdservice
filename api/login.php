<?php
// Useing namespace
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;


$app->post('/login', function (Request $request, Response $response) {
    $dataInput = $request->getBody();
    $data = json_decode($dataInput, true);
    $database = $GLOBALS['dbconn'];

    $result = $database->select("member", '*', [
        "user_name" => $data['username'],
    ]);
    if (count($result) == 0) {
        $response->getBody()->write("don't have user");
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
    }

    $strDecode = md5($data['password']);
    $result = $database->select("member", '*', [
        "user_name" => $data['username'],
        "Password" => $strDecode,
    ]);
    if (count($result) == 1) {
        $response->getBody()->write(json_encode($result));
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } else {
        $response->getBody()->write("password not correct");
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
    }

});

$app->get('/loginId/{id}', function (Request $request, Response $response,  array $args) {
    $dataInput = $request->getBody();
    $paramId = $args['id'];
    $data = json_decode($dataInput, true);
    $database = $GLOBALS['dbconn'];

    $result = $database->select("member", '*', [
        "Name" => intval($paramId),
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
