<?php

require_once 'AppartRepository.php';


function ccr2($json)
{
    if (
        is_object($json)
        && isset($json->superficie)
        && isset($json->max_pers) 
        && isset($json->price) 
        && isset($json->address) 
        && isset($json->creator)
    ) {
        $superficie = $json->superficie;
        $max_pers = $json->max_pers;
        $price = $json->price;
        $address = $json->address;
        $creator = $json->creator;
        $conn = new Appart();
        $conn->createAppart($superficie, $max_pers, $price,$address , $creator);
    } else {
        throw new Exception('Missing parameter !', 400);
    }
}


function getaccs2()
{
    $conn = new Appart();
    return $conn->getAllAppart();
}

function modifyAppart($json)
{
    $superficie = $max_pers = $price = $address = $creator = "";
    if (is_object($json)) {
        if (isset($json->superficie)) {
            $superficie = $json->superficie;
        }
        if (isset($json->max_pers)) {
            $max_pers = $json->max_pers;
        }
        if (isset($json->price)) {
            $price = $json->price;
        }
        if (isset($json->address)) {
            $address = $json->address;
        }
        if (isset($json->creator)) {
            $creator = $json->creator;
        }
        $conn = new Appart();
        $appart= $conn->getAppart($creator);
        if($appart){
            $conn->modifyAppart($superficie, $max_pers, $price, $address , $creator );
        } else{
            throw new Exception('Appart not found !', 404);
        }
    } else {
        throw new Exception('Missing parameter !', 400);
    }
}

function deleteAppart($json)
{
    if (is_object($json)){
        if (isset($json->creator)) {
            $creator = $json->creator;
            $conn = new Appart();
            $conn->removeAppart($creator);
        } else {
            throw new Exception('Missing parameter !', 400);
        }
    }
}



