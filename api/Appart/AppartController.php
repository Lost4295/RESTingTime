<?php

    require_once 'AppartService.php';


    function Appartcreate($json) {
        try {
            $final = json_decode(handleAuth());
            if (!$final->ok) {
                http_response_code(401);
                echo json_encode($final);
                exit();
            }
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

    
    function Appartdelete($json) {
        try {
            deleteAppart($json ?? $_POST);
            echo json_encode(["message"=> 'Appart suprimé',"status"=> 200]);

        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }

    function Appartmodify($json) {
        try {
            modifyAppart($json ?? $_POST);
            echo json_encode(["message"=> 'Appart modify',"status"=> 200]);

        } catch (Exception $e){
            http_response_code($e->getCode());
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }
