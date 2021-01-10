<?php
// Useing namespace
use \Psr\Http\Message\ResponseInterface as Response;
use \Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/pay_order', function (Request $request, Response $response, array $args) {
    $database = $GLOBALS['dbconn'];
    $result = $database->select('se_material', '*', []);

    $response->getBody()->write(json_encode($result));
    return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});


$app->post('/pay_order_add', function (Request $request, Response $response) {
    $dataInput = $request->getBody();
    $data = json_decode($dataInput, true);
    $database = $GLOBALS['dbconn'];

    $maxId = ($database->max("se_pay_order", 'po_id') + 1);
    $result = $database->insert("se_pay_order", [
        "po_id" => $maxId,
        "or_date" => date("Y-m-d"),
        "empno" => intval($data['employee_id']),
        "dep_id" => intval($data['department_id']),
        "or_no" => $data['order_no'],
        "or_status" => "N",
    ]);
    if ($result->rowCount() == 1) {
        foreach ($data['listMaterial'] as $item) {
            $res = $database->insert("se_withdrawal", [
                "po_id" => $maxId,
                "mate_id" => $item['mate_id'],
                "amount" => $item['receive'],
            ]);
            if ($res->rowCount() == 0) {
                $response->getBody()->write("failed to insert list");
                return $response->withHeader('Content-Type', 'application/json')
                    ->withStatus(404);
            }
            else{
                $database->update("se_material", [
                    "receive[-]" => $item['receive'],
                ], [
                    "mate_id" => $item['mate_id'],
                ]);
            }
        }
        // foreach ($data['listEquipment'] as $item) {
        //     $database->update("equipment", [
        //         "equipment_amount[-]" => $item['equipment_amount'],
        //     ], [
        //         "equipment_id" => $item['equipment_id'],
        //     ]);
        //     $database->update("equipment_in_contract", [
        //         "amount_eq_contract[-]" => $item['equipment_amount'],
        //     ], [
        //         "id_stock" => $item['equipment_id'],
        //         "id_contract" => $data['requestion']['req_id'],
        //     ]);
        // }

        $response->getBody()->write("success");
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    } else {
        $response->getBody()->write("failed");
        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(404);
    }
});
