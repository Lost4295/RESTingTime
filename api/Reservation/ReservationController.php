<?php

require_once 'ReservationService.php';


//JSON_ENCODE parce que le site est chiant à mort
function Reservationcreate($json)
{
    try {
        //ici l'appel au service et la fon correspondante
        $enr = crenr($json);
        http_response_code(200);
        echo json_encode(['message'=> ["id"=>$enr["id"]],'status'=> 200]);
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
    } catch (ForbiddenException $e) {
        http_response_code(403);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
        exit();
    }
}

function Reservationget($json)
{
    try {
        //ici l'appel au service et la fon correspondante
        $res= getenr($json);
        http_response_code(200);
        echo json_encode(['message' => $res, 'status' => 200]);
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

function Reservationdelete($json)
{
    try {
        //ici l'appel au service et la fon correspondante
        delenr($json);
        http_response_code(200);
        echo json_encode(['message' => 'Reservation deleted', 'status' => 200]);
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

function Reservationmodify($json)
{
    try {
        //ici l'appel au service et la fon correspondante
        modenr($json);
        http_response_code(200);
        echo json_encode(['message' => 'Reservation modified', 'status' => 200]);
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


function ReservationnotImplemented()
{
    try {
        http_response_code(501);
        echo json_encode(['message' => 'Not implemented !', 'status' => 501]);
    } catch (Exception $e) {
        echo json_encode(['message' => $e->getMessage(), 'status' => $e->getCode()]);
        exit();
    }
}
