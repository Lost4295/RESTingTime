<?php

require_once 'ReservationService.php';


//JSON_ENCODE parce que le site est chiant à mort
function reservationCreate($json)
{
    try {
        $enr = crenr($json);
        http_response_code(200);
        echo json_encode(['message' => ["id" => $enr["id"]], 'status' => 200]);
    } catch (BddConnexionException $e) {
        http_response_code(500);
        echo json_encode(['message' => $e->getMessage(), 'status' => 500]);
        exit();
    } catch (BddBadRequestException | BadRequestException $e) {
        http_response_code(400);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    } catch (BddNotFoundException | NotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message' => $e->getMessage(), 'status' => 404]);
        exit();
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(['message' => $e->getMessage(), 'status' => 401]);
        exit();
    } catch (MissingParameterException | BddMissingParameterException $e) {
        http_response_code(406);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    } catch (ForbiddenException $e) {
        http_response_code(403);
        echo json_encode(['message' => $e->getMessage(), 'status' => 403]);
        exit();
    }
}

function reservationGet($json)
{
    try {
        $res = getenr($json);
        http_response_code(200);
        echo json_encode(['message' => $res, 'status' => 200]);
    } catch (BddConnexionException $e) {
        http_response_code(500);
        echo json_encode(['message' => $e->getMessage(), 'status' => 500]);
        exit();
    } catch (BddBadRequestException | BadRequestException $e) {
        http_response_code(400);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    } catch (BddNotFoundException | NotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message' => $e->getMessage(), 'status' => 404]);
        exit();
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(['message' => $e->getMessage(), 'status' => 401]);
        exit();
    } catch (MissingParameterException | BddMissingParameterException $e) {
        http_response_code(406);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    } catch (ForbiddenException $e) {
        http_response_code(403);
        echo json_encode(['message' => $e->getMessage(), 'status' => 403]);
        exit();
    }
}

function reservationDelete($json)
{
    try {
        delenr($json);
        http_response_code(200);
        echo json_encode(['message' => 'Reservation deleted', 'status' => 200]);
    } catch (BddConnexionException $e) {
        http_response_code(500);
        echo json_encode(['message' => $e->getMessage(), 'status' => 500]);
        exit();
    } catch (BddBadRequestException | BadRequestException $e) {
        http_response_code(400);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    } catch (BddNotFoundException | NotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message' => $e->getMessage(), 'status' => 404]);
        exit();
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(['message' => $e->getMessage(), 'status' => 401]);
        exit();
    } catch (MissingParameterException | BddMissingParameterException $e) {
        http_response_code(406);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    } catch (ForbiddenException $e) {
        http_response_code(403);
        echo json_encode(['message' => $e->getMessage(), 'status' => 403]);
        exit();
    }
}

function reservationModify($json)
{
    try {
        modenr($json);
        http_response_code(200);
        echo json_encode(['message' => 'Reservation modified', 'status' => 200]);
    } catch (BddConnexionException $e) {
        http_response_code(500);
        echo json_encode(['message' => $e->getMessage(), 'status' => 500]);
        exit();
    } catch (BddBadRequestException | BadRequestException $e) {
        http_response_code(400);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    } catch (BddNotFoundException | NotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message' => $e->getMessage(), 'status' => 404]);
        exit();
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(['message' => $e->getMessage(), 'status' => 401]);
        exit();
    } catch (MissingParameterException | BddMissingParameterException $e) {
        http_response_code(406);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    } catch (ForbiddenException $e) {
        http_response_code(403);
        echo json_encode(['message' => $e->getMessage(), 'status' => 403]);
        exit();
    }
}


function reservationNotImplemented()
{
    try {
        http_response_code(501);
        echo json_encode(['message' => 'Not implemented !', 'status' => 501]);
    } catch (BddConnexionException $e) {
        http_response_code(500);
        echo json_encode(['message' => $e->getMessage(), 'status' => 500]);
        exit();
    } catch (BddBadRequestException | BadRequestException $e) {
        http_response_code(400);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    } catch (BddNotFoundException | NotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message' => $e->getMessage(), 'status' => 404]);
        exit();
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(['message' => $e->getMessage(), 'status' => 401]);
        exit();
    } catch (MissingParameterException | BddMissingParameterException $e) {
        http_response_code(406);
        echo json_encode(['message' => $e->getMessage(), 'status' => 400]);
        exit();
    } catch (ForbiddenException $e) {
        http_response_code(403);
        echo json_encode(['message' => $e->getMessage(), 'status' => 403]);
        exit();
    }
}
