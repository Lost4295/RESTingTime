<?php

require_once 'ConnexionRepository.php';


function ccr($json)
{
    if (is_object($json) && isset($json->superficie) && isset($json->max_pers) && isset($json->price) && isset($json->address) && isset($json->creator)){
        $superficie = $json->superficie;
        $max_pers = $json->max_pers;
        $price = $json->price;
        $address = $json->address;
        $creator = $json->creator;
        $conn = new Connexion();
        $conn->createUser($address, $creator, $max_pers, $superficie, $price);
    } else {
        throw new Exception('Missing parameter !', 400);
    }
}


function getaccs()
{
    $conn = new Connexion();
    return $conn->getAllAppart();
}



