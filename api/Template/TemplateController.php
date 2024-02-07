<?php

require_once 'TemplateService.php';


//JSON_ENCODE parce que le site est chiant à mort
function create()
{
    try {
        //ici l'appel au service et la fon correspondante

        http_response_code(501);
        echo json_encode(['message' => 'Not implemented !', 'status' => 501]);
        //si tout s'est bien passé
        // echo json_encode(['message'=> 'success','status'=> 200]);
    } catch (Exception $e) {
        echo json_encode(['message' => $e->getMessage(), 'status' => $e->getCode()]);
        exit();
    }
}

function get()
{
    try {
        //ici l'appel au service et la fon correspondante

        http_response_code(501);
        echo json_encode(['message' => 'Not implemented !', 'status' => 501]);
        //si tout s'est bien passé
        // echo json_encode(['message'=> 'success','status'=> 200]);
    } catch (Exception $e) {
        echo json_encode(['message' => $e->getMessage(), 'status' => $e->getCode()]);
        exit();
    }
}

function delete()
{
    try {
        //ici l'appel au service et la fon correspondante

        http_response_code(501);
        echo json_encode(['message' => 'Not implemented !', 'status' => 501]);
        //si tout s'est bien passé
        // echo json_encode(['message'=> 'success','status'=> 200]);
    } catch (Exception $e) {
        echo json_encode(['message' => $e->getMessage(), 'status' => $e->getCode()]);
        exit();
    }
}

function modify()
{
    try {
        //ici l'appel au service et la fon correspondante

        http_response_code(501);
        echo json_encode(['message' => 'Not implemented !', 'status' => 501]);
        //si tout s'est bien passé
        // echo json_encode(['message'=> 'success','status'=> 200]);
    } catch (Exception $e) {
        echo json_encode(['message' => $e->getMessage(), 'status' => $e->getCode()]);
        exit();
    }
}


function notImplemented()
{
    try {
        http_response_code(501);
        echo json_encode(['message' => 'Not implemented !', 'status' => 501]);
    } catch (Exception $e) {
        echo json_encode(['message' => $e->getMessage(), 'status' => $e->getCode()]);
        exit();
    }
}
