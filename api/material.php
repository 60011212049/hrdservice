<?php
// Useing namespace
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/material', function (Request $request, Response $response, array $args) {
    $database = $GLOBALS['dbconn'];
    $result = $database->select('se_material', '*', []);

    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->get('/material_type', function (Request $request, Response $response, array $args) {
    $database = $GLOBALS['dbconn'];
    $result = $database->select('se_material_type', '*', []);

    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->get('/order_select', function (Request $request, Response $response, array $args) {
    $database = $GLOBALS['dbconn'];
    $result = $database->select('se_order', '*', []);

    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

// $app->get ('/order',function (request $result , Response $response , array $args){
//     $database = $GLOBALS['dbcon'];
//     $result = $database->select('se_order','*',[]);

//     $response->getBody()->write(json_encode($result));
//     return $response->writeHeader('Content-Type','application/json')
//         ->withStatus(200);
// });

$app->get('/test', function (Request $request, Response $response, array $args) {
    $database = $GLOBALS['dbconn'];
    $result = utf8_decode('d89827631a84add5bfda6f63d98e8a10');

    $response->getBody()->write($result);
    return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->post('/meterial_post', function (Request $request, Response $response) {
    $dataInput = $request->getBody();
    $data = json_decode($dataInput, true);
    $database = $GLOBALS['dbconn'];

    $result = $database->select("parent", '*', [
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
