<?php

    require_once 'ConnexionService.php';

    function ConnexioncreateAccount($json) {
        try {
            ccr($json ?? $_POST);
            echo json_encode(['message'=> 'Account created','status'=> 200]);
        } catch (BadRequestException $e){
            http_response_code(400);
            echo json_encode(['message'=> ' Une erreur est survenue. Une donnée est certainement manquante. Merci de réessayer.','status'=> 400 ]);
            exit();
        } catch (BddBadRequestException $e) {
            http_response_code(400);
            echo json_encode(['message'=> "Une erreur est survenue en base (".$e->getMessage().") Merci de réessayer.",'status'=> 400 ]);
            exit();
        }
    }

    function ConnexiongetAccount($json) {
        try {
            $res= getaccs($json ?? $_POST);
            echo json_encode(["message"=>$res, "status"=>200]);
        } catch (BadRequestException $e){
            http_response_code(400);
            echo json_encode(['message'=> ' Une erreur est survenue. Une donnée est certainement manquante. Merci de réessayer.','status'=> 400 ]);
            exit();
        } catch (BddBadRequestException $e) {
            http_response_code(400);
            echo json_encode(['message'=> "Une erreur est survenue en base (".$e->getMessage().") Merci de réessayer.",'status'=> 400 ]);
            exit();
        }
    }


    function Connexionlogin($json) {
        try {
            $user = login($json ?? $_POST);
            echo json_encode(['message'=> ["name"=>$user["username"]],'status'=> 200]);
        } catch (BadRequestException $e){
            http_response_code(400);
            echo json_encode(['message'=> ' Une erreur est survenue. Une donnée est certainement manquante. Merci de réessayer.','status'=> 400 ]);
            exit();
        } catch (BddBadRequestException $e) {
            http_response_code(400);
            echo json_encode(['message'=> "Une erreur est survenue en base (".$e->getMessage().") Merci de réessayer.",'status'=> 400 ]);
            exit();
        }

    }
    function ConnexiondeleteAccount($json) {
        try {
            deleteUser($json ?? $_POST);
            echo json_encode(['message'=> 'Account deleted','status'=> 200]);
        } catch (BddConnexionException | BddBadRequestException | BadRequestException $e ) {
            http_response_code(500);
            echo json_encode(['message'=> $e->getMessage(),'status'=> 500]);
            exit();
        } catch (BddNotFoundException $e) {
            http_response_code(404);
            echo json_encode(['message'=> $e->getMessage(),'status'=> 404]);
            exit();
        } catch (UnauthorizedException $e) {
            http_response_code(401);
            echo json_encode(['message'=> $e->getMessage(),'status'=> 401]);
            exit();
        } catch (MissingParameterException | BddMissingParameterException $e) {
            http_response_code(400);
            echo json_encode(['message'=> $e->getMessage(),'status'=> 400]);
            exit();
        } catch (ForbiddenException $e) {
            http_response_code(403);
            echo json_encode(['message'=> $e->getMessage(),'status'=> 403]);
            exit();
        }

    }

    function ConnexionmodifyAccountInfo($json) {
        try {
            modifyUser($json ?? $_POST);
            echo json_encode(['message'=> 'Account modified','status'=> 200]);
        }catch (BddConnexionException | BddBadRequestException $e) {
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
