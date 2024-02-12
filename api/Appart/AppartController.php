<?php

require_once 'AppartService.php';


function Appartcreate($json)
{
    try {
        ccr2($json ?? $_POST);
        echo json_encode(['message' => 'Appart created', 'status' => 200]);
    } catch (MissingParameterException $e) {
        http_response_code(400);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    } catch (BddConnexionException | BddBadRequestException $e) {
        http_response_code(500);
        echo json_encode(['message' => $e->getMessage(), 'status' => 500]);
        exit();
    }
}

function Appartget($json)
{
    try {
        $res = getappars($json ?? $_POST);
        echo json_encode(["message" => $res, "status" => 200]);
    } catch (MissingParameterException $e) {
        http_response_code(400);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    } catch (BddConnexionException | BddBadRequestException $e) {
        http_response_code(500);
        echo json_encode(['message' => $e->getMessage(), 'status' => 500]);
        exit();
    } catch (BddNotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message' => $e->getMessage(), 'status' => 404]);
        exit();
    }
}

function Appartdelete($json)
{
    try {
        deleteAppart($json ?? $_POST);
        echo json_encode(["message" => 'Appart suprimé', "status" => 200]);
    } catch (BddConnexionException | BddBadRequestException | BadRequestException $e) {
        http_response_code(500);
        echo json_encode(['message' => $e->getMessage(), 'status' => 500]);
        exit();
    } catch (BddNotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message' => $e->getMessage(), 'status' => 404]);
        exit();
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(['message' => $e->getMessage(), 'status' => 401]);
        exit();
    } catch (MissingParameterException | BddMissingParameterException $e) {
        http_response_code(400);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    }
}

function Appartmodify($json)
{
    try {
        modifyAppart($json ?? $_POST,);
        echo json_encode(["message" => 'Appart modified', "status" => 200]);
    } catch (BddConnexionException | BddBadRequestException $e) {

        http_response_code(500);
        echo json_encode(['message' => $e->getMessage(), 'status' => 500]);
        exit();
    } catch (BddNotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message' => $e->getMessage(), 'status' => 404]);
        exit();
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(['message' => $e->getMessage(), 'status' => 401]);
        exit();
    } catch (MissingParameterException | BddMissingParameterException $e) {
        http_response_code(400);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    }
}
