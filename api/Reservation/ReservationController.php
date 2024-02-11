<?php

require_once 'ReservationService.php';


//JSON_ENCODE parce que le site est chiant à mort
function create($json)
{
    try {
        //ici l'appel au service et la fon correspondante
        crenr($json);
        http_response_code(501);
        echo json_encode(['message' => 'Not implemented !', 'status' => 501]);
        //si tout s'est bien passé
        // echo json_encode(['message'=> 'success','status'=> 200]);
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

function get($json)
{
    try {
        //ici l'appel au service et la fon correspondante
        getenr($json);
        http_response_code(501);
        echo json_encode(['message' => 'Not implemented !', 'status' => 501]);
        //si tout s'est bien passé
        // echo json_encode(['message'=> 'success','status'=> 200]);
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

function delete($json)
{
    try {
        //ici l'appel au service et la fon correspondante
        delenr($json);
        http_response_code(501);
        echo json_encode(['message' => 'Not implemented !', 'status' => 501]);
        //si tout s'est bien passé
        // echo json_encode(['message'=> 'success','status'=> 200]);
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

function modify($json)
{
    try {
        //ici l'appel au service et la fon correspondante
        modenr($json);
        http_response_code(501);
        echo json_encode(['message' => 'Not implemented !', 'status' => 501]);
        //si tout s'est bien passé
        // echo json_encode(['message'=> 'success','status'=> 200]);
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


function notImplemented()
{
    try {
        echo json_encode(['message' => 'Not implemented !', 'status' => 501]);
        http_response_code(501);
    } catch (Exception $e) {
        echo json_encode(['message' => $e->getMessage(), 'status' => $e->getCode()]);
        exit();
    }
}
