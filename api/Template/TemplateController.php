<?php

    require_once 'TemplateService.php';


    //JSON_ENCODE parce que le site est chiant à mort
    function create() {
        try {
            //ici l'appel au service et la fonction correspondante
            echo json_encode(['message'=> 'success','status'=> 200]);
        } catch (Exception $e){
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }

    function get() {
        try {
            //ici l'appel au service et la fon correspondante
            echo json_encode(['message'=> 'success','status'=> 200]);
        } catch (Exception $e){
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }

    function delete() {
        try {
            //ici l'appel au service et la fon correspondante
            echo json_encode(['message'=> 'success','status'=> 200]);
        } catch (Exception $e){
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }

    function modify() {
        try {
            //ici l'appel au service et la fon correspondante
            echo json_encode(['message'=> 'success','status'=> 200]);
        } catch (Exception $e){
            echo json_encode(['message'=> $e->getMessage(),'status'=> $e->getCode()]);
            exit();
        }

    }
