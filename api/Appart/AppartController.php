<?php

require_once 'AppartService.php';


function appartCreate($json)
{
    try {
        $res = ccr2($json ?? $_POST);
        echo json_encode(['message' => 'Appart created.', 'status' => 200]);
    } catch (BddConnexionException $e ) {
        http_response_code(500);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 500]);
        exit();
    } catch ( BddBadRequestException | BadRequestException $e) {
        http_response_code(400);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 400]);
        exit();
    } catch (BddNotFoundException | NotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 404]);
        exit();
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 401]);
        exit();
    } catch (MissingParameterException | BddMissingParameterException $e) {
        http_response_code(406);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 406]);
        exit();
    } catch (ForbiddenException $e) {
        http_response_code(403);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
        exit();
    }
}

function appartGet($json)
{
    try {
        $res = getappars($json ?? $_POST);
        echo json_encode(["message" => $res, "status" => 200]);
    } catch (BddConnexionException $e ) {
        http_response_code(500);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 500]);
        exit();
    } catch ( BddBadRequestException | BadRequestException $e) {
        http_response_code(400);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 400]);
        exit();
    } catch (BddNotFoundException | NotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 404]);
        exit();
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 401]);
        exit();
    } catch (MissingParameterException | BddMissingParameterException $e) {
        http_response_code(406);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 406]);
        exit();
    } catch (ForbiddenException $e) {
        http_response_code(403);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
        exit();
    }
}

function appartDelete($json)
{
    try {
        deleteAppart($json ?? $_POST);
        echo json_encode(["message" => 'Appart suprimé', "status" => 200]);
    } catch (BddConnexionException $e ) {
        http_response_code(500);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 500]);
        exit();
    } catch ( BddBadRequestException | BadRequestException $e) {
        http_response_code(400);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 400]);
        exit();
    } catch (BddNotFoundException | NotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 404]);
        exit();
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 401]);
        exit();
    } catch (MissingParameterException | BddMissingParameterException $e) {
        http_response_code(406);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 406]);
        exit();
    } catch (ForbiddenException $e) {
        http_response_code(403);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
        exit();
    }
}

function appartModify($json)
{
    try {
        modifyAppart($json ?? $_POST);
        echo json_encode(["message" => 'Appart modified', "status" => 200]);
    } catch (BddConnexionException $e ) {
        http_response_code(500);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 500]);
        exit();
    } catch ( BddBadRequestException | BadRequestException $e) {
        http_response_code(400);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 400]);
        exit();
    } catch (BddNotFoundException | NotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 404]);
        exit();
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 401]);
        exit();
    } catch (MissingParameterException | BddMissingParameterException $e) {
        http_response_code(406);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 406]);
        exit();
    } catch (ForbiddenException $e) {
        http_response_code(403);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
        exit();
    }
}

function appartDisponibility($json){
    try {
        $res= modifyAppartDisponibility($json ?? $_POST);
        $not = $res == 't' ? 'now available' : 'not available anymore';
        echo json_encode(["message" => 'Appart modified. It is '.$not. '.', "status" => 200]);
    } catch (BddConnexionException $e ) {
        http_response_code(500);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 500]);
        exit();
    } catch ( BddBadRequestException | BadRequestException $e) {
        http_response_code(400);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 400]);
        exit();
    } catch (BddNotFoundException | NotFoundException $e) {
        http_response_code(404);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 404]);
        exit();
    } catch (UnauthorizedException $e) {
        http_response_code(401);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 401]);
        exit();
    } catch (MissingParameterException | BddMissingParameterException $e) {
        http_response_code(406);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 406]);
        exit();
    } catch (ForbiddenException $e) {
        http_response_code(403);
        echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
        exit();
    }
    
    
}
