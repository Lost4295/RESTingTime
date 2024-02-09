<?php

    require_once 'ConnexionService.php';

    function ConnexioncreateAccount($json) {
        try {
            ccr($json ?? $_POST);
            echo json_encode(['message'=> 'Account created','status'=> 200]);
        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }

    function ConnexiongetAllAccounts() {
        try {
            $res= getaccs();
            echo json_encode(["message"=>$res, "status"=>200]);
        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }
    }

    function Connexionlogin($json) {
        try {
            $user = login($json ?? $_POST);
            echo json_encode(['message'=> ["name"=>$user["username"]],'status'=> 200]);
        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }
    function ConnexiondeleteAccount($json) {
        try {
            deleteUser($json ?? $_POST);
            echo json_encode(['message'=> 'Account deleted','status'=> 200]);
        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }

    function ConnexionmodifyAccountInfo($json) {
        try {
            modifyUser($json ?? $_POST);
            echo json_encode(['message'=> 'Account modified','status'=> 200]);
        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }
