<?php

    require_once 'ConnexionService.php';

    function connexionCreateAccount($json) {
        try {
            ccr($json ?? $_POST);
            echo json_encode(['message'=> 'Account created','status'=> 200]);
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
            echo json_encode(['message'=> $e->getMessage(),'status'=> 400]);
            exit();
        } catch (ForbiddenException $e) {
            http_response_code(403);
            echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
            exit();
        }
    }

    function connexionGetAccount($json) {
        try {
            $res= getaccs($json ?? $_POST);
            echo json_encode(["message"=>$res, "status"=>200]);
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
            echo json_encode(['message'=> $e->getMessage(),'status'=> 400]);
            exit();
        } catch (ForbiddenException $e) {
            http_response_code(403);
            echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
            exit();
        }
    }


    function connexionLogin($json) {
        try {
            $user = login($json ?? $_POST);
            echo json_encode(['message'=> ["name"=>$user["username"]],'status'=> 200]);
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
            echo json_encode(['message'=> $e->getMessage(),'status'=> 400]);
            exit();
        } catch (ForbiddenException $e) {
            http_response_code(403);
            echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
            exit();
        }

    }
    function connexionDeleteAccount($json) {
        try {
            deleteUser($json ?? $_POST);
            echo json_encode(['message'=> 'Account deleted','status'=> 200]);
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
            echo json_encode(['message'=> $e->getMessage(),'status'=> 400]);
            exit();
        } catch (ForbiddenException $e) {
            http_response_code(403);
            echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
            exit();
        }
    }

    function connexionModifyAccountInfo($json) {
        try {
            modifyUser($json ?? $_POST);
            echo json_encode(['message'=> 'Account modified','status'=> 200]);
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
            echo json_encode(['message'=> $e->getMessage(),'status'=> 400]);
            exit();
        } catch (ForbiddenException $e) {
            http_response_code(403);
            echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
            exit();
        }
    }
    function connexionGetroles($json) {
        try {
            $res = getroles($json);
            echo json_encode(['message'=> $res,'status'=> 200]);
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
            echo json_encode(['message'=> $e->getMessage(),'status'=> 400]);
            exit();
        } catch (ForbiddenException $e) {
            http_response_code(403);
            echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
            exit();
        }
    }