<?php

    require_once 'AppartService.php';

    function Appartcreate($json) {
        try {
            ccr2($json ?? $_POST);
            echo json_encode(['message'=> 'Appart created','status'=> 200]);
        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }

    function AppartgetAll() {
        try {
            $res= getaccs2(); 
            echo json_encode(["message"=>$res, "status"=>200]);
        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }
    }

    function AppartgetOne(){
        try {
            $res= getaccsps(); 
            echo json_encode(["message"=>$res, "status"=>200]);
        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }
    }

    
    function Appartdelete() {
        try {

        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }

    function AppartmodifyAccountInfo() {
        try {

        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }
