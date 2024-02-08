<?php

    require_once 'UserService.php';

    function UsercreateAccount($json) {
        try {
            ccr($json ?? $_POST);
            echo json_encode(['message'=> 'Account created','status'=> 200]);
        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }

    function UsergetAllAccounts() {
        try {
            $res= getaccs();
            echo json_encode(["message"=>$res, "status"=>200]);
        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }
    }

    function Userlogin($json) {
        try {
            $user = login($json ?? $_POST);
            echo json_encode(['message'=> ["name"=>$user["username"]],'status'=> 200]);
        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }
    function UserdeleteAccount() {
        try {

        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }

    function UsermodifyAccountInfo() {
        try {

        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }