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



