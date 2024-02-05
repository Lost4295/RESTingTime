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

    function ConnexiongetAccount() {
        try {

        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }

    function ConnexiondeleteAccount() {
        try {

        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }

    function ConnexionmodifyAccountInfo() {
        try {

        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }
